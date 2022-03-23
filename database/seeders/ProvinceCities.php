<?php

namespace Database\Seeders;

use App\Models\ProvinceCity;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\File;

class ProvinceCities extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $file = storage_path('app/files/province_cities.csv');

        $provinceCities = $this->csvToArray($file);

        foreach ($provinceCities as $provinceCity) {
            ProvinceCity::create([
                ProvinceCity::ID     => $provinceCity['id'],
                ProvinceCity::PARENT => $provinceCity['parent'],
                ProvinceCity::TITLE  => $provinceCity['title'],
                ProvinceCity::SORT   => $provinceCity['sort']
            ]);
        }

    }

    function csvToArray($filename = '', $delimiter = ',')
    {
        if (!file_exists($filename) || !is_readable($filename))
            return false;

        $header = ['id', 'parent', 'title', 'sort'];
        $data = array();
        if (($handle = fopen($filename, 'r')) !== false) {
            while (($row = fgetcsv($handle, 0, $delimiter)) !== false) {
                if (!$header)
                    $header = $row;
                else
                    $data[] = array_combine($header, $row);
            }
            fclose($handle);
        }

        return $data;
    }
}
