<?php

namespace Database\Seeders;


use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //Crear un usuario de prueba cada que ejecuto migrations
        User::factory()->create([
            'name' => 'David Figueroa',
            'email' => 'david.figueroa@software.com.mx',
            'password' => bcrypt('12345678'),
            'id_number' => '123456789',
            'phone' => '5555555555',
            'address' => 'Calle Falsa 123',
        ]) ->assignRole('Doctor');
    }
}
