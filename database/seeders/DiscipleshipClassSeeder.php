<?php

namespace Database\Seeders;

use App\Models\DiscipleshipClass;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DiscipleshipClassSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        if(DiscipleshipClass::count() > 0){
            return ;
        }

        $discipleshipClass = new DiscipleshipClass();
        $discipleshipClass->name = 'The New Creation';
        $discipleshipClass->save();

        $discipleshipClass = new DiscipleshipClass();
        $discipleshipClass->name = 'The Holy Spirit';
        $discipleshipClass->save();

        $discipleshipClass = new DiscipleshipClass();
        $discipleshipClass->name = 'The Holy Spirit And Tounges';
        $discipleshipClass->save();

        $discipleshipClass = new DiscipleshipClass();
        $discipleshipClass->name = 'Kingdom Stewardship';
        $discipleshipClass->save();

        $discipleshipClass = new DiscipleshipClass();
        $discipleshipClass->name = 'Welcome to Newbreed';
        $discipleshipClass->save();
    }
}
