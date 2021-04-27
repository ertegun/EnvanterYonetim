<?php

namespace Database\Seeders;

use App\Models\Properties\Exchange;
use Illuminate\Database\Seeder;

class ExchangeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Exchange::insert([
            ['name' => 'Dolar', 'icon' => 'fas fa-dollar-sign', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Euro', 'icon' => 'fas fa-euro-sign', 'created_at' => now(), 'updated_at' => now()]
        ]);
    }
}
