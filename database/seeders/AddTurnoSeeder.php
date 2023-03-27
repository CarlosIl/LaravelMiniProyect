<?php

namespace Database\Seeders;

use App\Models\Horario;
use App\Models\Lineas_turno;
use App\Models\Turno;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AddTurnoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $turnos = [
            [
                'descripcion' => 'TURNO GENERAL INVIERNO',
            ],
            [
                'descripcion' => 'CONSERJES JUVENTUD',
            ],
            [
                'descripcion' => 'TURNO GENERAL VERANO',
            ],
            [
                'descripcion' => 'TURNO SEMANA FIESTAS',
            ],
            [
                'descripcion' => 'TURNO POLICIAL ALTERNO MAÑANA DE 6 A 14',
            ],
        ];

        Turno::insert($turnos);

        $horario = [
            [
                'descripcion' => 'FESTIVOS',
            ],
            [
                'descripcion' => 'DE 8:00 A 15:00',
            ],
            [
                'descripcion' => 'DE 15:00 A 22:00',
            ],
            [
                'descripcion' => 'DE 17:00 A 23:00',
            ],
            [
                'descripcion' => 'DE 9:00 A 14:00',
            ],
        ];

        Horario::insert($horario);

        $dia = [
            [
                'dia' => 1,
                'id_turno' => 1,
                'id_horario' => 2
            ],
            [
                'dia' => 1,
                'id_turno' => 2,
                'id_horario' => 3
            ],
        ];

        Lineas_turno::insert($dia);
    }
}
