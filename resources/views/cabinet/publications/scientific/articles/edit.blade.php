@extends('cabinet.main')

@section('cabinet')
    <div class="col-lg-10">
        <div class="mt-4">
            <p class="h4">Edit article</p>
        </div>
        <div class="">
            <a class="btn btn-outline-success" href="{{ route('articles.index')}}">Back</a>
        </div>
        <hr>
        {!! Form::open([
            'route' => ['articles.update', $article->getKey()],
            'method' => 'put',
            'files' => true
            ])
        !!}

            @include('pieces.errors')
            <div class="form-group">
                <label for="articleName">
                    Article Name @include('pieces.required-star')
                </label>
                <input type="text" class="form-control form-control-sm" id="articleName" name="name" value="{{ $article->name }}" required>
            </div>
            <div class="form-group">
                <label for="articleAuthors">
                    Authors @include('pieces.required-star')
                </label>
                <input
                    type="text"
                    class="form-control form-control-sm"
                    id="articleAuthors"
                    name="authors"
                    value="{{ $article->authors->pluck('name')->implode(', ') }}"
                    required
                >
                <small class="form-text text-muted">Enter the names of the authors using ',' as a separator</small>
                <input type="hidden" id="ajax-authors-autocomplete" value="{{ route('articles.authors') }}">
            </div>
            <div class="form-group">
                <label for="articleDescription">Description</label>
                <textarea class="form-control form-control-sm" id="articleDescription" rows="3" name="description">{{ $article->description }}</textarea>
            </div>
            <div class="form-group">
                <label for="publicationType">
                    Type of publication @include('pieces.required-star')
                </label>
                <select
                    name="publication_type_id"
                    class="form-control form-control-sm"
                    id="publicationType"
                    required
                >
                    <option></option>
                    @foreach($publicationTypes as $publicationType)
                        <option
                            value="{{ $publicationType->getKey() }}"
                            @if ($article->publication_type_id === $publicationType->getKey()) {{ 'selected' }} @endif
                        >
                            {{ $publicationType->name }}
                        </option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <label for="journalName">
                    Journal Name @include('pieces.required-star')
                </label>
                <input type="text" class="form-control form-control-sm" id="journalName" name="journal_name" value="{{ $article->journal->name }}" required>
                <input type="hidden" id="ajax-journal-autocomplete" value="{{ route('articles.journals') }}">
            </div>
            <div class="alert alert-success d-none" id='msg'></div>
            <div class="form-group">
                <label for="journalNumber">
                    Journal Number @include('pieces.required-star')
                </label>
                <input
                    type="number"
                    class="form-control form-control-sm"
                    id="journalNumber"
                    name="journal_number"
                    value="{{ $article->journal_number }}"
                    required
                >
            </div>
            <div class="form-group">
                <label for="articleYear">
                    Year @include('pieces.required-star')
                </label>
                <input
                    class="form-control form-control-sm"
                    type="text"
                    pattern="[0-9]{4}"
                    placeholder="2018"
                    name="year"
                    value="{{ $article->year }}"
                    id="articleYear"
                    required
                >
            </div>
            <div class="form-group">
                <label for="articlePages">
                    Pages @include('pieces.required-star')
                </label>
                <input
                    class="form-control form-control-sm"
                    type="text"
                    pattern="[0-9]{1,}-[0-9]{1,}"
                    placeholder="00-00"
                    name="pages"
                    value="{{ $article->pages }}"
                    id="articlePages"
                >
            </div>
            <div class="form-group">
                <label for="publicationLanguage">
                    Language @include('pieces.required-star')
                </label>
                <select name="language" class="form-control form-control-sm" id="publicationLanguage" required>
                    <option></option>
                    @foreach($languages as $language)
                        <option
                            value="{{ $language }}"
                            @if ($article->language === $language) {{ 'selected' }} @endif
                        >
                            {{ $language }}
                        </option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                @if($article->file)
                    <label for="uploadFile">Uploaded file {{ $article->file->path }}</label>
                @else
                    <label for="uploadFile">Upload file</label>
                @endif
                <input type="file" class="form-control-file  form-control-sm" name="file" id="uploadFile">
            </div>
            <small class="form-text text-muted">Acceptable file extensions: .pdf, .doc, .docx</small>
            <small class="form-text text-muted">@include('pieces.required-star') - Field is required</small>
            <hr>
            <button type="submit" class="btn btn-success">Update</button>

        {!! Form::close() !!}
    </div>
@endsection
