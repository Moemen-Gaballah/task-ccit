<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PlanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('plans')->insert([
            'title' => 'yearly',
            'identifier' => 'yearly',
            'stripe_id' => 'price_1KhGV9Gjlysq9V5EqIK3ixWX',
        ]);

        DB::table('plans')->insert([
            'title' => 'monthly',
            'identifier' => 'monthly',
            'stripe_id' => 'price_1KhGV9Gjlysq9V5EkyK2YqiU',
        ]);
    }
}
