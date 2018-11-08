@extends('admin.layout')

@section('content')

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>
                Edit academic title
            </h1>
        </section>

        <!-- Main content -->
        <section class="content">

            <!-- Default box -->
            <div class="box">

                {!! Form::open(['route' => ['academic_titles.update', $academicTitle->getKey()],
                                'method' => 'put']) !!}

                <div class="box-body">
                    <div class="col-md-6">

                        @include('admin.errors')

                        <input type="hidden" name="updatedAcademicTitleId" value="{{ $academicTitle->getKey() }}">
                        <div class="form-group">
                            <label for="inputName">Name</label>
                            <input
                                type="text"
                                class="form-control"
                                name="name"
                                id="inputName"
                                value="{{ $academicTitle->name }}"
                            >
                        </div>
                    </div>
                </div>
                <!-- /.box-body -->
                <div class="box-footer">
                    <button class="btn btn-warning">Update</button>
                    <a href="{{ route('academic_titles.index')}}" class="btn btn-default">Back</a>
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
