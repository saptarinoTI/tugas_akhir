<?php

namespace App\Imports;

use App\Models\User;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Hash;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Illuminate\Support\Facades\Validator;
use RealRashid\SweetAlert\Facades\Alert;

class UsersImport implements ToCollection, WithHeadingRow
{
    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function collection(Collection $rows)
    {
        Validator::make($rows->toArray(), [
            '*.nim' => 'required',
            '*.name' => 'required',
        ])->validate();

        foreach ($rows as $row) {
            $users = User::where('id', '=', $row['nim'])->first();
            if (!$users) {
                $user = User::create([
                    'id' => $row['nim'],
                    'name' => $row['name'],
                    'password' => Hash::make('12345678'),
                ]);
                $user->assignRole('mahasiswa');
            }
        }
    }
}
