@extends('layouts.main')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-lg-2">
                <h4 class="my-4">Private room</h4>
                <div class="list-group">
                    <a href="{{ route('cabinet.profile') }}"
                        class="list-group-item  {{ Request::is('cabinet/profile') ? 'active' : '' }}">
                        Profile
                    </a>
                    <a href="{{ route('cabinet.articles') }}"
                       class="list-group-item {{ Request::is('cabinet/articles') ? 'active' : '' }}">
                        Articles
                    </a>
                    <a href="{{ route('cabinet.patents') }}"
                       class="list-group-item {{ Request::is('cabinet/patents') ? 'active' : '' }}">
                        Patents
                    </a>
                    <a href="{{ route('cabinet.theses') }}"
                       class="list-group-item {{ Request::is('cabinet/theses') ? 'active' : '' }}">
                        Theses
                    </a>
                </div>
            </div>
            @yield('contentA')
        </div>
    </div>
@endsection
