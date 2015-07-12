<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Zizaco\Entrust\EntrustRole;
use Zizaco\Entrust\EntrustPermission;
use Zizaco\Entrust\HasRole;
use App\User;
use App\Models\Role;

class AdminSeeder extends Seeder {

	/**
	 * Run the admin seeder.
	 *
	 * @return void
	 */
	public function run()
	{
				
		// Create Super Admin Role
		Role::firstOrCreate([
			'name' => 'super_admin',
			'display_name' => 'Super Admin',
			'description' => 'capo di tutti capi, admin of the admins.',
		]);
		$superadmin_role = Role::where('name','=','super_admin')->first();
		
		// Create Super Admin User
		$superadmin_user = User::firstOrCreate([
			'name' => 'super',
			'email' => 'jlivornese@gmail.com',
			'password' => Hash::make( 'admin' ),
		])->first();
		
		// Attach Super Admin Role
		if (!$superadmin_user->hasRole('admin_role_name')) {
			$superadmin_user->attachRole( $superadmin_role->id );
		}
		$this->command->info('Admin user seeded :-)');
		
		// Create Test Users
		$test_user_1 = User::firstOrCreate([
			'name' => 'Test User 1',
			'email' => 'test1@reviewandme.com',
			'password' => Hash::make( 'admin' ),
		])->first();
		$test_user_1 = User::firstOrCreate([
			'name' => 'Test User 2',
			'email' => 'test2@reviewandme.com',
			'password' => Hash::make( 'admin' ),
		])->first();
		$this->command->info('Test users seeded :-)');
	}

}
