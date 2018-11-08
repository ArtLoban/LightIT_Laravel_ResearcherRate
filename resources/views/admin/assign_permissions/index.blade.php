@extends('admin.layout')

@section('content')

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>Assign permissions</h1>
        </section>

        <!-- Main content -->
        <section class="content">
            <div class="col-md-6">
                @forelse($roles as $role)
                    <div class="box">
                        <div class="box-body">
                            <p class="profile_font_weight">
                                <a href="{{ route('assign_permissions.edit', $role->getKey()) }}">{{ $role->name }}</a>
                            </p>
                            <ul>
                                @foreach($role->permissionRoles->pluck('permission') as $permission)
                                    <li>{{ $permission->name }}</li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                @empty
                    <p>No roles available</p>
                @endforelse
            </div>

        </section>
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->

@endsection
