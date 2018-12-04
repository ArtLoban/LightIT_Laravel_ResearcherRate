@extends('admin.layout')

@section('content')

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>
                Edit department
            </h1>
        </section>

        <!-- Main content -->
        <section class="content">

            <!-- Default box -->
            <div class="box">

                {!! Form::open(['route' => ['departments.update', $department->getKey()],
                                'method' => 'put']) !!}

                <div class="box-body">
                    <div class="col-md-6">

                        @include('admin.errors')

                        <input type="hidden" name="updatedDepartmentId" value="{{ $department->getKey() }}">
                        <div class="form-group">
                            <label for="inputName">Name<span class="field-required_star"> *</span></label>
                            <input
                                type="text"
                                class="form-control"
                                name="name"
                                id="inputName"
                                value="{{ $department->name }}"
                            >
                        </div>
                        <div class="form-group">
                            <label>Faculty<span class="field-required_star"> *</span></label>
                            <select name="faculty_id" class="form-control" required>
                                @foreach($faculties as $faculty)
                                    <option
                                        value = "{{ $faculty->getKey() }}"
                                        @if ($department->faculty_id === $faculty->getKey()) {{ 'selected' }} @endif
                                    >
                                        {{ $faculty->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>
                <div class="box-body">
                    <p class="help-block">
                        <span class="field-required_star"> *</span> - Field is required
                    </p>
                </div>
                <!-- /.box-body -->
                <div class="box-footer">
                    <button class="btn btn-warning">Update</button>
                    <a href="{{ route('departments.index')}}" class="btn btn-default">Back</a>
                </div>
                <!-- /.box-footer-->

                {!! Form::close() !!}

            </div>
            <!-- /.box -->

        </section>
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->

@endsection
