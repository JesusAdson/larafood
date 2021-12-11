@extends('adminlte::page')

@section('title', "Editar {$permission->name}")

@section('content_header')
    <h1>Editar a Permissão {{ $permission->name }}</h1>
@stop

@section('content')
    @include('admin.includes.alerts')
    <div class="card">
        <div class="card-body">
            <form action="{{ route('permissions.update', $permission->id) }}" class="form" method="POST">
                @method('PUT')

                @include('admin.pages.permissions._partials.form')
            </form>
        </div>
    </div>
@endsection
