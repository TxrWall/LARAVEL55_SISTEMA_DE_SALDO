@extends('sites.layouts.app')

@section('title', 'Meu Perfil')

@section('content')
    <h1>Meu Perfil</h1>

    @include('admin.includes.alerts')

    <form enctype="multipart/form-data" method="POST" action="{{ route('profile.update') }}">
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
            @if (Auth()->user()->image != null)
                <img src="{{ url('storage/users/' . Auth()->user()->image) }}" alt="{{ Auth()->user()->name }}" style="max-width: 50px;">
            @endif
            <label for="image">Imagem</label>
            <input type="file" name="image" id="image">
        </div>

        <div class="form-group">
            <button type="submit" class="btn btn-info">Atualizar Pefil</button>
        </div>
    </form>
@endsection