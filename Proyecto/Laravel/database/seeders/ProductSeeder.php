<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $jsonPath=database_path('data/products.json');
        if(!File::exists($jsonPath)){
            $this->command->error("No se ha encontrado el archivo.");
            return;
        }
         // Lee el archivo JSON desde database/data/products.json
         $jsonContent = File::get($jsonPath);
         $products = json_decode($jsonContent, true);
        
         if ($products === null) {
            $this->command->error("El archivo JSON está vacío o tiene un fallo.");
            return;
        }
         // Inserta los datos en la tabla 'productos'
         DB::table('productos')->insert($products);
    }
}
