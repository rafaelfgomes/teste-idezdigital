<?php

use Ramsey\Uuid\Uuid;
use App\Models\AccountType;
use Illuminate\Database\Seeder;

class AccountTypesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            [ 'uuid' => Uuid::uuid4(), 'name' => 'Empresarial', 'alias' => 'company' ],
            [ 'uuid' => Uuid::uuid4(), 'name' => 'Pessoal', 'alias' => 'person' ]
        ];

        foreach ($data as $values) {
            AccountType::create($values);
        }
    }
}
