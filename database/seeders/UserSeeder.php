<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        if (\count(User::all())<=0) {
            User::create([
                "nom"=>"Sala",
                "prenom"=>"Vin",            
                "sexe"=>"M",
                "telephone"=>"068583366",
                "email"=>"g.rare20cent@gmail.com",
                "password"=>Hash::make('0000'),
            ]);
        }
    }
}
