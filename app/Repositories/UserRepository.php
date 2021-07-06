<?php

namespace App\Repositories;

use App\Models\User;
use Ramsey\Uuid\Uuid;
use App\Helpers\DocumentHelper;
use App\Models\Contact;
use ErrorException;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\DB;

class UserRepository
{
    public function getAll(): Collection
    {
        return User::all();
    }

    public function getOne(int $id): User
    {
        $user = User::findOrFail($id);
        
        return $user;
    }

    public function getUsersByName(string $name): Collection
    {
        $users = User::where('first_name', 'LIKE', ucfirst($name) . '%')->get();
        
        return $users;
    }

    public function store(array $data): User
    {
        DB::beginTransaction();
        
        try {
            $userData = [
                'uuid' => Uuid::uuid4(),
                'first_name' => $data['first_name'],
                'last_name' => $data['last_name'],
                'document' => DocumentHelper::sanitizeDocument($data['document']),
                'email' => $data['email'],
                'password' => Hash::make($data['password'])
            ];
    
            $userCreated = User::create($userData);
    
            if (!empty($data['contacts'])) {
                foreach ($data['contacts'] as $contact) {
                    $contactData[] = [
                        'uuid' => Uuid::uuid4(),
                        'code' => $contact['code'],
                        'number' => $contact['number']
                    ];
                }
    
                $contacts = tap(new Contact())->insert($contactData);
    
                $ids = $contacts->pluck('id');
    
                $userCreated->contacts()->sync($ids);
            }
        } catch (\Exception $e) {
            DB::rollBack();
            throw new ErrorException($e->getMessage());
        }
    
        DB::commit();

        return $userCreated->with('contacts')->first();
    }

    public function update(array $data, int $id): User
    {
        $user = User::find($id);

        return tap($user)->update($data);
    }

    public function delete(int $id): User
    {
        $user = User::find($id);

        return tap($user)->delete();
    }
}