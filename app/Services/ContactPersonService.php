<?php

namespace App\Services;

use App\Models\User;
use App\Repositories\ContactPersonRepository;

class ContactPersonService
{
    public function __construct(private ContactPersonRepository $contactPersonRepository)
    {}

    public function createContactPerson(array $data, User $user):void
    {
        $data['contacts'] = array_filter($data['contacts'], fn($contactPerson) => !is_null($contactPerson) && $contactPerson !== '');
        $data['phoneNumbers'] = array_filter($data['phoneNumbers'], fn($phoneNumber) => !is_null($phoneNumber) && $phoneNumber !== '');

        if (count($data['contacts']) > 0) {
            foreach ($data['contacts'] as $key => $value) {
                $contactPerson = [
                    'name' => $value,
                    'phone_number' => $data['phoneNumbers'][$key],
                    'user_id' => $user->id
                ];

                $this->contactPersonRepository->create($contactPerson);
            }
        }
    }
}