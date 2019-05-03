<?php

use Illuminate\Database\Seeder;
use \App\Address;

class AddressesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $address = new Address();
        $address->address1 = 'Hirschgasse';
        $address->address2 = '17/12';
        $address->postal_code = '4020';
        $address->city = 'Linz';
        $address->country = 'Österreich';
        $address->save();
    }
}
