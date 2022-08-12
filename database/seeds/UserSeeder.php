<?php

use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'id' => 1,
            'name' => 'Admin',
            'email' => 'admin@sispay.com',
            'cpf_cnpj' => 12345678901,
            'password' => Hash::make('123456'),
            'tipo' => 'admin',
        ]);

        DB::table('users')->insert([
            'id' => 2,
            'name' => 'Lojista',
            'email' => 'lojista@sispay.com',
            'cpf_cnpj' => 12345678902,
            'password' => Hash::make('123456'),
            'tipo' => 'lojista',
        ]);

        DB::table('users')->insert([
            'id' => 3,
            'name' => 'Comum',
            'email' => 'comum@sispay.com',
            'cpf_cnpj' => 12345678903,
            'password' => Hash::make('123456'),
            'tipo' => 'comum',
        ]);
    }
}
