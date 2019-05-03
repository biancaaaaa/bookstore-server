<?php

namespace App\Http\Controllers;

use App\Address;
use App\BookStatus;
use App\Order;
use App\Status;
use App\User;
use DateTime;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class OrderController extends Controller
{
    /**
     * Returns all orders.
     *
     * @return Order[]|\Illuminate\Database\Eloquent\Builder[]|\Illuminate\Database\Eloquent\Collection
     */
    public function index()
    {
        // load all orders with eager loading
        $orders = Order::with(['status.status', 'books', 'shippingAddress'])->get();
        return $orders;
    }

    /**
     * Returns orders of specific user.
     *
     * @param $userId
     * @return mixed
     */
    public function getFromUser($userId)
    {
        $orders = Order::where('shop_user_id', $userId)->with(['status.status', 'books', 'shippingAddress'])->get();
        return $orders;
    }

    /**
     * Saves new order in db.
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function save(Request $request): JsonResponse
    {
        DB::beginTransaction();
        try {
            $order = new Order();
            $order->orderedAt = new DateTime($request['orderedAt']);
            $order->totalNet = $request->totalNet;
            $order->totalPreTax = $request->totalPreTax;
            $shopUser = User::where('id', $request->shop_user_id)->first();
            $order->shopUser()->associate($shopUser);
            $shippingAddress = Address::where('id', $shopUser->address_id)->first();
            $order->shippingAddress()->associate($shippingAddress);
            $order->save();
            $currentStatus = new BookStatus();
            // assigns status 'Offen' to a new order.
            $status = Status::where('description', 'Offen')->first();
            $currentStatus->status()->associate($status);
            $currentStatus->order()->associate($order);
            $currentStatus->changedAt = new DateTime();
            $currentStatus->save();

            if (isset($request['books']) && is_array($request['books'])) {
                foreach ($request['books'] as $item) {
                    $order->books()->attach(
                        $item['book']['id'],
                        ['amount' => $item['amount'], 'orderPrice' => $item['book']['price']]
                    );
                }
            }
            DB::commit();
            // return a vaild http response
            return response()->json($order, 201);
        } catch (\Exception $e) {
            // rollback all queries
            DB::rollBack();
            return response()->json("saving order failed: " . $e->getMessage(), 420);
        }
    }

    /**
     * Updates status.
     *
     * @param Request $request
     * @param $orderId
     * @return JsonResponse
     */
    public function updateStatus(Request $request, $orderId): JsonResponse
    {
        DB::beginTransaction();
        try {
            $order = Order::where('id', $orderId)->first();
            if ($order !== null) {
                $newStatus = new BookStatus();
                $status = Status::where('id', $request['status_id'])->first();
                $newStatus->status()->associate($status);
                $newStatus->order()->associate($order);
                $newStatus->changedAt = new DateTime();
                $newStatus->comment = $request['comment'];
                $newStatus->save();
                DB::commit();
                // return a vaild http response
                return response()->json($newStatus, 201);
            }
        } catch (\Exception $e) {
            // rollback all queries
            DB::rollBack();
            return response()->json("saving new status failed: " . $e->getMessage(), 420);
        }
    }
}
