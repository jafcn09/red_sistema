<?php

use Illuminate\Database\Seeder;
use  App\RoleUser;

class RoleUserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        RoleUser::create([
            'role_id'          =>  '1',
            'user_id'          =>  '1',
            'created_at'       => now(),
            'updated_at'       => now(),
        ]);
        RoleUser::create([
            'role_id'          =>  '2',
            'user_id'          =>  '3',
            'created_at'       => now(),
            'updated_at'       => now(),
        ]);
        RoleUser::create([
            'role_id'          =>  '2',
            'user_id'          =>  '4',
            'created_at'       => now(),
            'updated_at'       => now(),
        ]);
        RoleUser::create([
            'role_id'          =>  '3',
            'user_id'          =>  '2',
            'created_at'       => now(),
            'updated_at'       => now(),
        ]);
    }
}
