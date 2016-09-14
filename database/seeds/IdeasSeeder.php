<?php

use Illuminate\Database\Seeder;
use Carbon\Carbon;
use Faker\Factory as Faker;

class IdeasSeeder extends Seeder
{

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

//        $faker = Faker::create();
//        foreach (range(1, 12) as $index)
//        {
//            $power = ['Sehr stark', 'Stark', 'Mittel', 'Schwach', 'Sehr schwach'];
//
//            DB::table('ideas')->insert([
//                'name'               => $faker->name,
//                'searchvolume'       => $faker->numberBetween(0, 500000),
//                'cpc'                => $faker->randomFloat(2, 0, 3),
//                'idea_category_id'   => $faker->numberBetween(1, 6),
//                'provision'          => $faker->numberBetween(1, 10),
//                'buy_conversion'     => $faker->randomFloat(2, 0, 3),
//                'price_per_product'  => $faker->numberBetween(5, 780),
//                'partner_program_id' => $faker->numberBetween(1, 3),
//                'seasonal'           => $faker->numberBetween(0, 1),
//                'keywords'           => $faker->name . "\r\n" . $faker->name . "\r\n" . $faker->name,
//                'domains'            => $faker->domainName,
//                'competition_power'  => $power[array_rand($power)],
//                'ranking'            => $faker->numberBetween(1, 5),
//                'user_id'            => $faker->numberBetween(1, 2),
//                'created_at'         => Carbon::now()->format('Y-m-d H:i:s'),
//                'updated_at'         => Carbon::now()->format('Y-m-d H:i:s'),
//            ]);
//        }
    }

}
