<?php

use Illuminate\Database\Seeder;

class LocationsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('devices')->delete();
        DB::table('locations')->delete();

        $locations = [
            ['id' => 1, 'name' => 'Villach',  'created_at' => new DateTime(), 'updated_at' => new DateTime()],
            ['id' => 2, 'name' => 'Klagenfurt', 'created_at' => new DateTime(), 'updated_at' => new DateTime()],
        ];

        DB::table('locations')->insert($locations);
    }
}
