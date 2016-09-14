<?php

use Illuminate\Database\Seeder;
use Carbon\Carbon;
use Faker\Factory as Faker;

class KeywordTableSeeder extends Seeder
{

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

//        $faker = Faker::create();
//        foreach (range(1, 20) as $index)
//        {
//
//            DB::table('keywords')->insert([
//                'name'         => $faker->word,
//                'note'         => $faker->paragraph,
//                'searchvolume' => $faker->numberBetween(0, 500000),
//                'cpc'          => $faker->randomFloat(2, 0, 3),
//                'project_id'   => $faker->numberBetween(1, 3),
//                'has_content'  => $faker->numberBetween(0, 1),
//                'position'     => $faker->numberBetween(0, 100),
//                'created_at'   => Carbon::now()->format('Y-m-d H:i:s'),
//                'updated_at'   => Carbon::now()->format('Y-m-d H:i:s'),
//            ]);
//        }
    }

}
