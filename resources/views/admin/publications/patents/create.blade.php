@extends('admin.layout')

@section('content')
    <div class="content-wrapper">
        <section class="content-header">
            <h1>Add patent</h1>
        </section>
        <section class="content">
            {!! Form::open(['route' => 'patents.store', 'files' => true]) !!}
            <div class="box">
                <div class="box-body">
                    <div class="col-md-6">

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
                    </div>
                </div>
                <div class="box-body">
                    <p class="help-block">
                        <span class="field-required_star"> *</span> - Field is required
                    </p>
                </div>
                <div class="box-footer">
                    <button class="btn btn-success">Add</button>
                    <a href="{{ route('patents.index')}}" class="btn btn-default">Back</a>
                </div>
            </div>
            {!! Form::close() !!}
        </section>
    </div>
@endsection
