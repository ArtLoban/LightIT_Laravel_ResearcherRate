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
                    <div>
                        <a href="#"
                           class="list-group-item dropdown-toggle"
                           data-toggle="collapse"
                           data-target="#collapse-down-menu">
                            Publications
                        </a>
                        <div id="collapse-down-menu" class="collapse">
                            <div class="dropdown dropright">
                                <a href="#"
                                   class="list-group-item publication-item dropdown-toggle"
                                   data-toggle="dropdown">
                                    Scientific
                                </a>
                                <div class="dropdown-menu">
                                    <a href="{{ route('cabinet.articles') }}"
                                       class="list-group-item publication-item">
                                        Articles
                                    </a>
                                    <a href="#"
                                       class="list-group-item publication-item">
                                        Patents
                                    </a>
                                    <a href="#"
                                       class="list-group-item publication-item">
                                        Theses
                                    </a>
                                </div>
                            </div>
                            <div class="dropdown dropright">
                                <a href="#"
                                   class="list-group-item publication-item dropdown-toggle"
                                   data-toggle="dropdown">
                                    Academic
                                </a>
                                <div class="dropdown-menu">
                                    <a href="#"
                                       class="list-group-item publication-item">
                                        Articles
                                    </a>
                                    <a href="#"
                                       class="list-group-item publication-item">
                                        Theses
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <a href="#"
                       class="list-group-item">
                        Menu item
                    </a>
                </div>
            </div>
            @yield('cabinet')
        </div>
    </div>
@endsection
