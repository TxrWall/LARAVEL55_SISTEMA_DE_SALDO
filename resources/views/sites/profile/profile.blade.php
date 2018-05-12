@extends('sites.layouts.app')

@section('title', 'Meu Perfil')

@section('content')
<h1>Meu Perfil</h1>

<form method="POST" action="{{ route('profile.update') }}">
    {!! @csrf_field() !!}
    <div class="form-group">
        <label for="name">Nome</label>
        <input type="text" class="form-control" name="name" placeholder="Nome">
    </div>
    <div class="form-group">
        <label for="email">Email</label>
        <input type="text" class="form-control" name="email" placeholder="Email">
    </div>
    <div class="form-group">
        <label for="password">Senha</label>
        <input type="password" class="form-control" name="password" placeholder="Senha">
    </div>
    <div class="form-group">
        <label for="image">Imagem</label>
        <input type="file" name="image">
    </div>

    <div class="form-group">
        <button type="submit" class="btn btn-info">Atualizar Pefil</button>
    </div>
</form>
@endsection