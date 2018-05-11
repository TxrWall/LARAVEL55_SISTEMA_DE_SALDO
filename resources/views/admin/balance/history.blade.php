@extends('adminlte::page')

@section('title', 'Histórico de Movimentações')

@section('content_header')
    <h1>Histórico de Movimentações</h1>

    <ol class="breadcrumb">
        <li><a href="">Dashboard</a></li>
        <li><a href="">Histórico</a></li>
    </ol>
@stop

@section('content')
    <div class="box box-solid">

        <div class="box-header">
            <form action="{{ route('history.search') }}" method="POST" class="form form-inline">
                {!! csrf_field() !!}
                <input type="text" name="id" class="form-control" placeholder="ID">
                <input type="date" name="date" class="form-control">

                <select name="type" class="form-control">
                    <option value="">Selecione</option>
                    @foreach($types as $key => $type)
                        <option value="{{ $key }}">{{ $type }}</option>
                    @endforeach
                </select>

                <button type="submit" class="btn btn-primary">Pesquisar</button>
            </form>
        </div>

        <div class="box-body">
            <table class="table table-stripped">
                <thead>
                <tr>
                    <th>#</th>
                    <th>Valor</th>
                    <th>Tipo</th>
                    <th>Data</th>
                    <th>?Account?</th>
                </tr>
                </thead>
                <tbody>
                @forelse($histories as $row)
                    <tr>
                        <td>{{ $row->id }}</td>
                        <td>{{ number_format($row->amount, 2, '.', ',') }}</td>
                        <td>{{ $row->type($row->type) }}</td>
                        <td>{{ $row->date }}</td>
                        <td>
                            @if ($row->user_id_transaction)
                                {{ $row->userAccount->name }}
                            @else
                                -
                            @endif
                        </td>
                    </tr>
                @empty
                @endforelse
                </tbody>
            </table>

            {!! $histories->links() !!}
        </div>

    </div>
@stop