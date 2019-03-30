<?php

use Illuminate\Database\Seeder;

class CategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $Categories=[
            'title'=>'Sample Category',
            'slug'=>'sample Category'
        ];
        DB::table('Categories')->insert($Categories);
    }
}
