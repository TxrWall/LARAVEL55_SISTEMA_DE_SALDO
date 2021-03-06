@extends('adminlte::page')

@section('title', 'Saldo')

@section('content_header')
    <h1>Fazer Recarga</h1>

    <ol class="breadcrumb">
        <li><a href="">Dashboard</a></li>
        <li><a href="">Saldo</a></li>
        <li><a href="">Depositar</a></li>
    </ol>
@stop

@section('content')
    <div class="box box-solid">

        <div class="box-header">
            <h3>Fazer Recarga</h3>
        </div>

        <div class="box-body">
            <div class="row">
                <div class="col-lg-3 col-md-6 col-xs-6">
                    @include('admin.includes.alerts')

                    <form method="post" action="{{ route('deposit.store')  }}">
                        {{ csrf_field()  }}

                        <div class="form-group">
                            <input class="form-control" name="value" type="text" placeholder="Valor da recarga">
                        </div>

                        <div class="form-group">
                            <button class="btn btn-success" type="submit">Recarregar</button>
                        </div>
                    </form>

                </div>
            </div>
        </div>

    </div>
@stop