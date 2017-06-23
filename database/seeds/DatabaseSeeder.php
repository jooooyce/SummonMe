<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
   	DB::table('tblProvinceTerrorities')->insert(
            array(
                array('province' => 'Alberta', 'abbreviation' => 'AB'),
		array('province' => 'British Columbia', 'abbreviation' => 'BC'),
		array('province' => 'Manitoba', 'abbreviation' => 'MB'),
		array('province' => 'New Brunswick', 'abbreviation' => 'NB'),
                array('province' => 'Newfoundland and Labrador', 'abbreviation' => 'NL'),
		array('province' => 'Northwest Territories', 'abbreviation' => 'NT'),
		array('province' => 'Nova Scotia', 'abbreviation' => 'NS'),
		array('province' => 'Nunavut', 'abbreviation' => 'NU'),
                array('province' => 'Ontario', 'abbreviation' => 'ON'),
		array('province' => 'Prince Edward Island', 'abbreviation' => 'PE'),
		array('province' => 'Quebec', 'abbreviation' => 'QC'),
		array('province' => 'Saskatchewan', 'abbreviation' => 'SK'),
                array('province' => 'Yukon', 'abbreviation' => 'YT') 
 
    	));

    }
}
