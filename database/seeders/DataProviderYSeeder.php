<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class DataProviderYSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $users = [];
        $currency = ['EGP', 'USD', 'AED', 'SAR'];
        $status = [100, 200, 300];
        for ($i = 0; $i < 5; $i++) {
            $users[] = [
                "balance" => rand(100, 1000),
                "currency" => $currency[array_rand($currency)],
                "email" => "parent" . $i . "@parent.eu",
                "status" => $status[array_rand($status)],
                "created_at" => "22/12/2018",
                "id" => Str::uuid()
            ];
        }


        $json = json_encode($users);
        file_put_contents(storage_path('app/Json/DataProviderY.json'), $json);
    }
}
