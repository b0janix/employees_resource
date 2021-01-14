@extends('layout')
@section('content')
    <form action="{{ route('authenticate') }}" method="post">
        @csrf
        <app errormsg="{{ implode('|', $errors->all()) }}" auth="0"></app>
    </form>
@endsection
