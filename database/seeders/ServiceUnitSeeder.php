<?php

namespace Database\Seeders;

use App\Models\ServiceUnit;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ServiceUnitSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        if(ServiceUnit::count() > 0){
            return ;
        }

        $serviceUnit = new ServiceUnit();
        $serviceUnit->name = 'Nexus';
        $serviceUnit->save();

        $serviceUnit = new ServiceUnit();
        $serviceUnit->name = 'GloryBrook';
        $serviceUnit->save();

        $serviceUnit = new ServiceUnit();
        $serviceUnit->name = 'Sanctuary';
        $serviceUnit->save();

        $serviceUnit = new ServiceUnit();
        $serviceUnit->name = 'Guiding Light';
        $serviceUnit->save();

        $serviceUnit = new ServiceUnit();
        $serviceUnit->name = 'Children Church';
        $serviceUnit->save();

        $serviceUnit = new ServiceUnit();
        $serviceUnit->name = 'Protocol';
        $serviceUnit->save();

        $serviceUnit = new ServiceUnit();
        $serviceUnit->name = 'Ambience';
        $serviceUnit->save();
    }
}
