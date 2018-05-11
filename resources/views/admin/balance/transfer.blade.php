@extends('adminlte::page')

@section('title', 'Transferência')

@section('content_header')
    <h1>Transferir</h1>

    <ol class="breadcrumb">
        <li><a href="">Dashboard</a></li>
        <li><a href="">Saldo</a></li>
        <li><a href="">Transferir</a></li>
    </ol>
@stop

@section('content')
    <div class="box box-solid">

        <div class="box-header">
            <h3>Transferir (Informe o Recebedor)</h3>
        </div>

        <div class="box-body">
            <div class="row">
                <div class="col-lg-3 col-md-6 col-xs-6">
                    @include('admin.includes.alerts')

                    <form method="post" action="{{ route('confirm.transfer')  }}">
                        {{ csrf_field()  }}

                        <div class="form-group">
                            <input class="form-control" name="account" type="text" placeholder="Identificação do contemplado">
                        </div>

                        <div class="form-group">
                            <button class="btn btn-success" type="submit">Próxima etapa</button>
                        </div>
                    </form>

                </div>
            </div>
        </div>

    </div>
@stop