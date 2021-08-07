<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class UsersSeeder extends Seeder
{
    public function run()
    {
        $users = [
            [
                'name' => 'Сергей',
                'email' => 'pariss8@mail.ru',
                'slug' => Str::slug('pariss8@mail.ru'),
                'img' => '/assets/app/img/anonymous.min.jpg',
                'password' => bcrypt('12345678')
            ],
            [
                'name' => 'User1',
                'email' => 'fake1@mail.ru',
                'slug' => Str::slug('fake1@mail.ru'),
                'img' => '/assets/app/img/anonymous.min.jpg',
                'password' => bcrypt('12345678')
            ],
           /* [
                'name' => 'User2',
                'email' => 'fake2@mail.ru',
                'password' => bcrypt('12345678')
            ],*/
        ];

        DB::table('users')->insert($users);
    }
}
