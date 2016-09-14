<?php

use Illuminate\Database\Seeder;
use Carbon\Carbon;

class AdminUserSeeder extends Seeder
{

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'name'       => 'Dein Name',
            'email'      => 'test@test.de',
            'password'   => bcrypt('test'),
            'role_id'    => 1,
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
        ]);
    }

}
