<?php

namespace Database\Seeders;

use App\Models\People;
use App\Models\User;
use App\Models\Servant;
use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
       $user = User::create([
            'name'     => 'علی علیمحمدی',
            'mobile'   => '09189573245',
            'password' => Hash::make('123456789'),
        ]);
       $user->assignRole('admin');

        $user = User::create([
            'name'     => 'سعید نیکوکلام',
            'mobile'   => '09195428658',
            'password' => Hash::make('123456'),
        ]);
        $user->assignRole('admin');

        People::create([
            'name_family'   => 'علی علیمحمدی',
            'national_code' => '0520882083',
            'mobile'        => '09189573245',
            'birthday'      => '1375/01/03',
            'gender'        => '1',
            'country'       => '1',
            'province'      => '28',
            'city'          => '1158',
            'degree'        => '3',
            'job'           => 'کارمند',
            'how_to'        => 'از گوگل',
        ]);

        People::create([
            'name_family'   => 'سعیدنیکوکلام',
            'national_code' => '0014445549',
            'mobile'        => '09195428658',
            'birthday'      => '1371/01/22',
            'gender'        => '1',
            'country'       => '1',
            'province'      => '19',
            'city'          => '841',
            'degree'        => '3',
            'job'           => 'کارمند',
            'how_to'        => 'از گوگل',
        ]);

        Servant::create([
            'name_family'   => 'رسول خادم',
            'national_code' => '0520882008',
            'mobile'        => '09184232035',
            'birthday'      => '1368/01/22',
            'gender'        => '1',
            'country'       => '1',
            'province'      => '19',
            'city'          => '841',
            'degree'        => '5',
            'job'           => 'کارمند باسلام',
            'phone'         => '02133558844',
            'workplace'     => 'آشپز موکب',
            'quota'         => '6',
            'start_at' => Carbon::now(),
            'expired_at' => Carbon::now()->addDays(6),
        ]);
    }
}
