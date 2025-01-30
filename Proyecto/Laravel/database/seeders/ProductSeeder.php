<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;


class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
         // Lee el archivo JSON desde database/data/products.json
         $json = Storage::get('database/data/products.json');
         $products = json_decode($json, true);
 
         // Inserta los datos en la tabla 'productos'
         DB::table('productos')->insert($products);
    }
}
