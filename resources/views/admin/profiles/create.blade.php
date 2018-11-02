@extends('admin.layout')

@section('content')

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>
                Add profile
            </h1>
        </section>

        <!-- Main content -->
        <section class="content">

            {!! Form::open(['route' => 'profiles.store']) !!}
                <!-- Default box -->
                <div class="box">
                    <div class="box-body">
                        <div class="col-md-6">

                            @include('admin.errors')

                            <div class="form-group">
                                <label for="ProfileName">Name</label>
                                <input
                                    class="form-control"
                                    id="ProfileName"
                                    type="text"
                                    name="name"
                                    value="{{ old('name') }}"
                                    required
                                >
                            </div>
                            <div class="form-group">
                                <label for="ProfileSurame">Surame</label>
                                <input
                                    class="form-control"
                                    id="ProfileSurame"
                                    type="text"
                                    name="surname"
                                    value="{{ old('surname') }}"
                                    required
                                >
                            </div>
                            <div class="form-group">
                                <label for="ProfilePatronymic">Patronymic</label>
                                <input
                                    class="form-control"
                                    id="ProfilePatronymic"
                                    type="text"
                                    name="patronymic"
                                    value="{{ old('patronymic') }}"
                                    required
                                >
                            </div>
                            <hr>
                            <div class="form-group">
                                <label>Date of birth</label>
                                <div class="input-group">
                                    <div class="input-group-addon">
                                        <i class="fa fa-calendar"></i>
                                    </div>
                                    <input
                                        type="date"
                                        class="form-control"
                                        name="birth_date"
                                        value="{{ old('birth_date') }}"
                                        required
                                    >
                                </div>
                            </div>
                            <hr>
                            <div class="form-group">
                                <label>Position</label>
                                <select name="position_id" class="form-control" required>
                                    <option></option>
                                    @foreach($positions as $position)
                                        <option value="{{ $position->getKey() }}">{{ $position->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label>Academic Degree</label>
                                <select name="ac_degree_id" class="form-control" required>
                                    <option></option>
                                    @foreach($academicDegrees as $academicDegree)
                                        <option value="{{ $academicDegree->getKey() }}">{{ $academicDegree->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label>Academic Title</label>
                                <select name="ac_title_id" class="form-control" required>
                                    <option></option>
                                    @foreach($academicTitles as $academicTitle)
                                        <option value="{{ $academicTitle->getKey() }}">{{ $academicTitle->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label>Department</label>
                                <select name="department_id" class="form-control" required>
                                    <option></option>
                                    @foreach($departments as $department)
                                        <option value="{{ $department->getKey() }}">{{ $department->name }}</option>
                                    @endforeach
                                </select>
                            </div>

                        </div>
                    </div>
                    <!-- /.box-body -->
                    <div class="box-footer">
                        <button class="btn btn-success">Add</button>
                        <a href="{{ route('profiles.index') }}" class="btn btn-default">Back</a>
                    </div>
                    <!-- /.box-footer-->
                </div>
                <!-- /.box -->
            {!! Form::close() !!}

        </section>
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->

@endsection
