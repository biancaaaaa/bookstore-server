<?php

use Illuminate\Database\Seeder;
use \App\User;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = new User();
        $user->firstName = 'Test';
        $user->lastName = 'User';
        $user->email = 'test@gmail.com';
        $user->password = bcrypt('testuser');
        $user->isAdmin = true;
        $user->save();

        $shopUser = new User();
        $shopUser->firstName = 'ShopTest';
        $shopUser->lastName = 'User';
        $shopUser->email = 'shoptest@gmail.com';
        $shopUser->password = bcrypt('shoptestuser');
        $shopUser->isAdmin = false;
        $shopUser->save();

        $shopUser1 = new User();
        $shopUser1->firstName = 'Max';
        $shopUser1->lastName = 'Mustermann';
        $shopUser1->email = 'shoptest1@gmail.com';
        $shopUser1->password = bcrypt('shoptestuser');
        $shopUser1->isAdmin = false;
        $shopUser1->save();

        $shopUser2 = new User();
        $shopUser2->firstName = 'Susi';
        $shopUser2->lastName = 'Muserfrau';
        $shopUser2->email = 'shoptest2@gmail.com';
        $shopUser2->password = bcrypt('shoptestuser');
        $shopUser2->isAdmin = false;
        $shopUser2->save();
    }
}
