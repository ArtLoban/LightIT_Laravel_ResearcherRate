@extends('cabinet.main')

@section('cabinet')
    <div class="col-lg-9">
        <div class="card mt-4">
            <div class="card-body">
                <p>Error 404</p>
                <p class="card-title">File not found on the remote server</p>
            </div>
        </div>
        <hr>
        <div>
            <a class="btn btn-outline-success" href="{{ url()->previous() }}">Back</a>
        </div>
    </div>
@endsection
