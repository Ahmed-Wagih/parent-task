<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class DataProviderXSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $users = [];
        $currency = ['EGP', 'USD', 'AED', 'SAR'];
        $status = [1, 2, 3];
        for ($i = 0; $i < 5; $i++) {

            $users[] = [
                "parentAmount" => rand(100, 1000),
                "currency" => $currency[array_rand($currency)],
                "parentEmail" => "parent" . $i . "@parent.eu",
                "statusCode" => $status[array_rand($status)],
                "registerationDate" => "22/12/2018",
                "parentIdentification" => Str::uuid()
            ];
        }


        $json = json_encode($users);
        file_put_contents(storage_path('app/Json/DataProviderX.json'), $json);
    }
}
