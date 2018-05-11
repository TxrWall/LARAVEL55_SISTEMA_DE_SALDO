@extends('adminlte::page')

@section('title', 'Confirmar Tranferência')

@section('content_header')
    <h1>Confirmar Transferência</h1>

    <ol class="breadcrumb">
        <li><a href="">Dashboard</a></li>
        <li><a href="">Saldo</a></li>
        <li><a href="">Transferir</a></li>
        <li><a href="">Confirmar tranferência</a></li>
    </ol>
@stop

@section('content')
    <div class="box box-solid">

        <div class="box-header">
            <h3>Confirmar Tranferência</h3>
        </div>

        <div class="box-body">
            <div class="row">
                <div class="col-lg-3 col-md-6 col-xs-6">
                    @include('admin.includes.alerts')

                    <p><strong>Contemplado: </strong>{{ $account->name }}</p>
                    <p><strong>Saldo disponível: </strong>{{ number_format($balance->amount, 2, ',', '.') }}</p>

                    <form method="post" action="{{ route('transfer.store')  }}">
                        {{ csrf_field()  }}

                        <input value="{{ $account->id  }}" type="hidden" name="account_id">

                        <div class="form-group">
                            <input class="form-control" name="value" type="text" placeholder="Valor">
                        </div>

                        <div class="form-group">
                            <button class="btn btn-success" type="submit">Transferir</button>
                        </div>
                    </form>

                </div>
            </div>
        </div>

    </div>
@stop