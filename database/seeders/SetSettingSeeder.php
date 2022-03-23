<?php

namespace Database\Seeders;

use App\Models\setting;
use Illuminate\Database\Seeder;

class SetSettingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        setting::create([
           setting::TITLE => 'تعداد روز اقامت (روز)',
           setting::KEY => 'days_reserve',
           setting::VALUE => '3',
        ]);

        setting::create([
            setting::TITLE => 'حداقل تعداد روز سپری شده از ترخیص (روز)',
            setting::KEY => 'min_clearance_day_ago',
            setting::VALUE => '30',
        ]);

        setting::create([
            setting::TITLE => 'ظرفیت مجاز هر خادم (نفر روز)',
            setting::KEY => 'servant_capacity',
            setting::VALUE => '6',
        ]);
    }
}
