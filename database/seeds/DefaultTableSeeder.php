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

        factory(App\User::class, 20)
        ->create([
            'is_user' => 0
        ])->each(function ($user) {
             $user->user_role()->save(factory(App\UserRole::class)->make([
                'user_id' => $user->id,
                'role_id' => 6
            ]));
        });

        // factory(App\Diagnose::class, 20)->create();

        $typeOfRecords = array(
            array(
                'code' => 'Out Patient',
                'description' => 'Out Patient',
                'price' => 300
            ),
            array(
                'code' => 'In Patient',
                'description' => 'In Patient',
                'price' => 0
            ),
        );

        // for type of records
        foreach ($typeOfRecords as $key => $typeOfRecord) {
            factory(App\TypeOfCharge::class)->create([
                'code' => $typeOfRecord['code'],
                'description' => $typeOfRecord['description'],
                'price' => $typeOfRecord['price'],
                'type_id' => 4
            ]);
        }

        $typeOfRooms = array(
            array(
                'code' => 'Private Room',
                'description' => 'Private Room',
                'price' => 1000
            ),
            array(
                'code' => 'Semi-Private Room',
                'description' => 'Semi-Private Room',
                'price' => 500
            ),
            array(
                'code' => 'Regular Room',
                'description' => 'Regular Room',
                'price' => 300
            ),
        );

        // for type of room
        foreach ($typeOfRooms as $key => $typeOfRoom) {
            factory(App\TypeOfCharge::class)->create([
                'code' => $typeOfRoom['code'],
                'description' => $typeOfRoom['description'],
                'price' => $typeOfRoom['price'],
                'type_id' => 2
            ]);
        }

        for ($i=1; $i <= 5; $i++) { 
            factory(App\Floor::class)->create([
                'code' => 'Floor ' . $i,
                'description' => 'Floor ' . $i,
            ]);
        }

        for ($i=1; $i <= 10; $i++) { 
            $roomType = rand(3, 5);
            factory(App\Room::class)->create([
                'code' => 'Room '. $i,
                'floor_id' => rand(1,5),
                'type_of_charge_id' => $roomType,
                'capacity' => $roomType == 3 ? 1 : 5,
                'description' => 'Room ' . $i
            ]);
        }
    }
}
