<?php

namespace App\Http\Controllers;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index()
    {
        $users = User::all();
        return view('users.index', compact('users'));
    }
    public function create()
    {
        // Não tem pq criar, o laravel já faz isso :)
    }
    public function store(Request $request)
    {
        // Laravel já faz isso :)
    }
    public function show(string $id)
    {
        $user = User::find($id);
        return view('users.show', compact('user'));
    }
    public function edit(string $id)
    {
        $user = User::find($id);
        return view('users.edit', compact('user'));
    }
    public function update(Request $request, string $id)
    {
        $user = User::findOrFail($id);
        $validatedData = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => [
                'required',
                'string',
                'email',
                'max:255',
                'unique:users,email,' . $user->id
            ],
            'password' => [
                'nullable',
                'string',
                'min:8',
                'confirmed'
            ],
            'role' => ['required', 'string'],
        ]);
        $user->name = $validatedData['name'];
        $user->email = $validatedData['email'];
        $user->role = $validatedData['role'];
        if (!empty($validatedData['password'])) {
            $user->password =
                Hash::make($validatedData['password']);
        }
        $user->save();
        return redirect()->route('users.index')->with(
            'success',
            'Usuário atualizado com sucesso!'
        );
    }
    public function destroy(string $id)
    {
        $user = User::findOrFail($id);
        $user->delete();
        return redirect()->route('users.index')->with(
            'success',
            'Usuário excluído com sucesso!'
        );
    }
}
