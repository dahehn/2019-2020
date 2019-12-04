<?php

use Illuminate\Database\Seeder;

class DevicesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $devices = [
            ['id' => 1,'created_at' => new DateTime(), 'updated_at' => new DateTime(),'vendor'=>'HP','model' => 'ProLiant','year'=>'2015','borrowed'=>true,'location_id'=>1],
            ['id' => 2, 'created_at' => new DateTime(), 'updated_at' => new DateTime(),'vendor'=>'HP','model' => 'ProLiant','year'=>'2015','borrowed'=>false,'location_id'=>2],
            ['id' => 3, 'created_at' => new DateTime(), 'updated_at' => new DateTime(),'vendor'=>'Nikon','model' => 'D50','year'=>'2010','borrowed'=>true,'location_id'=>2],
            ['id' => 4, 'created_at' => new DateTime(), 'updated_at' => new DateTime(),'vendor'=>'Nikon','model' => 'D50','year'=>'2011','borrowed'=>false,'location_id'=>1],
            ['id' => 5, 'created_at' => new DateTime(), 'updated_at' => new DateTime(),'vendor'=>'Nikon','model' => 'D50','year'=>'2012','borrowed'=>false,'location_id'=>2],
        ];
        DB::table('devices')->insert($devices);
    }
}
