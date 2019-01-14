<?php

use Illuminate\Database\Seeder;

class DefaultTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	// types
    	$types = array(
    		array(
    			'code' => 'medicine',
    			'description' => 'medicine'
    		),
    		array(
    			'code' => 'room',
    			'description' => 'room',
    		),
    		array(
    			'code' => 'laboratory',
    			'description' => 'laboratory',
    		),
    		array(
    			'code' => 'others',
    			'description' => 'others'
    		)
    	);

    	foreach ($types as $key => $type) {
        	factory(App\Type::class)->create([
	       		'code' => $type['code'],
	       		'description' => $type['description']
	       	]);
        }
    	
    	// user roles
        $roles = array(
            array(
                'name' => 'super admin'
            ),
        	array(
        		'name' => 'admin'
        	),
        	array(
        		'name' => 'doctor'
        	),
        	array(
        		'name' => 'staff'
        	),
        	array(
        		'name' => 'nurse'
        	),
            array(
                'name' => 'patient'
            )
        );

        foreach ($roles as $key => $role) {
        	factory(App\Role::class)->create([
	       		'name' => $role['name']
	       	]);
        }

        // default users
        factory(App\User::class)
    	->create([
       		'first_name' => 'superadmin',
            'middle_name' => 'superadmin',
            'last_name' => 'superadmin',
            'username' => 'superadmin',
            'email' => 'superadmin@superadmin.com',
            'email_verified_at' => now(),
            'password' => bcrypt('superadmin')
	    ])->each(function ($user) {
             $user->user_role()->save(factory(App\UserRole::class)->make([
                'user_id' => $user->id,
                'role_id' => 1
            ]));
        });

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
                'role_id' => 2
            ]));
        });
    }
}
