@extends('layout')

@section('content')
<div class="container-fluid">
    <h2>Selamat datang {{Auth::user()->name}}</h2>
</div>
@endsection
