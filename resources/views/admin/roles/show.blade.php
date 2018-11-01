@extends('admin.layout')

@section('content')

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>Role: {{ $role->name }}</h1>
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
                <p>Available permissions:</p>
                <ul>
                    @forelse ($permissions as $permission)
                        <li>{{ $permission->name }}</li>
                    @empty
                </ul>
                        <p>... no permissions available</p>
                    @endforelse

            </div>

        </section>
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->

@endsection
