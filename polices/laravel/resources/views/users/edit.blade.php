@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Editar Livro</h1>
    <form action="{{ route('users.update', $user->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="mb-3">
            <label for="name" class="form-label">Nome</label>
            <input type="text" class="form-control" id="name" name="name" value="{{ old('name', $user->name) }}" required>
        </div>


        <div class="mb-3">
            <label for="email" class="form-label">Email</label>
            <input type="text" class="form-control" id="email" name="email" value="{{ old('email', $user->email) }}" required>
        </div>
        @can('isAdmin', Auth::user())
        <div class="mb-3">
            <label for="role">Escolha o Papel:</label>
            <select name="role" id="role" class="form-control">

                <option value="1" {{ old('role', $user->role) == 1 ? 'selected' : '' }}>
                    Admin
                </option>
                <option value="2" {{ old('role', $user->role) == 2 ? 'selected' : '' }}>
                    Bibliotecario(a)
                </option>
                <option value="3" {{ old('role', $user->role) == 3 ? 'selected' : '' }}>
                    Cliente
                </option>
            </select>
        </div>
        @endcan

        <button type="submit" class="btn btn-primary">Salvar Alterações</button>
        <a href="{{ route('users.index') }}" class="btn btn-secondary">Cancelar</a>
    </form>
</div>
@endsection