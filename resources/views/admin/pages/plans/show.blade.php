@extends('adminlte::page')

@section('title', "Planos")

@section('content_header')
    <h1>Detalhes do plano <b>{{ $plan->name }}</b></h1>

    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a class="active" href="{{route('admin.index')}}">Dashboard</a></li>
        <li class="breadcrumb-item"><a class="active" href="{{route('plans.index')}}">Planos</a></li>
        <li class="breadcrumb-item"><a class="active" href="{{route('plans.show', $plan->id)}}">{{$plan->name}}</a></li>
    </ol>
@stop

@section('content')
    <div class="card">
        <div class="card-body">
            <ul>
                <li>
                    <strong>Nome: </strong> {{ $plan->name }}
                </li>
                <li>
                    <strong>URL: </strong> {{ $plan->url }}
                </li>
                <li>
                    <strong>Preço: </strong> R$ {{ number_format($plan->price, 2, ',', '.') }}
                </li>
                <li>
                    <strong>Descrição: </strong> {{ $plan->description }}
                </li>
            </ul>

            @include('admin.includes.alerts')

            <form action="{{ route('plans.destroy', $plan->id) }}" method="POST">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-danger"><i class="fas fa-trash"></i> Excluir</button>
            </form>
        </div>
    </div>
@endsection
