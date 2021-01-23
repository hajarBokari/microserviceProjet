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
        $actors = array (
            array (
                'id' => '1',
                'nom' => 'François Truffaut'
            ),
            array (
                'id' => '2',
                'nom' => 'Alfred Hitchcock'
            ),
            array (
                'id' => '3',
                'nom' => 'Federico Fellini'
            ),
            array (
                'id' => '4',
                'nom' => 'Alain Resnais'
            ),
        );
        $faker = \Faker\Factory::create();
        for($i=0; $i<4;$i++):
            \DB::table('acteurs')
                ->insert([
                    'nom' => $actors[$i]['nom'],
                    'id'  => $actors[$i]['id']
                ]);
        endfor;
    }
}
