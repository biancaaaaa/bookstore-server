<?php

use Illuminate\Database\Seeder;
use \App\Order;
use \App\User;
use \App\Status;
use \App\BookStatus;
use \App\Address;

class OrdersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $order = new Order();
        $order->orderedAt = new DateTime();
        $total = 30.99;
        $order->totalNet = $total;
        $order->totalPreTax = $total * 1.1;
        $shopUser = User::where('email', 'shoptest@gmail.com')->first();
        $order->shopUser()->associate($shopUser);
        $shippingAddress = Address::all()->first();
        $order->shippingAddress()->associate($shippingAddress);
        $order->save();
        $currentStatus = new BookStatus();
        $status = Status::where('description', 'Offen')->first();
        $currentStatus->status()->associate($status);
        $currentStatus->order()->associate($order);
        $currentStatus->changedAt = new DateTime();
        $currentStatus->save();
        $order->books()->attach(1, ['amount' => 3, 'orderPrice' => 12.99]);
        $order->save();
    }
}
