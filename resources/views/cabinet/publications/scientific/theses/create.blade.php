@extends('cabinet.main')

@section('cabinet')
    <div class="col-lg-10">
        <div class="mt-4">
            <p class="h4">New thesis</p>
        </div>
        <div class="">
            <a class="btn btn-outline-success" href="{{ route('scientific.theses.index')}}">Back</a>
        </div>
        @if (session('status'))
            <hr>
            <div class="alert alert-success">
                {{ session('status') }}
            </div>
        @endif
        <hr>

        @include('cabinet.publications.modals.create_digest_modal')

        {!! Form::open(['route' => 'scientific.theses.store', 'files' => true]) !!}

            @include('components.errors')
            <div class="form-group">
                <label for="thesisName">
                    Title @include('components.required-star')
                </label>
                <input type="text" class="form-control form-control-sm" id="thesisName" name="name" value="{{ old('name') }}" required>
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
                <small class="form-text text-muted">Enter the names of the authors using ',' as a separator</small>
                <input type="hidden" id="ajax-authors-autocomplete" value="{{ route('authors.ajax') }}">
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
                            {{ $publicationType->name == 'Scientific' ? 'selected' : 'disabled' }}
                        >
                            {{ $publicationType->name }}
                        </option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <label for="digestName">
                    Digest Name @include('components.required-star')
                </label>
                <!-- Link Button trigger modal -->
                <a href="#" class="btn btn-outline-info btn-sm" data-toggle="modal" data-target="#ajax-digestModal">Add digest</a>
                <input type="text" class="form-control form-control-sm" id="digestName" name="thesis_digest_name" value="{{ old('thesis_digest_name') }}" required>
                <input type="hidden" id="ajax-digest-autocomplete" value="{{ route('digests.ajax') }}">
            </div>
            <div class="alert alert-success d-none" id='msg'></div>
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
                <label for="thesisYear">
                    Year @include('components.required-star')
                </label>
                <input
                    class="form-control form-control-sm"
                    type="text"
                    pattern="[0-9]{4}"
                    placeholder="2018"
                    name="year"
                    value="{{ old('year') }}"
                    id="thesisYear"
                    required
                >
            </div>
            <div class="form-group">
                <label for="thesisPages">
                    Pages @include('components.required-star')
                </label>
                <input
                    class="form-control form-control-sm"
                    type="text"
                    pattern="[0-9]{1,}-[0-9]{1,}"
                    placeholder="00-00"
                    name="pages"
                    value="{{ old('pages') }}"
                    id="thesisPages"
                >
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
