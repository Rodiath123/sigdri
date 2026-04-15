<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Services\UserService;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function __construct(
        protected UserService $userService
    ) {}

    // Liste des utilisateurs
    public function index(Request $request)
    {
        $filters = $request->only(['role', 'est_actif', 'search']);
        $users = $this->userService->getAllUsers($filters);

        return response()->json($users);
    }

    // Détail d'un utilisateur
    public function show(int $id)
    {
        $user = $this->userService->getUserById($id);
        return response()->json($user);
    }

    // Créer un utilisateur
    public function store(Request $request)
    {
        $data = $request->validate([
            'nom'            => 'required|string|max:100',
            'email'          => 'required|email|unique:users,email',
            'password'       => 'required|string|min:8',
            'role'           => 'required|in:admin,agent,industriel',
            'industriel_id'  => 'nullable|exists:unite_industrielles,id',
        ]);

        $user = $this->userService->createUser($data);

        return response()->json([
            'message' => 'Utilisateur créé avec succès.',
            'user'    => $user,
        ], 201);
    }

    // Modifier un utilisateur
    public function update(Request $request, int $id)
    {
        $data = $request->validate([
            'nom'           => 'sometimes|string|max:100',
            'email'         => 'sometimes|email|unique:users,email,'.$id,
            'password'      => 'sometimes|string|min:8',
            'role'          => 'sometimes|in:admin,agent,industriel',
            'industriel_id' => 'nullable|exists:unite_industrielles,id',
        ]);

        $user = $this->userService->updateUser($id, $data);

        return response()->json([
            'message' => 'Utilisateur mis à jour avec succès.',
            'user'    => $user,
        ]);
    }

    // Désactiver un utilisateur
    public function desactiver(int $id)
    {
        $user = $this->userService->desactiverUser($id);
        return response()->json([
            'message' => 'Utilisateur désactivé.',
            'user'    => $user,
        ]);
    }

    // Activer un utilisateur
    public function activer(int $id)
    {
        $user = $this->userService->activerUser($id);
        return response()->json([
            'message' => 'Utilisateur activé.',
            'user'    => $user,
        ]);
    }
}