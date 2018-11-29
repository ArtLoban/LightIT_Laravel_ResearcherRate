@extends('cabinet.main')

@section('cabinet')
    <div class="col-lg-10">
        <div class="mt-4">
            <p class="h4">{{ $patent->name }}</p>
        </div>
            <a class="btn btn-outline-success" href="{{ route('scientific.patents.index')}}">Back</a>
            <a class="btn btn-outline-info" href="{{ route('scientific.patents.edit', $patent->getKey()) }}">Edit patent</a>
        <hr>
        @if (session('status'))
            <div class="row">
                <div class="col-4 alert alert-success">
                    {{ session('status') }}
                </div>
            </div>
        @endif
        <div class="container article-item">
            <div class="row">
                <div class="col-2 text-right article-item-header">
                    Title
                </div>
                <div class="col-10">
                    {{ $patent->name }}
                </div>
            </div>
            <div class="row">
                <div class="col-2 text-right article-item-header">
                    IPC
                </div>
                <div class="col-10">
                    {{ $patent->ipc }}
                </div>
            </div>
            <div class="row">
                <div class="col-2 text-right article-item-header">
                    Patent number
                </div>
                <div class="col-10">
                    {{ $patent->patent_number }}
                </div>
            </div>
            <div class="row">
                <div class="col-2 text-right article-item-header">
                    Application number
                </div>
                <div class="col-10">
                    {{ $patent->application_number }}
                </div>
            </div>
            <div class="row">
                <div class="col-2 text-right article-item-header">
                    Filing dat
                </div>
                <div class="col-10">
                    {{ $patent->filing_date }}
                </div>
            </div>
            <div class="row">
                <div class="col-2 text-right article-item-header">
                    Priority date
                </div>
                <div class="col-10">
                    {{ $patent->priority_date }}
                </div>
            </div>
            <div class="row">
                <div class="col-2 text-right article-item-header">
                    Inventor
                </div>
                <div class="col-10">
                    {{ $patent->authors->pluck('name')->implode(', ') }}
                </div>
            </div>
            <div class="row">
                <div class="col-2 text-right article-item-header">
                    Patent Bulletin
                </div>
                <div class="col-10">
                    {{ '(' . $patent->patentBulletin->week .'/' . $patent->patentBulletin->year . ') ' . $patent->patentBulletin->date->format('d.m.Y') }}
                </div>
            </div>
        </div>
        <hr>
        @if($patent->file)
            <div class="form-group">
                <i class="fa fa-file-text-o" style="font-size:24px"></i>
                {!! Form::open(['route' => ['scientific.patents.file', $patent->getKey()], 'method' => 'GET']) !!}
                    <button type="submit" class="btn btn-light">View file</button>
                {!! Form::close() !!}

                {!! Form::open(['route' => ['scientific.patents.download', $patent->getKey()], 'method' => 'GET']) !!}
                    <button type="submit" class="btn btn-light">Download file</button>
                {!! Form::close() !!}
            </div>
            <hr>
        @endif

        {!! Form::open([
            'route' => ['scientific.patents.destroy', $patent->getKey()],
            'method' => 'delete'])
        !!}
            <button type="submit" class="btn btn-outline-danger" onclick="return confirm('Are you sure?')">
                Delete patent
            </button>
        {!! Form::close() !!}
    </div>
@endsection
