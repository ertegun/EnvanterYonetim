<?php

use Database\Seeders\ExchangeSeeder;
use Database\Seeders\InventoryManagementSeeder;
use Database\Seeders\SectionSeeder;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        $this->call(SectionSeeder::class);
        $this->call(InventoryManagementSeeder::class);
        $this->call(ExchangeSeeder::class);
    }
}
