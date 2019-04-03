<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\User::class, 1000)->create();

        $firstUser = App\User::first();
        $firstUser->email = 'candidato@eskive.tech';
        $firstUser->save();

        dump("FIRST_USER_EMAIL=$firstUser->email");
        dump("FIRST_USER__PASSWORD=123");
    }
}
