<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use App\Models\Flower;
//use App\Models\Image;

class FlowerSeeder extends Seeder {

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
			
			// Create a review
	    $flower = Flower::create([
	        'common_name_1'   => $faker->text(80),
	        'common_name_2'   => $faker->text(80),
	        'common_name_3'   => $faker->text(80),
	        'latin_name'      => $faker->text(80),
	        'description'     => $faker->text(80),
	        'branches'        => $faker->boolean($chanceOfGettingTrue = 50),
	        'berries'         => $faker->boolean($chanceOfGettingTrue = 50),
	        'foliage'         => $faker->boolean($chanceOfGettingTrue = 50),
	        'spring'          => $faker->boolean($chanceOfGettingTrue = 50),
	        'summer'          => $faker->boolean($chanceOfGettingTrue = 50),
	        'fall'            => $faker->boolean($chanceOfGettingTrue = 50),
	        'winter'          => $faker->boolean($chanceOfGettingTrue = 50),
          'user_id'         => $faker->numberBetween(1,3)
//	        'image_mime'      => 'image/jpeg',
//	        'image_filename'  => 'test.jpeg',
//	        'image_title'     => $faker->text(80),
//	        'image_desc'      => $faker->text(80),
	    ]);
			    
			// Then save image
	    $image = [
	        'mime'            => 'image/jpeg',
	        'filename'        => 'test.jpeg',
          'title'           => $faker->text(30),
	        'description'     => $faker->text(80),
          'user_id'         => $flower->user_id
	    ];
			$flower->find($flower->id)->image()->save(new Image($image));
	
    }
	    
	}

}
