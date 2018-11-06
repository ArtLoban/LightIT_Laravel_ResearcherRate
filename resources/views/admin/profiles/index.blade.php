@extends('admin.layout')

@section('content')

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>Profiles</h1>
        </section>

        <!-- Main content -->
        <section class="content">

            <!-- Default box -->
            <div class="box">
                <!-- /.box-header -->
                <div class="box-body">
                    <div class="form-group">
                        <a href="{{ route('profiles.create') }}" class="btn btn-success">Add</a>
                    </div>
                    <table id="example1" class="table table-bordered table-striped">
                        <thead>
                        <tr>
                            <th>ID</th>
                            <th>User Id</th>
                            <th>Name</th>
                            <th>Surname</th>
                            <th>Patronymic</th>
                            <th>Date of birth</th>
                            <th>Position</th>
                            <th>Academic Degree</th>
                            <th>Academic Title</th>
                            <th>Department</th>
                            <th>Actions</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($profiles as $profile)
                            <tr>
                                <td>{{ $profile->getKey() }}</td>
                                <td>
                                    @if($profile->user)
                                        <a href="{{ route('users.show', $profile->user->getKey()) }}">
                                            {{ $profile->user->getKey() }}
                                        </a>
                                    @else
                                        {{--<a href="{{ route('blank_users.show', $profile->blankUser->getKey()) }}">--}}
                                            {{ 'blank' }}
                                        {{--</a>--}}
                                    @endif
                                </td>
                                <td>{{ $profile->name }}</td>
                                <td>{{ $profile->surname }}</td>
                                <td>{{ $profile->patronymic }}</td>
                                <td>{{ $profile->birth_date }}</td>
                                <td>{{ $profile->position->name }}</td>
                                <td>{{ $profile->academicDegree->name }}</td>
                                <td>{{ $profile->academicTitle->name }}</td>
                                <td>{{ $profile->department->name }}</td>
                                <td>
                                    <a href="#" class="fa fa-pencil"></a>
                                    {{--<a href="{{ route('profiles.edit', $profile->getKey()) }}" class="fa fa-pencil"></a>--}}
                                    {!! Form::open([
                                        'route' => ['profiles.destroy', $profile->getKey()],
                                        'method' => 'delete'])
                                    !!}
                                    <button type="submit" class="delete-task" onclick="return confirm('Are you sure?')">
                                        <a class="fa fa-remove"></a>
                                    </button>
                                    {!! Form::close() !!}
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
                <!-- /.box-body -->
            </div>
            <!-- /.box -->

        </section>
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->

@endsection
