@extends('cabinet.main')

@section('cabinet')
    <div class="col-lg-10">
        <div class="mt-4">
            <p class="h4">Profile</p>
        </div>
        <div class="mt-4">
            <p class="h5">
                <u>
                    @if ($user->profile) {{ $user->profile->name . ' ' . $user->profile->surname }} @endif
                    @if ($user->profile && $user->profile->patronymic) {{ $user->profile->patronymic }} @endif
                </u>
            </p>
            @if($user->profile)
                <div>
                    <span>Day of birth: </span>
                    <span class="font-weight-bold">{{ $user->profile->birth_date }}</span>
                </div>
                <br>
                <div>
                    <span>Department: </span>
                    <span class="font-weight-bold">{{ $user->profile->department->name }}</span>
                </div>
                <div>
                    <span>Position: </span>
                    <span class="font-weight-bold">{{ $user->profile->position->name }}</span>
                </div>
                <div>
                    <span>Academic Degree: </span>
                    <span class="font-weight-bold">{{ $user->profile->academicDegree->name }}</span>
                </div>
                <div>
                    <span>Academic Title: </span>
                    <span class="font-weight-bold">{{ $user->profile->academicTitle->name }}</span>
                </div>
            @else
                <div>
                    <span>Role: </span>
                    <span class="font-weight-bold">{{ $user->role->name }}</span>
                </div>
            @endif

        </div>
        <div class="col-lg-7">
            <div class="card card-outline-secondary my-5">
                <div class="h5">
                    Registration data
                </div>
                {!! Form::open(['route' => ['cabinet.profile.update', $user->getKey()],
                                'method' => 'put']) !!}
                    <div class="card-body">
                        <input type="hidden" name="updatedUserId" value="{{ $user->getKey() }}">
                        <div class="form-group">
                            <label for="inputEmail">Email</label>
                            <input type="text" name="email" class="form-control form-control-sm" id="inputEmail" value="{{ $user->email }}">
                        </div>
                        <div class="form-group">
                            <label for="inputCurrentPassword">Current password</label>
                            <input type="password" name="current_password" class="form-control form-control-sm" id="inputCurrentPassword">
                        </div>
                        <div class="form-group">
                            <label for="inputPassword">New password</label>
                            <input type="password" name="password" class="form-control form-control-sm" id="inputPassword">
                        </div>
                        <div class="form-group">
                            <label for="inputPasswordConfirm">Confirm password</label>
                            <input type="password" name="password_confirmation" class="form-control form-control-sm" id="inputPasswordConfirm">
                        </div>
                        <small class="text-muted">* some text</small>

                        @include('components.errors')

                        @if (session('status'))
                            <div class="alert alert-success">
                                {{ session('status') }}
                            </div>
                        @endif
                        <hr>
                        <button class="btn btn-success">Submit</button>
                    </div>
                {!! Form::close() !!}
            </div>
        </div>
    </div>
@endsection
