@extends('layout')
@section('content')
    <app
        auth="1"
        authorize="1"
        route="{{route('authorize')}}"
        client_id="{{request('client_id')}}"
        redirect_uri="{{request('redirect_uri')}}"
        csrf="{{csrf_token()}}"
        errormsg="{{ implode('|', $errors->all()) }}"
    >
    </app>
@endsection
