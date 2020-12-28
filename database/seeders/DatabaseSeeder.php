<?php

use Database\Seeders\InventoryManagementSeeder;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        $this->call(InventoryManagementSeeder::class);
    }
}
