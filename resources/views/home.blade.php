@extends('layout')
@section('content')
    <div id="csrfHolder">
        @csrf
    </div>
    <app
        auth="1"
        route="{{route('logout')}}"
        authorize="0"
        csrf="{{csrf_token()}}"
    >

    </app>
@endsection
