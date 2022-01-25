<?php

namespace App\Actions\Fortify;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Laravel\Fortify\Contracts\CreatesNewUsers;

class CreateNewUser implements CreatesNewUsers
{
    use PasswordValidationRules;

    public function create(array $input): User
    {
        Validator::make($input, [
            'name' => ['required', 'string', 'max:255'],
            'email' => [
                'required',
                'string',
                'email',
                'max:255',
                Rule::unique(User::class),
            ],
            'surnames'=> ['required','string','max:50'],
            'document_type'=> ['required','string','max:5'],
            'cell_phone'=> ['required','string','max:15'],
            'user_street'=> ['required','string','max:255'],
            'number_document'=> ['required','string','max:16', Rule::unique(User::class)],
            'password' => $this->passwordRules(),
        ])->validate();

        $user = User::create([
            'name' => $input['name'],
            'email' => $input['email'],
            'password' => Hash::make($input['password']),
            'surnames' => $input['surnames'],
            'document_type' => $input['document_type'],
            'cell_phone' => $input['cell_phone'],
            'user_street' => $input['user_street'],
            'number_document' => $input['number_document'],
        ]);
        $user->markAsEnabled();

        $user->assignRole('cliente');

        return $user;
    }
}
