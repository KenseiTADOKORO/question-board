<?php

use Illuminate\Database\Seeder;

class UniversitiesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('universities')->insert([
            'name' => '関西学院大学'
        ]);
        
        DB::table('universities')->insert([
            'name' => '関西大学'
        ]);
        
        DB::table('universities')->insert([
            'name' => '同志社大学'
        ]);
        
        DB::table('universities')->insert([
            'name' => '立命館大学'
        ]);
    }
}
