<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\UniteIndustrielle;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    // Liste des utilisateurs
    public function index()
    {
        $users = User::with('uniteIndustrielle')->orderBy('nom')->paginate(20);
        return view('utilisateurs.index', compact('users'));
    }

    // Enregistrer un nouvel utilisateur
    public function store(Request $request)
    {
        $request->validate([
            'nom' => 'required|string|max:100',
            'email' => 'required|email|unique:users',
            'role' => 'required|in:super_admin,admin,agent,industriel',
            'password' => 'required|min:8',
        ]);

        $data = $request->all();
        $data['password'] = Hash::make($request->password);
        $data['est_actif'] = true;

        User::create($data);

        return redirect()->route('utilisateurs.index')
            ->with('success', 'Utilisateur ajouté avec succès.');
    }

    // Mettre à jour
    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);
        
        $request->validate([
            'nom' => 'required|string|max:100',
            'email' => 'required|email|unique:users,email,' . $id,
            'role' => 'required|in:super_admin,admin,agent,industriel',
        ]);

        $data = $request->except('password');
        
        if ($request->filled('password')) {
            $data['password'] = Hash::make($request->password);
        }

        $user->update($data);

        return redirect()->route('utilisateurs.index')
            ->with('success', 'Utilisateur modifié avec succès.');
    }

    // Supprimer
    public function destroy($id)
    {
        $user = User::findOrFail($id);
        $user->delete();

        return redirect()->route('utilisateurs.index')
            ->with('success', 'Utilisateur supprimé.');
    }

    // Activer/Désactiver
    public function toggle($id)
    {
        $user = User::findOrFail($id);
        $user->est_actif = !$user->est_actif;
        $user->save();

        return redirect()->route('utilisateurs.index')
            ->with('success', 'Statut de l\'utilisateur mis à jour.');
    }
}