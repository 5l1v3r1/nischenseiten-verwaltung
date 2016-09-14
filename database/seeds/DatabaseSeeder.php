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
        $this->call(RolesSeeder::class);
        $this->call(AdminUserSeeder::class);
        $this->call(UserSeeder::class);
        $this->call(IdeasCategorySeeder::class);
        $this->call(PartnerProgramSeeder::class);
        $this->call(IdeasSeeder::class);
        $this->call(ProjectsSeeder::class);
        $this->call(NoteTableSeeder::class);
        $this->call(ContentTableSeeder::class);
        $this->call(KeywordTableSeeder::class);
        $this->call(CompetitionTableSeeder::class);
        $this->call(OptionTableSeeder::class);
    }

}
