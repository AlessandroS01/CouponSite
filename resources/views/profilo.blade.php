@extends('layouts.public')

@section('title', 'Profilo')

@section('link')
    @parent
    <link rel="stylesheet" type="text/css" href="{{ asset('css/profile.css') }}" >

@endsection

@section('content')


        <div class="container-logouser">
            <i class="fa fa-user-cog" style="color: #363945;"></i>
        </div>


        @yield('profilo-content')


@endsection

@section('script')
    @yield('scriptprofilo')
@endsection
