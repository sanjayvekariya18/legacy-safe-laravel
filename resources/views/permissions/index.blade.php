@extends('layouts.app')
@section('title', 'Dashboard')

@section('content')
    <div class="col-11 user-permission dpb-65">
        @foreach ($roles as $role)
            @livewire('permission', ['role' => $role], key($role->id))
        @endforeach
    </div>
@endsection
