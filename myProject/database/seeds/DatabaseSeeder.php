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
        // $this->call(UsersTableSeeder::class);
        $faker = Faker\Factory::create();
        for ($i = 0; $i < 25; $i++) {
            DB::table('candidates')->insert([
                'name' => $faker->name(),
                'sex' => $faker->numberBetween(1,3),
                'birthday' =>$faker->dateTimeBetween($startDate = '-30 years', $endDate = 'now'),
                'image_url' => '/app/public/images/default.png',
                'graduated_year' => $faker->numberBetween(1900,2021)
            ]);
        }
    }
}
