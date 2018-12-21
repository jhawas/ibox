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
    	factory(App\User::class)
    	->create([
       		'first_name' => 'Admin',
            'middle_name' => 'Admin',
            'last_name' => 'Admin',
            'username' => 'admin',
            'email' => 'admin@admin.com',
            'email_verified_at' => now(),
            'password' => bcrypt('admin')
	    ])->each(function ($user) {
             $user->user_role()->save(factory(App\UserRole::class)->make([
                'user_id' => $user->id,
                'role_id' => 1
            ]));
        });
    }
}
