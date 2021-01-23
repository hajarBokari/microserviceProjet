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
        // $this->call('UsersTableSeeder');
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
        for($i=0; $i<=50; $i++):
            DB::table('films')
                ->insert([
                    'nom' => $faker->userName,
                    'annee' => $faker->numberBetween(1980,2021),
                    'acteurs' => serialize($actors)
                ]);
        endfor;
    }
}
