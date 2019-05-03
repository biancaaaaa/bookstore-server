<?php

namespace App\Http\Controllers;

use App\Address;
use App\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{
    /**
     * Returns current user with address.
     *
     * @param $uid
     * @return mixed
     */
    public function getUser($uid)
    {
        $user = User::where('id', $uid)->with(['address'])->first();
        return $user;
    }

    /**
     * Get all shop users.
     *
     * @return mixed
     */
    public function getShopUsers()
    {
        $users = User::where('isAdmin', false)->get();
        return $users;
    }

    /**
     * Set address of user.
     *
     * @param Request $request
     * @param $uid
     * @return JsonResponse
     */
    public function setAddress(Request $request, $uid) : JsonResponse
    {
        DB::beginTransaction();
        try {
            $user = User::where('id', $uid)->with(['address'])->first();
            if ($user !== null) {
                $address = Address::create($request->all());
                $user->address()->associate($address);
                $user->save();
            }
            DB::commit();
            return response()->json($user, '201');
        } catch (\Exception $e) {
            // rollback all queries
            DB::rollBack();
            return response()->json("updating user address failed: " . $e->getMessage(), 420);
        }
    }
}
