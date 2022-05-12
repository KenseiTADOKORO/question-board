<?php

use Illuminate\Database\Seeder;

class DepartmentsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('departments')->insert([
            'name' => '神学部',
            'university_id' => 1
        ]);
        
        DB::table('departments')->insert([
            'name' => '文学部',
            'university_id' => 1
        ]);
        
        DB::table('departments')->insert([
            'name' => '社会学部',
            'university_id' => 1
        ]);
        
        DB::table('departments')->insert([
            'name' => '法学部',
            'university_id' => 1
        ]);
        
        DB::table('departments')->insert([
            'name' => '経済学部',
            'university_id' => 1
        ]);
        
        DB::table('departments')->insert([
            'name' => '商学部',
            'university_id' => 1
        ]);
        
        DB::table('departments')->insert([
            'name' => '人間福祉学部',
            'university_id' => 1
        ]);
        
        DB::table('departments')->insert([
            'name' => '国際学部',
            'university_id' => 1
        ]);
        
        DB::table('departments')->insert([
            'name' => '教育学部',
            'university_id' => 1
        ]);
        
        DB::table('departments')->insert([
            'name' => '総合政策学部',
            'university_id' => 1
        ]);
        
        DB::table('departments')->insert([
            'name' => '理学部',
            'university_id' => 1
        ]);
        
        DB::table('departments')->insert([
            'name' => '工学部',
            'university_id' => 1
        ]);
        
        DB::table('departments')->insert([
            'name' => '生命環境学部',
            'university_id' => 1
        ]);
        
        DB::table('departments')->insert([
            'name' => '建築学部',
            'university_id' => 1
        ]);
    }
}
