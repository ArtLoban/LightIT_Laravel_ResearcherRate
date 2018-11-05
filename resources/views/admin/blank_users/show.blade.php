@extends('admin.layout')

@section('content')

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>Blank user {{ $blankUser->getKey() }}</h1>
        </section>

        <!-- Main content -->
        <section class="content">

            <!-- Default box -->
            <div class="box">
                <div>
                    <a href="{{ url()->previous() }}" class="btn btn-primary back-btn">Back</a>
                </div>
            </div>
            <!-- /.box -->
            <div>
                <span>Profile Id:</span>
                <span class="profile_font_weight">{{ $blankUser->profile->getKey() }}</span>

                {{--<a href="{{ route('roles.show', $user->role->getKey()) }}"><span>{{ $user->role->name }}</span></a>--}}
            </div>
            <div>
                <span>Personal Key:</span>
                <span class="profile_font_weight admin_panel_employee_profile">{{ $blankUser->personal_key }}</span>
{{--                <span>{{ $user->email }}</span>--}}
            </div>
            <br>
            {{--<div>--}}
                {{--<h4>Profile:</h4>--}}
            {{--</div>--}}
            {{--<div class="admin_panel_employee_profile">--}}
                {{--@if($user->profile)--}}
                    {{--<div>--}}
                        {{--<span>Name: </span>--}}
                        {{--<span class="profile_font_weight">{{ $user->profile->name }}</span>--}}
                    {{--</div>--}}
                    {{--<div>--}}
                        {{--<span>Surname: </span>--}}
                        {{--<span class="profile_font_weight">{{ $user->profile->surname }}</span>--}}
                    {{--</div>--}}
                    {{--<div>--}}
                        {{--<span>Patronymic: </span>--}}
                        {{--<span class="profile_font_weight">{{ $user->profile->patronymic }}</span>--}}
                    {{--</div>--}}
                    {{--<div>--}}
                        {{--<span>Day of birth: </span>--}}
                        {{--<span class="profile_font_weight">{{ $user->profile->birth_date }}</span>--}}
                    {{--</div>--}}
                    {{--<br>--}}
                    {{--<div>--}}
                        {{--<span>Department: </span>--}}
                        {{--<span class="profile_font_weight">{{ $user->profile->department->name }}</span>--}}
                    {{--</div>--}}
                    {{--<div>--}}
                        {{--<span>Position: </span>--}}
                        {{--<span class="profile_font_weight">{{ $user->profile->position->name }}</span>--}}
                    {{--</div>--}}
                    {{--<div>--}}
                        {{--<span>Academic Degree: </span>--}}
                        {{--<span class="profile_font_weight">{{ $user->profile->academicDegree->name }}</span>--}}
                    {{--</div>--}}
                    {{--<div>--}}
                        {{--<span>Academic Title: </span>--}}
                        {{--<span class="profile_font_weight">{{ $user->profile->academicTitle->name }}</span>--}}
                    {{--</div>--}}
                {{--@else--}}
                    {{--<div>--}}
                        {{--<span>... no data</span>--}}
                    {{--</div>--}}
                {{--@endif--}}
            {{--</div>--}}
        </section>
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->

@endsection
