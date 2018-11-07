@extends('admin.layout')

@section('content')

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>Users</h1>
        </section>

        <!-- Main content -->
        <section class="content">

            <!-- Default box -->
            <div class="box">
                <!-- /.box-header -->
                <div class="box-body">
                    <div class="form-group">
                        <a href="{{ route('users.create') }}" class="btn btn-success">Add</a>
                    </div>
                    <table id="example1" class="table table-bordered table-striped">
                        <thead>
                        <tr>
                            <th>ID</th>
                            <th>E-mail</th>
                            <th>Profile id</th>
                            <th>Role</th>
                            <th>Actions</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($users as $user)
                            <tr>
                                <td>
                                    {{ $user->getKey() }}
                                </td>
                                <td>{{ $user->email }}</td>
                                <td>
                                    <a href="{{ route('users.show', $user->getKey()) }}">
                                        {{ $user->profile ? $user->profile->id : 'no profile' }}
                                    </a>
                                </td>
                                <td>{{ $user->role->name }}</td>
                                <td>
                                    <a href="{{ route('users.edit', $user->getKey()) }}" class="fa fa-pencil"></a>
                                    {!! Form::open([
                                        'route' => ['users.destroy', $user->getKey()],
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
