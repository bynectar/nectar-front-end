<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use App\Models\Thing;

class ThingSeeder extends Seeder {

	/**
	 * Run the admin seeder.
	 *
	 * @return void
	 */
	public function run()
	{
		
		// Create an instance of Faker
		$faker = Faker\Factory::create();
		
		for ($i=0;$i<100;$i++){
			
		    Thing::create([
		        'title'			=> $faker->text(80),
		        'description'	=> $faker->text(600),
	            'category_id'	=> $faker->numberBetween(1,10),
	            'user_id'		=> $faker->numberBetween(1,3)
		    ]);
		    
	    }
	    
	}

}
