@extends('admin.layout')

@section('content')

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>{{ $role->name }} role</h1>
        </section>
        <!-- Main content -->
        <section class="content">
            <div class="col-md-6">
                <div class="box">
                    <div>
                        <a href="{{ url()->previous() }}" class="btn btn-primary back-btn">Back</a>
                    </div>
                    <div class="box-body">
                        <div class="box-header">
                            <p class="box-title">Assign permissions</p>
                        </div>

                        {!! Form::open(['route' => ['assign_permissions.update', $role->getKey()],
                                'method' => 'put']) !!}
                            @include('admin.errors')
                            <div class="form-group">
                                @forelse($permissions as $permission)
                                    <div class="checkbox">
                                        <label>
                                            <input
                                                type="checkbox"
                                                name="permission_id[]"
                                                value="{{ $permission->getKey() }}"
                                                @if ($assignedPermissions->contains($permission->getKey()) ) {{ 'checked' }} @endif
                                            >
                                            {{ $permission->name }}
                                        </label>
                                    </div>
                                @empty
                                    <p>No permissions available</p>
                                @endforelse
                            </div>
                            <div class="box-footer">
                                <button class="btn btn-success">Assign</button>
                            </div>
                        {!! Form::close() !!}
                    </div>
                </div>
            </div>

        </section>
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->

@endsection
