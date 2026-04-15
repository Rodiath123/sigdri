<?php

namespace App\Services;

use App\Repositories\UserRepository;
use Illuminate\Support\Facades\Hash;

class UserService
{
    public function __construct(
        protected UserRepository $userRepository
    ) {}

    public function getAllUsers(array $filters = [])
    {
        return $this->userRepository->getAll($filters);
    }

    public function getUserById(int $id)
    {
        return $this->userRepository->findById($id);
    }

    public function createUser(array $data)
    {
        // Vérifications métier
        if ($data['role'] === 'super_admin') {
            throw new \Exception('Impossible de créer un Super Admin via cette route.', 403);
        }

        $data['password'] = Hash::make($data['password']);
        $data['est_actif'] = true;

        $user = $this->userRepository->create($data);

        // Assigner le rôle Spatie
        $user->assignRole($data['role']);

        return $user;
    }

    public function updateUser(int $id, array $data)
    {
        if (isset($data['password'])) {
            $data['password'] = Hash::make($data['password']);
        }

        $user = $this->userRepository->update($id, $data);

        if (isset($data['role'])) {
            $user->syncRoles([$data['role']]);
        }

        return $user;
    }

    public function desactiverUser(int $id)
    {
        return $this->userRepository->delete($id);
    }

    public function activerUser(int $id)
    {
        return $this->userRepository->activate($id);
    }
}