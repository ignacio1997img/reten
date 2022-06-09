<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class BranchofficesTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('branchoffices')->delete();
        
        \DB::table('branchoffices')->insert(array (
            0 => 
            array (
                'id' => 1,
                'name' => 'Casarabe',
                'description' => NULL,
                'status' => 1,
                'created_at' => '2022-04-20 12:42:08',
                'updated_at' => '2022-04-20 12:42:08',
                'deleted_at' => NULL,
            ),
            1 => 
            array (
                'id' => 2,
                'name' => 'El Carmen',
                'description' => NULL,
                'status' => 1,
                'created_at' => '2022-04-20 12:42:26',
                'updated_at' => '2022-04-20 12:42:26',
                'deleted_at' => NULL,
            ),
            2 => 
            array (
                'id' => 3,
                'name' => 'Trinidad',
                'description' => NULL,
                'status' => 1,
                'created_at' => '2022-04-20 12:42:38',
                'updated_at' => '2022-04-20 12:42:38',
                'deleted_at' => NULL,
            ),
            3 => 
            array (
                'id' => 4,
                'name' => 'Loreto',
                'description' => NULL,
                'status' => 1,
                'created_at' => '2022-04-20 12:42:47',
                'updated_at' => '2022-04-20 12:42:47',
                'deleted_at' => NULL,
            ),
            4 => 
            array (
                'id' => 5,
                'name' => 'La Palca',
                'description' => NULL,
                'status' => 1,
                'created_at' => '2022-04-20 12:43:01',
                'updated_at' => '2022-04-20 12:43:01',
                'deleted_at' => NULL,
            ),
            5 => 
            array (
                'id' => 6,
                'name' => 'Santa Ana',
                'description' => NULL,
                'status' => 1,
                'created_at' => '2022-04-20 12:43:11',
                'updated_at' => '2022-04-20 12:43:11',
                'deleted_at' => NULL,
            ),
            6 => 
            array (
                'id' => 7,
                'name' => 'San Ramon',
                'description' => NULL,
                'status' => 1,
                'created_at' => '2022-04-20 12:43:19',
                'updated_at' => '2022-04-20 12:43:19',
                'deleted_at' => NULL,
            ),
            7 => 
            array (
                'id' => 8,
                'name' => 'Magdalena',
                'description' => NULL,
                'status' => 1,
                'created_at' => '2022-04-20 12:43:31',
                'updated_at' => '2022-04-20 12:43:31',
                'deleted_at' => NULL,
            ),
            8 => 
            array (
                'id' => 9,
                'name' => 'Guayaramerin',
                'description' => NULL,
                'status' => 1,
                'created_at' => '2022-04-20 12:43:47',
                'updated_at' => '2022-04-20 12:43:47',
                'deleted_at' => NULL,
            ),
            9 => 
            array (
                'id' => 10,
                'name' => 'Cachuela',
                'description' => NULL,
                'status' => 1,
                'created_at' => '2022-04-20 12:43:54',
                'updated_at' => '2022-04-20 12:43:54',
                'deleted_at' => NULL,
            ),
        ));
        
        
    }
}