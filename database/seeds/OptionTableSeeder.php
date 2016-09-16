<?php

use Illuminate\Database\Seeder;
use Carbon\Carbon;

class OptionTableSeeder extends Seeder
{

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('options')->insert([
            'id'         => '1',
            'name'       => 'apimetrics_api',
            'full_name'  => 'API Key (metrics.tools)',
            'value'      => '',
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
        ]);
        
        DB::table('options')->insert([
            'id'         => '2',
            'name'       => 'sistric_api',
            'full_name'  => 'API Key (Sistrix)',
            'value'      => '',
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
        ]);
        
        
        
        DB::table('options')->insert([
            'id'         => '3',
            'name'       => 'backlinks_to_check',
            'full_name'  => 'Backlinkchecker (Anzahl pro Ausführung)',
            'value'      => '20',
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
        ]);
        
        DB::table('options')->insert([
            'id'         => '4',
            'name'       => 'keywords_to_check',
            'full_name'  => 'Keyword (Tage zwischen Prüfungen)',
            'value'      => '30',
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
        ]);
        
        DB::table('options')->insert([
            'id'         => '5',
            'name'       => 'ideas_to_check',
            'full_name'  => 'Ideas (Tage zwischen Prüfungen)',
            'value'      => '30',
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
        ]);
        
        DB::table('options')->insert([
            'id'         => '6',
            'name'       => 'backlinkchecker_days_between_check',
            'full_name'  => 'Backlinkchecker (Tage zwischen Prüfungen)',
            'value'      => '7',
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
        ]);
        
        DB::table('options')->insert([
            'id'         => '7',
            'name'       => 'keywords_days_between_check',
            'full_name'  => 'Projektkeywordschecker (Tage zwischen Prüfungen)',
            'value'      => '7',
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
        ]);
        
        DB::table('options')->insert([
            'id'         => '8',
            'name'       => 'idea_days_between_check',
            'full_name'  => 'Keywords in Ideen (Tage zwischen Prüfungen)',
            'value'      => '7',
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
        ]);
    }

}
