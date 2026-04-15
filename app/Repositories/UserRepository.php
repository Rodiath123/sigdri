<?php

namespace App\Repositories;

use App\Models\User;

class UserRepository
{
    public function getAll(array $filters = [])
    {
        $query = User::with('uniteIndustrielle');

        if (isset($filters['role'])) {
            $query->where('role', $filters['role']);
        }

        if (isset($filters['est_actif'])) {
            $query->where('est_actif', $filters['est_actif']);
        }

        if (isset($filters['search'])) {
            $query->where(function($q) use ($filters) {
                $q->where('nom', 'like', '%'.$filters['search'].'%')
                  ->orWhere('email', 'like', '%'.$filters['search'].'%');
            });
        }

        return $query->paginate(20);
    }

    public function findById(int $id)
    {
        return User::with('uniteIndustrielle')->findOrFail($id);
    }

    public function create(array $data)
    {
        return User::create($data);
    }

    public function update(int $id, array $data)
    {
        $user = User::findOrFail($id);
        $user->update($data);
        return $user;
    }

    public function delete(int $id)
    {
        $user = User::findOrFail($id);
        $user->update(['est_actif' => false]);
        return $user;
    }

    public function activate(int $id)
    {
        $user = User::findOrFail($id);
        $user->update(['est_actif' => true]);
        return $user;
    }
}