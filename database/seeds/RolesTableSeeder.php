<?php

use Illuminate\Database\Seeder;

class RolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	$roles = array(
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
        	)
        );

        foreach ($roles as $key => $role) {
        	factory(App\Role::class)->create([
	       		'name' => $role['name']
	       	]);
        }
    }
}
