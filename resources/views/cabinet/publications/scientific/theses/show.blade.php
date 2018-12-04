@extends('cabinet.main')

@section('cabinet')
    <div class="col-lg-10">
        <div class="mt-4">
            <p class="h4">{{ $thesis->name }}</p>
        </div>
            <a class="btn btn-outline-success" href="{{ route('scientific.theses.index')}}">Back</a>
            <a class="btn btn-outline-info" href="{{ route('scientific.theses.edit', $thesis->getKey()) }}">Edit thesis</a>
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
                    Authors
                </div>
                <div class="col-10">
                    {{ $thesis->authors->pluck('name')->implode(', ') }}
                </div>
            </div>
            <div class="row">
                <div class="col-2 text-right article-item-header">
                    Year of publication
                </div>
                <div class="col-10">
                    {{ $thesis->year }}
                </div>
            </div>
            <div class="row">
                <div class="col-2 text-right article-item-header">
                    Digest
                </div>
                <div class="col-10">
                    {{ $thesis->thesisDigest->name }}
                </div>
            </div>
            <div class="row">
                <div class="col-2 text-right article-item-header">
                    Pages
                </div>
                <div class="col-10">
                    {{ $thesis->pages }}
                </div>
            </div>
            <div class="row">
                <div class="col-2 text-right article-item-header">
                    Type
                </div>
                <div class="col-10">
                    {{ $thesis->publicationType->name }}
                </div>
            </div>
            <div class="row">
                <div class="col-2 text-right article-item-header">
                    Language
                </div>
                <div class="col-10">
                    {{ $thesis->language }}
                </div>
            </div>
        </div>
        <hr>
        @if($thesis->file)
            <div class="form-group">
                <i class="fa fa-file-text-o" style="font-size:24px"></i>
                {!! Form::open(['route' => ['scientific.theses.file', $thesis->getKey()], 'method' => 'GET']) !!}
                    <button type="submit" class="btn btn-light">View file</button>
                {!! Form::close() !!}

                {!! Form::open(['route' => ['scientific.theses.download', $thesis->getKey()], 'method' => 'GET']) !!}
                    <button type="submit" class="btn btn-light">Download file</button>
                {!! Form::close() !!}
            </div>
            <hr>
        @endif

        {!! Form::open([
            'route' => ['scientific.theses.destroy', $thesis->getKey()],
            'method' => 'delete'])
        !!}
            <button type="submit" class="btn btn-outline-danger" onclick="return confirm('Are you sure?')">
                Delete thesis
            </button>
        {!! Form::close() !!}
    </div>
@endsection
