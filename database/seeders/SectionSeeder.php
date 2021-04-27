<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User\Department;
use App\Models\User\Section;

class SectionSeeder extends Seeder
{
    public function run()
    {
        Section::insert([//Bölümler
            ['name' => 'Genel Müdür', 'prefix' => 'GMD', 'department_id' => '1','created_at'=> now(),'updated_at'=> now()],
            ['name' => 'Gömülü', 'prefix' => 'GML', 'department_id' => '2','created_at'=> now(),'updated_at'=> now()],
            ['name' => 'Karşılama', 'prefix' => 'KRŞ', 'department_id' => '2','created_at'=> now(),'updated_at'=> now()],
            ['name' => 'Mutfak', 'prefix' => 'MTF', 'department_id' => '2','created_at'=> now(),'updated_at'=> now()],
            ['name' => 'Numune Cihaz Envanteri', 'prefix' => 'NMN', 'department_id' => '2','created_at'=> now(),'updated_at'=> now()],
            ['name' => 'Proje Koordinatörü', 'prefix' => 'PRJ', 'department_id' => '2','created_at'=> now(),'updated_at'=> now()],
            ['name' => 'Test Odası', 'prefix' => 'TSO', 'department_id' => '2','created_at'=> now(),'updated_at'=> now()],
            ['name' => 'Test ve Kontrol Sorumlusu', 'prefix' => 'TST', 'department_id' => '2','created_at'=> now(),'updated_at'=> now()],
            ['name' => 'Toplantı Odası', 'prefix' => 'TPL', 'department_id' => '2','created_at'=> now(),'updated_at'=> now()],
            ['name' => 'Web Takımı', 'prefix' => 'WEB', 'department_id' => '2','created_at'=> now(),'updated_at'=> now()],
            ['name' => 'Yönetici', 'prefix' => 'YÖN', 'department_id' => '2','created_at'=> now(),'updated_at'=> now()],
            ['name' => 'Çayocağı', 'prefix' => 'MTF', 'department_id' => '3','created_at'=> now(),'updated_at'=> now()],
            ['name' => 'Finans', 'prefix' => 'FİN', 'department_id' => '3','created_at'=> now(),'updated_at'=> now()],
            ['name' => 'İK Sorumlusu', 'prefix' => 'İKS', 'department_id' => '3','created_at'=> now(),'updated_at'=> now()],
            ['name' => 'İT Sorumlusu', 'prefix' => 'İTY', 'department_id' => '3','created_at'=> now(),'updated_at'=> now()],
            ['name' => 'Karşılama', 'prefix' => 'KRŞ', 'department_id' => '3','created_at'=> now(),'updated_at'=> now()],
            ['name' => 'Mali ve İdari İşler Müdürü', 'prefix' => 'MİM', 'department_id' => '3','created_at'=> now(),'updated_at'=> now()],
            ['name' => 'Muhasebe', 'prefix' => 'MUH', 'department_id' => '3','created_at'=> now(),'updated_at'=> now()],
            ['name' => 'Muhasebe-Finans Ortak', 'prefix' => 'MFO', 'department_id' => '3','created_at'=> now(),'updated_at'=> now()],
            ['name' => 'Toplantı Odası', 'prefix' => 'TPL', 'department_id' => '3','created_at'=> now(),'updated_at'=> now()],
            ['name' => 'Belgelendirme', 'prefix' => 'BLG', 'department_id' => '3','created_at'=> now(),'updated_at'=> now()],
            ['name' => 'Grafiker', 'prefix' => 'GFR', 'department_id' => '4','created_at'=> now(),'updated_at'=> now()],
            ['name' => 'Satış Destek Yetkilisi', 'prefix' => 'SDY', 'department_id' => '4','created_at'=> now(),'updated_at'=> now()],
            ['name' => 'Satış ve Pazarlama Müdürü', 'prefix' => 'SPM', 'department_id' => '4','created_at'=> now(),'updated_at'=> now()],
            ['name' => 'Satış ve Pazarlama Odası', 'prefix' => 'SPO', 'department_id' => '4','created_at'=> now(),'updated_at'=> now()],
            ['name' => 'Sevkiyat', 'prefix' => 'SVK', 'department_id' => '4','created_at'=> now(),'updated_at'=> now()],
            ['name' => 'Sevkiyat Deposu', 'prefix' => 'SVD', 'department_id' => '4','created_at'=> now(),'updated_at'=> now()],
            ['name' => 'Stajer', 'prefix' => 'STJ', 'department_id' => '4','created_at'=> now(),'updated_at'=> now()],
            ['name' => 'Teknik Destek', 'prefix' => 'TDO', 'department_id' => '4','created_at'=> now(),'updated_at'=> now()],
            ['name' => 'DP Hattı', 'prefix' => 'DPH', 'department_id' => '5','created_at'=> now(),'updated_at'=> now()],
            ['name' => 'KK Hattı', 'prefix' => 'KKH', 'department_id' => '5','created_at'=> now(),'updated_at'=> now()],
            ['name' => 'KKG Hattı', 'prefix' => 'KKG', 'department_id' => '5','created_at'=> now(),'updated_at'=> now()],
            ['name' => 'SLT Hattı', 'prefix' => 'SLT', 'department_id' => '5','created_at'=> now(),'updated_at'=> now()],
            ['name' => 'SMD Hattı', 'prefix' => 'SMD', 'department_id' => '5','created_at'=> now(),'updated_at'=> now()],
            ['name' => 'TM Hattı', 'prefix' => 'TMH', 'department_id' => '5','created_at'=> now(),'updated_at'=> now()],
            ['name' => 'TS Hattı', 'prefix' => 'TSH', 'department_id' => '5','created_at'=> now(),'updated_at'=> now()],
            ['name' => 'Üretim Müdürü', 'prefix' => 'ÜMD', 'department_id' => '5','created_at'=> now(),'updated_at'=> now()],
            ['name' => 'Üretim Ofisi', 'prefix' => 'ÜRO', 'department_id' => '5','created_at'=> now(),'updated_at'=> now()],
            ['name' => 'Üretim Şefliği', 'prefix' => 'ÜRŞ', 'department_id' => '5','created_at'=> now(),'updated_at'=> now()]
        ]);
    }
}
