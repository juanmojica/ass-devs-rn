<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Str;



class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
         \App\Models\Anuidade::factory(5)->create();
         \App\Models\Associado::factory(20)->create();

         $adminUser = [
            'name' => 'João Paulo',
            'email' => 'jp@devsrn.com',
            'email_verified_at' => now(),
            'admin' => 1,
            'password' => bcrypt('123'), // password
            'remember_token' => Str::random(10),
         ];

         $user = [
            'name' => 'Paulo André',
            'email' => 'pa@devsrn.com',
            'email_verified_at' => now(),
            'password' => bcrypt('456'), // password
            'remember_token' => Str::random(10),
        ];


         \App\Models\User::factory(1)->createOne($adminUser);
         \App\Models\User::factory(1)->createOne($user);

    }
}
