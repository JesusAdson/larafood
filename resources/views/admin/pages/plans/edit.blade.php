@extends('adminlte::page')

@section('title', "Planos")

@section('content_header')
    <h1>Editar o plano {{ $plan->name }}</h1>

    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a class="active" href="{{route('admin.index')}}">Dashboard</a></li>
        <li class="breadcrumb-item"><a class="active" href="{{route('plans.index')}}">Planos</a></li>
        <li class="breadcrumb-item"><a class="active" href="{{route('plans.edit', $plan->id)}}">Editar</a></li>
    </ol>
@stop

@section('content')
    <div class="card">
        <div class="card-body">
            <form action="{{ route('plans.update', $plan->id) }}" class="form" method="POST">
                @csrf
                @method('PUT')

                @include('admin.pages.plans._partials.form')
            </form>
        </div>
    </div>
@endsection
