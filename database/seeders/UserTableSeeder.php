<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::factory(5)->create();

        $userAdmin = User::first();
        $userAdmin->name = 'Operator Sekolah';
        $userAdmin->email = 'admin@gmail.com';
        $userAdmin->username = 'admin';
        $userAdmin->password = Hash::make('123456');
        $userAdmin->save();

        $userGuru = User::find(2);
        $userGuru->name = 'Kurniati';
        $userGuru->username = 'kurniati';
        $userGuru->email = 'kurniati@gmail.com';
        $userGuru->password = Hash::make('123456');


        $userGuru->save();

        $userSiswa = User::find(3);
        $userSiswa->name = 'Vikar Maulana Arrisyad';
        $userSiswa->email = 'vikar@gmail.com';
        $userSiswa->username = 'vikar';
        $userSiswa->password = Hash::make('12345678');

        $userSiswa->save();

        $userOrtu = User::find(4);
        $userOrtu->name = 'Emi Fatikha';
        $userOrtu->email = 'emifatikha@gmail.com';
        $userOrtu->username = 'emi';
        $userOrtu->password = Hash::make('12345678');


        $userSiswa->save();


        $userAdmin->assignRole('admin');
        $userGuru->assignRole('guru');
        $userSiswa->assignRole('siswa');
        $userOrtu->assignRole('ortu');
    }
}
