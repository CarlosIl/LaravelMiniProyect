<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use App\Models\Categoria;

class CategoriaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            [
                'descripcion' => 'Administración de servidores',
            ],
            [
                'descripcion' => 'Desarrollo web',
            ],
            [
                'descripcion' => 'Desarrallo aplicaciones',
            ],
        ];
        Categoria::insert($data);
    }
}
