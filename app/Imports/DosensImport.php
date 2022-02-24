<?php

namespace App\Imports;

use App\Models\Dosen;
use App\Models\User;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Hash;
use Maatwebsite\Excel\Concerns\ToCollection;

class DosensImport implements ToCollection
{
    /**
     * @param Collection $collection
     */
    public function collection(Collection $collection)
    {
        foreach ($collection as $row) {
            $dosen = Dosen::create([
                'id' => $row[0],
                'nama' => $row[1]
            ]);
            $user = User::create([
                'id' => $row[0],
                'name' => $row[1],
                'password' => Hash::make('12345678'),
            ]);
            $user->assignRole('dosen');
        }
    }
}
