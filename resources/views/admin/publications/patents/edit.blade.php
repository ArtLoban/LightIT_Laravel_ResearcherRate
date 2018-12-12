@extends('admin.layout')

@section('content')

    <div class="content-wrapper">
        <section class="content-header">
            <h1>Edit patent</h1>
        </section>
        <section class="content">
            {!! Form::open([
                'route' => ['patents.update', $patent->getKey()],
                'method' => 'put',
                'files' => true
                ])
            !!}
                <div class="box">
                    <div class="box-body">
                        <div class="col-md-6">

                            @include('components.errors')

                            <div class="form-group">
                                <label for="patentTitle">
                                    Title @include('components.required-star')
                                </label>
                                <textarea class="form-control form-control-sm" id="patentTitle" rows="3" name="name" required>{{ $patent->name }}</textarea>
                            </div>
                            <div class="form-group">
                                <label for="ipc">
                                    IPC @include('components.required-star')
                                </label>
                                <input type="text" class="form-control form-control-sm" id="ipc" name="ipc" value="{{ $patent->ipc }}" required>
                            </div>
                            <div class="form-group">
                                <label for="patentNumber">
                                    Patent number @include('components.required-star')
                                </label>
                                <input
                                        type="text"
                                        class="form-control form-control-sm"
                                        id="patentNumber"
                                        name="patent_number"
                                        value="{{ $patent->patent_number }}"
                                        required
                                >
                            </div>
                            <div class="form-group">
                                <label for="applicationNumber">
                                    Application number @include('components.required-star')
                                </label>
                                <input
                                        type="text"
                                        class="form-control form-control-sm"
                                        id="applicationNumber"
                                        name="application_number"
                                        value="{{ $patent->application_number }}"
                                        required
                                >
                            </div>
                            <div class="form-group">
                                <label for="filingDate">
                                    Filing date @include('components.required-star')
                                </label>
                                <input type="date" class="form-control form-control-sm" id="filingDate" name="filing_date" value="{{ $patent->filing_date }}" required>
                            </div>
                            <div class="form-group">
                                <label for="priorityDate">
                                    Priority date @include('components.required-star')
                                </label>
                                <input type="date" class="form-control form-control-sm" id="priorityDate" name="priority_date" value="{{ $patent->priority_date }}" required>
                            </div>
                            <div class="form-group">
                                <label for="articleAuthors">
                                    Inventors @include('components.required-star')
                                </label>
                                <input
                                        type="text"
                                        class="form-control form-control-sm"
                                        id="articleAuthors"
                                        name="authors"
                                        value="{{ $patent->authors->pluck('name')->implode(', ') }}"
                                        required
                                >
                                <small class="form-text text-muted">Type author name and hit enter</small>
                                <input type="hidden" id="ajax-authors-autocomplete" value="{{ route('authors.ajax') }}">
                            </div>
                            <div class="form-group">
                                <label for="patentBulletin">
                                    Patent Bulletin @include('components.required-star')
                                </label>
                                <a href="#" class="btn btn-outline-info btn-sm" data-toggle="modal" data-target="#bulletinModal">
                                    Add new publication
                                </a>
                                <select
                                        name="patent_bulletin_id"
                                        class="form-control form-control-sm"
                                        id="patentBulletin"
                                        required
                                >
                                    @foreach($patentBulletins as $patentBulletin)
                                        <option value="{{ $patentBulletin->getKey() }}"
                                                {{ $patent->patentBulletin->getKey() == $patentBulletin->id ? 'selected' : '' }}
                                        >
                                            {{ '(' . $patentBulletin->week .'/' . $patentBulletin->year . ') ' . $patentBulletin->date->format('d.m.Y') }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                @if($patent->file)
                                    <label for="uploadFile">
                                        Uploaded file:
                                    </label>
                                    <i class="fa fa-file-text-o" style="font-size:24px"></i>
                                    <span>{{ 'patent.' . $patent->file->extension }}</span>
                                @else
                                    <label for="uploadFile">Upload file</label>
                                @endif
                                <input type="file" class="form-control-file  form-control-sm" name="file" id="uploadFile">
                            </div>
                            <small class="form-text text-muted">Acceptable file extensions: .pdf, .doc, .docx</small>

                        </div>
                    </div>
                    <div class="box-body">
                        <p class="help-block"> @include('components.required-star') - Field is required </p>
                    </div>
                    <div class="box-footer">
                        <button class="btn btn-warning">Update</button>
                        <a href="{{ route('patents.index')}}" class="btn btn-default">Back</a>
                    </div>
                </div>
            {!! Form::close() !!}
        </section>
    </div>

@endsection
