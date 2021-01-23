<?php

namespace Database\Seeders;

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
        \DB::table('microservices')
            ->insert([[
                'nom' =>'movies',
                'base_url' => 'http://localhost:8002',
                'token' =>base64_encode('movies:20nomalis21')
                ],
                [
                'nom' =>'actors',
                'base_url' =>'http://localhost:8001' ,
                'token' =>base64_encode('actors:20nomalis21')
                ],
                [
                'nom' =>'gateway',
                'base_url' =>'http://localhost:8000' ,
                'token' =>base64_encode('gateway:20nomalis21')
                ]]
            );
    }
}
