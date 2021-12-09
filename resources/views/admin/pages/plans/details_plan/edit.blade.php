@extends('adminlte::page')

@section('title', "Editar o detalhe {$detail->name}")

@section('content_header')
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('admin.index') }}">Dashboard</a></li>
        <li class="breadcrumb-item"><a href="{{ route('plans.index') }}">Planos</a></li>
        <li class="breadcrumb-item"><a href="{{ route('plans.show', $plan->id) }}">{{ $plan->name }}</a></li>
        <li class="breadcrumb-item"><a href="{{ route('details.index', $plan->id) }}" class="active">Detalhes</a></li>
        <li class="breadcrumb-item active"><a href="{{ route('details.edit', [$plan->id, $detail->id]) }}" class="active">Editar</a></li>
    </ol>

    <h1>Editar o detalhe {{ $detail->name }}</h1>
@stop

@section('content')
    <div class="card">
        <div class="card-body">
            <form action="{{ route('details.update', [$plan->id, $detail->id]) }}" method="post">
                @method('PUT')
                @include('admin.pages.plans.details_plan._partials.form')
            </form>
        </div>
    </div>
@endsection
