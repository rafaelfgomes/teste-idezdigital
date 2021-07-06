<?php

use Ramsey\Uuid\Uuid;
use App\Models\TransactionType;
use Illuminate\Database\Seeder;

class TransactionTypesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            [ 'uuid' => Uuid::uuid4(), 'name' => 'Pagamento de contas', 'alias' => 'payments', 'action' => 'sub' ],
            [ 'uuid' => Uuid::uuid4(), 'name' => 'Depósito', 'alias' => 'deposit', 'action' => 'sum' ],
            [ 'uuid' => Uuid::uuid4(), 'name' => 'Transferênia', 'alias' => 'transfer', 'action' => 'sub' ],
            [ 'uuid' => Uuid::uuid4(), 'name' => 'Recarga de celular', 'alias' => 'recharge', 'action' => 'sub' ],
            [ 'uuid' => Uuid::uuid4(), 'name' => 'Compras (Crédito)', 'alias' => 'purchases', 'action' => 'sub' ]
        ];

        foreach ($data as $values) {
            TransactionType::create($values);
        }
    }
}
