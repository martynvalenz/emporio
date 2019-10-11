<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use Emporio\Model\LoginImagenes;

class LoginImagenesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = array
    	(
    		[
    			'imagen' => 'chihuahua-de-noche-princ-min.jpg',
    			'principal' => '0',
    			'estatus' => '1',
    			'created_at' => new DateTime,
    			'updated_at' => new DateTime
    		],
    		[
    			'imagen' => 'chihuahua1.jpg',
    			'principal' => '0',
    			'estatus' => '1',
    			'created_at' => new DateTime,
    			'updated_at' => new DateTime
    		],
    		[
    			'imagen' => 'museos-en-chihuahua.jpg',
    			'principal' => '0',
    			'estatus' => '1',
    			'created_at' => new DateTime,
    			'updated_at' => new DateTime
    		],
    		[
    			'imagen' => '15457258283_4b47bed061_b.jpg',
    			'principal' => '0',
    			'estatus' => '1',
    			'created_at' => new DateTime,
    			'updated_at' => new DateTime
    		],
    		[
    			'imagen' => 'Chihuahua-1184498080-L.jpg',
    			'principal' => '0',
    			'estatus' => '1',
    			'created_at' => new DateTime,
    			'updated_at' => new DateTime
    		],
            [
                'imagen' => 'cuu.jpg',
                'principal' => '1',
                'estatus' => '1',
                'created_at' => new DateTime,
                'updated_at' => new DateTime
            ],
    	);

    	LoginImagenes::insert($data);
    }
}
