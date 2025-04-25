<?php

namespace Database\Seeders;

use App\Models\Typelocation;
use Illuminate\Database\Seeder;

class TypeLocationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
       if (\count(Typelocation::all())<=0) {
        Typelocation::create(
            [
               'type'=>'heure' 
            ],            
        );

        Typelocation::create(
            [
               'type'=>'jour' 
            ],            
        );

        Typelocation::create(
            [
               'type'=>'semaine' 
            ],            
        );

        Typelocation::create(
            [
               'type'=>'mois' 
            ],            
        );
       }
    }
}
