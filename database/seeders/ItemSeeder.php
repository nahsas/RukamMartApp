<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ItemSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('items')->insert([
    [
        "code" => '6949220400396',
        "name" => 'NO3000SPORTEDITION',
        "brand" => 'NUBWO',
        "stock" => 36,
        "unitId" => 1,
        "price" => 125500,
        "discount" => 0,
        "total" => 4518000
    ],
    [
        "code" => '8993053121407',
        "name" => 'Tissue Passeo 500lmbr',
        "brand" => 'PASEO',
        "stock" => 16,
        "unitId" => 2,
        "price" => 20000,
        "discount" => 0,
        "total" => 320000
    ],
    [
        "code" => '8990800021386',
        "name" => 'Alpenliebel mix beries',
        "brand" => 'Alpenliebel',
        "stock" => 33,
        "unitId" => 1,
        "price" => 500,
        "discount" => 0,
        "total" => 20000
    ],
    [
        "code" => '8997001356200',
        "name" => 'Toronto black',
        "brand" => 'Toronto',
        "stock" => 9,
        "unitId" => 1,
        "price" => 30000,
        "discount" => 10,
        "total" => 243000
    ],
    [
        "code" => '8992772195027',
        "name" => 'Amosis kispray',
        "brand" => 'Kispray',
        "stock" => 21,
        "unitId" => 1,
        "price" => 15000,
        "discount" => 0,
        "total" => 315000
    ],
    [
        "code" => '8991102026352',
        "name" => 'Crystaline 600ml',
        "brand" => 'Crystaline',
        "stock" => 31,
        "unitId" => 1,
        "price" => 3000,
        "discount" => 0,
        "total" => 120000
    ],
    [
        "code" => '8991389220054',
        "name" => 'Buku Sidu 58LMBR',
        "brand" => 'Sidu',
        "stock" => 12,
        "unitId" => 1,
        "price" => 30000,
        "discount" => 0,
        "total" => 600000
    ],
    [
        "code" => '8993988111122',
        "name" => 'Glue stick lem batangan',
        "brand" => 'JOYKO',
        "stock" => 12,
        "unitId" => 1,
        "price" => 5000,
        "discount" => 0,
        "total" => 60000
    ],
    [
        "code" => '4970129727514',
        "name" => 'Spidol snowman',
        "brand" => 'Snowman',
        "stock" => 7,
        "unitId" => 1,
        "price" => 4000,
        "discount" => 0,
        "total" => 28000
    ],
    [
        "code" => '4970129732518',
        "name" => 'Refill Ink Snowman',
        "brand" => 'Snowman',
        "stock" => 9,
        "unitId" => 1,
        "price" => 5000,
        "discount" => 20,
        "total" => 56000
    ],
    [
        "code" => '8992221088252',
        "name" => 'Buku Sintaro 48LMBR',
        "brand" => 'Sintaro',
        "stock" => 13,
        "unitId" => 1,
        "price" => 8000,
        "discount" => 0,
        "total" => 112000
    ],
    [
        "code" => '8992221088508',
        "name" => 'Buku Sintaro 58LMBR',
        "brand" => 'Sintaro',
        "stock" => 15,
        "unitId" => 1,
        "price" => 6000,
        "discount" => 0,
        "total" => 90000
    ],
    [
        "code" => '8998838290231',
        "name" => 'Penghapus Joyko',
        "brand" => 'Joyko',
        "stock" => 14,
        "unitId" => 1,
        "price" => 4000,
        "discount" => 0,
        "total" => 60000
    ],
    [
        "code" => '4974052866074',
        "name" => 'Artline Supreme Stabilo',
        "brand" => 'Shachihata',
        "stock" => 20,
        "unitId" => 1,
        "price" => 3500,
        "discount" => 0,
        "total" => 70000
    ],
]);
    }
}
