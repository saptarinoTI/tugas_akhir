<?php

namespace Database\Seeders;

use App\Models\Dosen;
use Illuminate\Database\Seeder;

class DosenSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Dosen::insert(
            [
                [
                    'id' => '05030104',
                    'nama' => 'hardianto, S.T., M.Eng.',
                ],
                [
                    'id' => '05010102',
                    'nama' => 'herri susanto, S.S., M.Hum.',
                ],
                [
                    'id' => '09010107',
                    'nama' => 'lapu tombilayuk, S.Kom., M.T.',
                ],
                [
                    'id' => '11040110',
                    'nama' => 'turahyo, S.T., M.Eng.',
                ],
                [
                    'id' => '09010108',
                    'nama' => 'nur imansyah, S.Kom., M.Kom.',
                ],
                [
                    'id' => '11040111',
                    'nama' => 'sri handani widiastuti, S.Kom., M.Kom.',
                ],
                [
                    'id' => '17090118',
                    'nama' => 'rio jumardi, S.T., M.Eng.',
                ],
                [
                    'id' => '16080115',
                    'nama' => 'zaini, S.Pd., M.Pd.',
                ],
                [
                    'id' => '05030105',
                    'nama' => 'abdul zain, S.T., M.T.',
                ],
                [
                    'id' => '16080116',
                    'nama' => 'abadi nugroho, S.Kom., M.Kom.',
                ],
                [
                    'id' => '16080117',
                    'nama' => 'arfittaria, S.T., M.T.',
                ],
            ]
        );
    }
}
