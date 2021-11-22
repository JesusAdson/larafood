@extends('adminlte::page')

@section('tile', 'Planos')

@section('content_header')
    <h1>Planos <a href="{{route('plans.create')}}" class="btn btn-success"><i class="fas fa-plus"></i></a></h1>

    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a class="active" href="{{route('admin.index')}}">Dashboard</a></li>
        <li class="breadcrumb-item"><a class="active" href="{{route('plans.index')}}">Planos</a></li>
    </ol>
@stop

@section('content')
    @include('admin.includes.alerts')

    <div class="card">
        <div class="card-header">
            <form action="{{route('plans.search')}}" class="form form-inline" method="POST">
                @csrf
                <div class="form-group">
                    <input type="text" name="filter" placeholder="Nome: " value="{{$filters['filter'] ?? ''}}" class="form-control">
                </div>
                <div class="form-group">
                    <button type="submit" class="btn btn-info">Filtrar</button>
                </div>
            </form>
        </div>
        <div class="card-body">
            <table class="table table-condensed">
                <thead>
                    <tr>
                        <th>Nome</th>
                        <th>Preço</th>
                        <th width="50">Ações</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($plans as $plan)
                        <tr>
                            <td>{{$plan->name}}</td>
                            <td>{{$plan->price}}</td>
                            <td style="width: 10px">
                                <a href="{{route('plans.show', $plan->id)}}" class="btn btn-warning"><i class="fas fa-eye"></i></a>
                                <a href="{{route('plans.edit', $plan->id)}}" class="btn btn-primary"><i class="fas fa-edit"></i></a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="card-footer">
            @if (isset($filters))
                {!! $plans->appends($filters)->links() !!}
            @else
                {!! $plans->links() !!}
            @endif
        </div>
    </div>
@stop
