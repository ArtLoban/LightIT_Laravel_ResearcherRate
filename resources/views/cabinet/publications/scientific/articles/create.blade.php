@extends('cabinet.main')

@section('cabinet')
    <div class="col-lg-10">
        <div class="mt-4">
            <p class="h4">New article</p>
        </div>
        <div>
            <p>Some text</p>
        </div>
        <div class="">
            <button type="submit" class="btn ">
                <a href="{{ route('articles.index')}}" class="">Back</a>
            </button>
        </div>
        <hr>

            {!! Form::open(['route' => 'articles.store']) !!}

                @include('pieces.errors')

                <div class="form-group">
                    <label for="articleName">
                        Article Name @include('pieces.required-star')
                    </label>
                    <input type="text" class="form-control" id="articleName" name="name" value="{{ old('name') }}" required>
                </div>
                <div class="form-group">
                    <label for="articleAuthors">
                        Authors @include('pieces.required-star')
                    </label>
                    <input type="text" class="form-control" id="articleAuthors" name="name" value="{{ 'articleAuthors' }}" required>
                </div>
                <div class="form-group">
                    <label for="articleDescription">Description</label>
                    <textarea class="form-control" id="articleDescription" rows="3" name="description">{{ old('description') }}</textarea>
                </div>
                <div class="form-group">
                    <label for="publicationType">
                        Type of publication @include('pieces.required-star')
                    </label>
                    <select name="publication_type" class="form-control" id="publicationType" required>
                        <option></option>
                        @foreach($publicationTypes as $publicationType)
                            <option value="{{ $publicationType->getKey() }}">{{ $publicationType->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label for="journalName">
                        Journal Name @include('pieces.required-star')
                    </label>
                    <input type="text" class="form-control" id="journalName" name="journal_name" value="{{ 'some text' }}" required>
                </div>
                <div class="form-group">
                    <label for="journalNumber">
                        Journal Number @include('pieces.required-star')
                    </label>
                    <input type="text" class="form-control" id="journalNumber" name="journal_number" value="{{ old('journal_number') }}" required>
                </div>
                <div class="form-group">
                    <label for="articleYear">
                        Year @include('pieces.required-star')
                    </label>
                    <input class="form-control" type="number" placeholder="2015" name="year" value="{{ old('year') }}" id="articleYear">
                </div>
                <div class="form-group">
                    <label for="articlePages">
                        Pages @include('pieces.required-star')
                    </label>
                    <input class="form-control" type="tel" placeholder="00-00" name="pages" value="{{ old('pages') }}" id="articlePages">
                </div>
                <div class="form-group">
                    <label for="publicationLanguage">
                        Language @include('pieces.required-star')
                    </label>
                    <select name="language_id" class="form-control" id="publicationLanguage" required>
                        <option></option>
                        @foreach($languages as $language)
                        <option value="{{ $language }}">{{ $language }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <input type="file">
                </div>
        <small class="form-text text-muted">@include('pieces.required-star') - Field is required</small>

                <hr>
                <button type="submit" class="btn btn-primary">Submit</button>

            {!! Form::close() !!}
    </div>
@endsection
