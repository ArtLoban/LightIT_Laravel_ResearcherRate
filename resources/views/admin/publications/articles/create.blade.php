@extends('admin.layout')

@section('content')
    <div class="content-wrapper">
        <section class="content-header">
            <h1>Add article</h1>
        </section>
        <section class="content">
            {!! Form::open(['route' => 'articles.store', 'files' => true]) !!}
            <div class="box">
                <div class="box-body">
                    <div class="col-md-6">

                        @include('components.errors')

                        <div class="form-group">
                            <label for="articleName">
                                Article Name @include('components.required-star')
                            </label>
                            <input type="text" class="form-control form-control-sm" id="articleName" name="name" value="{{ old('name') }}" required>
                        </div>
                        <div class="form-group">
                            <label for="articleAuthors">
                                Authors @include('components.required-star')
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
                            <label for="articleDescription">Description</label>
                            <textarea class="form-control form-control-sm" id="articleDescription" rows="3" name="description">{{ old('description') }}</textarea>
                        </div>
                        <div class="form-group">
                            <label for="publicationType">
                                Type of publication @include('components.required-star')
                            </label>
                            <select
                                    name="publication_type_id"
                                    class="form-control form-control-sm"
                                    id="publicationType"
                                    required
                            >
                                @foreach($publicationTypes as $publicationType)
                                    <option
                                            value="{{ $publicationType->getKey() }}"
                                            {{ $publicationType->name == 'Academic' ? 'selected' : 'disabled' }}
                                    >
                                        {{ $publicationType->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="journalName">
                                Journal Name @include('components.required-star')
                            </label>
                            <input type="text" class="form-control form-control-sm" id="journalName" name="journal_name" value="{{ old('journal_name') }}" required>
                            <input type="hidden" id="ajax-journal-autocomplete" value="{{ route('journals.ajax') }}">
                        </div>
                        <div class="form-group">
                            <label for="journalNumber">
                                Journal Number @include('components.required-star')
                            </label>
                            <input
                                    type="number"
                                    class="form-control form-control-sm"
                                    id="journalNumber"
                                    name="journal_number"
                                    value="{{ old('journal_number') }}"
                                    required
                            >
                        </div>
                        <div class="form-group">
                            <label for="articleYear">
                                Year @include('components.required-star')
                            </label>
                            <input
                                    class="form-control form-control-sm"
                                    type="text"
                                    pattern="[0-9]{4}"
                                    placeholder="2018"
                                    name="year"
                                    value="{{ old('year') }}"
                                    id="articleYear"
                                    required
                            >
                        </div>
                        <div class="form-group">
                            <label for="articlePages">
                                Pages @include('components.required-star')
                            </label>
                            <input
                                    class="form-control form-control-sm"
                                    type="text"
                                    pattern="[0-9]{1,}-[0-9]{1,}"
                                    placeholder="00-00"
                                    name="pages"
                                    value="{{ old('pages') }}"
                                    id="articlePages"
                            >
                        </div>
                        <div class="form-group">
                            <label for="publicationLanguage">
                                Language @include('components.required-star')
                            </label>
                            <select name="language" class="form-control form-control-sm" id="publicationLanguage" required>
                                <option></option>
                                @foreach($languages as $language)
                                    <option value="{{ $language }}">{{ $language }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="uploadFile">Upload file</label>
                            <input type="file" class="form-control-file  form-control-sm" name="file" id="uploadFile">
                        </div>
                        <small class="form-text text-muted">Acceptable file extensions: .pdf, .doc, .docx</small>
                        <small class="form-text text-muted">@include('components.required-star') - Field is required</small>
                    </div>
                </div>
                <div class="box-body">
                    <p class="help-block">
                        <span class="field-required_star"> *</span> - Field is required
                    </p>
                </div>
                <div class="box-footer">
                    <button class="btn btn-success">Add</button>
                    <a href="{{ route('articles.index')}}" class="btn btn-default">Back</a>
                </div>
            </div>
            {!! Form::close() !!}
        </section>
    </div>
@endsection
