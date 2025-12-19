<?php

namespace App\Services;

use App\Models\User;
use Illuminate\Support\Facades\Hash;

class ProfileService
{
    public function update(User $user, array $data)
    {

        $user->update([
            'name' => $data['name'],
            'phone' => $data['phone'] ?? null,
        ]);

        if (isset($data['qualifications'])) {
            $user->qualifications()->delete();

            foreach ($data['qualifications'] as $qualification) {
                $user->qualifications()->create([
                    'title' => $qualification['title'],
                    'institute' => $qualification['institute'] ?? null,
                    'year' => $qualification['year'] ?? null,
                    'grade' => $qualification['grade'] ?? null,
                ]);
            }
        }

        return $user->load('qualifications');

    }
}
