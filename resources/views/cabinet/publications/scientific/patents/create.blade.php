@extends('cabinet.main')

@section('cabinet')
    <div class="col-lg-10">
        <div class="mt-4">
            <p class="h4">New patent</p>
        </div>
        <div class="">
            <a class="btn btn-outline-success" href="{{ route('scientific.patents.index')}}">Back</a>
        </div>
        @if (session('status'))
            <hr>
            <div class="alert alert-success">
                {{ session('status') }}
            </div>
        @endif
        <hr>
        @include('cabinet.publications.create_bulletin_modal')

        {!! Form::open(['route' => 'scientific.patents.store', 'files' => true]) !!}

            @include('components.errors')
            <div class="form-group">
                <label for="patentTitle">
                    Title @include('components.required-star')
                </label>
                <textarea class="form-control form-control-sm" id="patentTitle" rows="3" name="name" required>{{ old('name') }}</textarea>
            </div>
            <div class="form-group">
                <label for="ipc">
                    IPC @include('components.required-star')
                </label>
                <input type="text" class="form-control form-control-sm" id="ipc" name="ipc" value="{{ old('ipc') }}" placeholder="C07D 473/00" required>
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
                    value="{{ old('patent_number') }}"
                    placeholder="54957"
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
                    value="{{ old('application_number') }}"
                    placeholder="u201007741"
                    required
                >
            </div>
            <div class="form-group">
                <label for="filingDate">
                    Filing date @include('components.required-star')
                </label>
                <input type="date" class="form-control form-control-sm" id="filingDate" name="filing_date" value="{{ old('filing_date') }}" required>
            </div>
            <div class="form-group">
                <label for="priorityDate">
                    Priority date @include('components.required-star')
                </label>
                <input type="date" class="form-control form-control-sm" id="priorityDate" name="priority_date" value="{{ old('priority_date') }}" required>
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
                        value="{{ old('authors') }}"
                        required
                >
                <small class="form-text text-muted">Enter the names of the inventors using ',' as a separator</small>
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
                    <option></option>
                    @foreach($patentBulletins as $patentBulletin)
                        <option value="{{ $patentBulletin->getKey() }}">
                            {{ '(' . $patentBulletin->week .'/' . $patentBulletin->year . ') ' . $patentBulletin->date->format('d.m.Y') }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="form-group">
                <label for="uploadFile">Upload file</label>
                <input type="file" class="form-control-file  form-control-sm" name="file" id="uploadFile">
            </div>
            <small class="form-text text-muted">Acceptable file extensions: .pdf, .doc, .docx</small>
            <small class="form-text text-muted">@include('components.required-star') - Field is required</small>
            <hr>
            <button type="submit" class="btn btn-primary">Submit</button>

        {!! Form::close() !!}
    </div>
@endsection
