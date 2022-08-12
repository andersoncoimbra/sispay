<?php

use Illuminate\Database\Seeder;

class TransactionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('transactions')->insert([
            'user_id' => 2,
            'account_id' => 1,
            'description' => 'Deposito Inicial',
            'value' => 100,
        ]);

        DB::table('transactions')->insert([
            'user_id' => 3,
            'account_id' => 1,
            'description' => 'Deposito inicial',
            'value' => 100,
        ]);


    }
}
