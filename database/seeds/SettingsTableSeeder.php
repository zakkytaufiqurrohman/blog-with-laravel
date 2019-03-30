<?php

use Illuminate\Database\Seeder;

class SettingsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $data=[
            'title'=>'blog',
            'tagline'=>'laravel framwork',
            'email'=>'zataufiq@gmail.com',
            'phone'=>'086799410422',
            'address'=>'sadewa 01',
            'so_facebook'=>'http/facebok',
            'so_twitter'=>'http/twitter',
            'so_instagram'=>'http/instagram'
        ];
        DB::table('settings')->insert($data);
    }
}
