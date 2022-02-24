<?php

namespace Database\Seeders;

use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = new User();
        $user->id = '281099';
        $user->name = 'saptarino';
        $user->email = 'saptarino.ti@gmail.com';
        $user->email_verified_at = Carbon::now();
        $user->password = Hash::make('!rino12345');
        $user->save();
        $user->assignRole(['superadmin']);

        $dosen = new User();
        $dosen->id = '05030104';
        $dosen->name = 'hardianto, S.T., M.Eng.';
        $dosen->password = Hash::make('12345678');
        $dosen->save();
        $dosen->assignRole(['dosen']);

        $dosen1 = new User();
        $dosen1->id = '05010102';
        $dosen1->name = 'herri susanto, S.S., M.Hum.';
        $dosen1->password = Hash::make('12345678');
        $dosen1->save();
        $dosen1->assignRole(['dosen']);

        $dosen2 = new User();
        $dosen2->id = '09010107';
        $dosen2->name = 'lapu tombilayuk, S.Kom., M.T.';
        $dosen2->password = Hash::make('12345678');
        $dosen2->save();
        $dosen2->assignRole(['dosen']);

        $dosen3 = new User();
        $dosen3->id = '11040110';
        $dosen3->name = 'turahyo, S.T., M.Eng.';
        $dosen3->password = Hash::make('12345678');
        $dosen3->save();
        $dosen3->assignRole(['dosen']);

        $dosen4 = new User();
        $dosen4->id = '09010108';
        $dosen4->name = 'nur imansyah, S.Kom., M.Kom.';
        $dosen4->password = Hash::make('12345678');
        $dosen4->save();
        $dosen4->assignRole(['dosen']);

        $dosen5 = new User();
        $dosen5->id = '11040111';
        $dosen5->name = 'sri handani widiastuti, S.Kom., M.Kom.';
        $dosen5->password = Hash::make('12345678');
        $dosen5->save();
        $dosen5->assignRole(['dosen']);

        $dosen6 = new User();
        $dosen6->id = '17090118';
        $dosen6->name = 'rio jumardi, S.T., M.Eng.';
        $dosen6->password = Hash::make('12345678');
        $dosen6->save();
        $dosen6->assignRole(['dosen']);

        $dosen7 = new User();
        $dosen7->id = '16080115';
        $dosen7->name = 'zaini, S.Pd., M.Pd.';
        $dosen7->password = Hash::make('12345678');
        $dosen7->save();
        $dosen7->assignRole(['dosen']);

        $dosen8 = new User();
        $dosen8->id = '05030105';
        $dosen8->name = 'abdul zain, S.T., M.T.';
        $dosen8->password = Hash::make('12345678');
        $dosen8->save();
        $dosen8->assignRole(['dosen']);

        $dosen9 = new User();
        $dosen9->id = '16080116';
        $dosen9->name = 'abadi nugroho, S.Kom., M.Kom.';
        $dosen9->password = Hash::make('12345678');
        $dosen9->save();
        $dosen9->assignRole(['dosen']);

        $dosen10 = new User();
        $dosen10->id = '16080117';
        $dosen10->name = 'arfittaria, S.T., M.T.';
        $dosen10->password = Hash::make('12345678');
        $dosen10->save();
        $dosen10->assignRole(['dosen']);
    }
}
