<?php

use Illuminate\Database\Seeder;
use \App\Status;

class StatusTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $open = new Status();
        $open->description = 'Offen';
        $open->save();

        $payed = new Status();
        $payed->description = 'Bezahlt';
        $payed->save();

        $dispatched = new Status();
        $dispatched->description = 'Versendet';
        $dispatched->save();

        $cancelled = new Status();
        $cancelled->description = 'Storniert';
        $cancelled->save();
    }
}
