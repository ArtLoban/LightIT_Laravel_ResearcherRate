@extends('admin.layout')

@section('content')

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>Blank Users</h1>
        </section>

        <!-- Main content -->
        <section class="content">

            <!-- Default box -->
            <div class="box">
                <!-- /.box-header -->
                <div class="box-body">
                    <table id="example1" class="table table-bordered table-striped">
                        <thead>
                        <tr>
                            <th>ID</th>
                            <th>Profile id</th>
                            <th>Personal key</th>
                            <th>Actions</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($blankUsers as $blankUser)
                            <tr>
                                <td>{{ $blankUser->getKey() }}</td>
                                <td>{{ $blankUser->profile_id }}</td>
                                <td>{{ $blankUser->personal_key }}</td>
                                <td>
                                    <a href="{{ route('blank_users.edit', $blankUser->getKey()) }}" class="fa fa-pencil"></a>
                                    {!! Form::open([
                                        'route' => ['blank_users.destroy', $blankUser->getKey()],
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
