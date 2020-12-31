<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Hardware\Hardware;
use App\Models\Hardware\HardwareType;
use App\Models\Hardware\HardwareModel;
use App\Models\Software\Software;
use App\Models\Software\SoftwareType;
use App\Models\Material\Material;
use App\Models\Material\MaterialType;
use App\Models\CommonItem\CommonItem;
use App\Models\CommonItem\CommonItemType;
use App\Models\User\Department;
use App\Models\User\User;
use App\Models\Admin\Admin;
use App\Models\Transaction\TransactionType;

class InventoryManagementSeeder extends Seeder
{
    public function run()
    {
        Admin::insert([
            ['name'=>'Taha Yerlikaya','user_name'=>'admin','password'=>'admin','email'=>'taha.yerlikaya@gruparge.com','created_at'=>now(),'updated_at'=>now()],
            ['name'=>'Mehmet Portuz','user_name'=>'mp','password'=>'M1234567','email'=>'mehmet.portuz@gruparge.com','created_at'=>now(),'updated_at'=>now()]
        ]);
        Department::insert([
            ['name' => 'Yazılım','created_at'=> now(),'updated_at'=> now()],
            ['name' => 'Ar-Ge','created_at'=> now(),'updated_at'=> now()],
            ['name' => 'Satış Destek','created_at'=> now(),'updated_at'=> now()],
            ['name' => 'Sevkiyat','created_at'=> now(),'updated_at'=> now()],
            ['name' => 'Muhasebe','created_at'=> now(),'updated_at'=> now()],
        ]);
        User::insert([
            ['name'=>'Taha Yerlikaya','department_id'=>'1','email'=>'tahayerlikaya@gruparge.com','created_at'=> now(),'updated_at'=> now()],
            ['name'=>'Baha Yerlikaya','department_id'=>'1','email'=>'bahayerlikaya@gruparge.com','created_at'=> now(),'updated_at'=> now()],
            ['name'=>'Bedirhan Yerlikaya','department_id'=>'2','email'=>'bedirhanyerlikaya@gruparge.com','created_at'=> now(),'updated_at'=> now()],
            ['name'=>'Ertegün Fidan','department_id'=>'2','email'=>'ertegunfidan@gruparge.com','created_at'=> now(),'updated_at'=> now()],
        ]);
        HardwareType::insert([
            ['name' => 'Bilgisayar','prefix'=>'PC','created_at'=> now(),'updated_at'=> now()],
            ['name' => 'Laptop','prefix'=>'NB','created_at'=> now(),'updated_at'=> now()],
        ]);
        HardwareModel::insert([
            ['name' => 'Acer','created_at'=> now(),'updated_at'=> now()],
            ['name' => 'Dell','created_at'=> now(),'updated_at'=> now()],
            ['name' => 'HP','created_at'=> now(),'updated_at'=> now()],
        ]);
        SoftwareType::insert([
            ['name'=>'Microsoft','created_at'=>now(),'updated_at'=>now()],
        ]);
        MaterialType::insert([
            ['name' => 'Terlik','created_at'=> now(),'updated_at'=> now()],
            ['name' => 'Maktap Ucu','created_at'=> now(),'updated_at'=> now()],
        ]);
        CommonItemType::insert([
            ['name' => 'Kamera','created_at'=> now(),'updated_at'=> now()],
            ['name' => '3D Printer','created_at'=> now(),'updated_at'=> now()],
        ]);
        TransactionType::insert([
            ['name' => 'Donanım Atama','created_at'=> now(),'updated_at'=> now()],
            ['name' => 'Donanım İade','created_at'=> now(),'updated_at'=> now()],
            ['name' => 'Yazılım Atama','created_at'=> now(),'updated_at'=> now()],
            ['name' => 'Yazılım İade','created_at'=> now(),'updated_at'=> now()],
            ['name' => 'Malzeme Atama','created_at'=> now(),'updated_at'=> now()],
            ['name' => 'Malzeme İade','created_at'=> now(),'updated_at'=> now()],
            ['name' => 'Ortak Kullanım Atama','created_at'=> now(),'updated_at'=> now()],
            ['name' => 'Ortak Kullanım İade','created_at'=> now(),'updated_at'=> now()]
        ]);
    }
}
