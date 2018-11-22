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
            <a class="btn btn-outline-success" href="{{ route('articles.index')}}">Back</a>
        </div>
        <hr>
        <!-- Modal Form -->
        <div class="modal fade" id="ajax-journalModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Add new journal</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>

                    {!! Form::open(['route' => 'journals.store', 'class' => 'ajax-create-form', 'method' => 'POST']) !!}

                        @include('pieces.errors')

                        <div class="modal-body">
                            <div class="form-group">
                                <label for="modalJournalName">
                                    Journal Name @include('pieces.required-star')
                                </label>
                                <input type="text" class="form-control form-control-sm" id="modalJournalName" name="name" value="{{ old('name') }}" required>
                            </div>
                            <div class="form-group">
                                <label for="issnNumber">
                                    ISSN code @include('pieces.required-star')
                                </label>
                                <input
                                    type="text"
                                    class="form-control form-control-sm"
                                    id="issnNumber"
                                    name="issn"
                                    value="{{ '1050-124X' }}"
                                    required
                                >
                            </div>
                            <div class="form-group">
                                <label for="countryName">
                                    Country @include('pieces.required-star')
                                </label>
                                <input type="text" class="form-control form-control-sm" id="countryName" name="country" value="{{ 'Ukraine' }}" required>
                            </div>
                            <div class="form-group">
                                <label for="categoryName">
                                    Category
                                </label>
                                <input type="text" class="form-control form-control-sm" id="categoryName" name="category" value="{{ 'Chemistry' }}" required>
                            </div>
                            <div class="form-group">
                                <label for="typeName">
                                    Type @include('pieces.required-star')
                                </label>
                                <select name="journal_type_id" class="form-control form-control-sm" id="typeName" required>
                                    <option></option>
                                    @foreach($journalTypes as $journalType)
                                        <option value="{{ $journalType->getKey() }}">{{ $journalType->name }}</option>
                                    @endforeach
                                </select>
                            </div>

                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button type="button" class="btn btn-primary" id="ajax-submit-journal">Save</button>
                        </div>
                    {!! Form::close() !!}
                </div>
            </div>
        </div>

        {!! Form::open(['route' => 'articles.store', 'files' => true]) !!}

            @include('pieces.errors')
            <div class="form-group">
                <label for="articleName">
                    Article Name @include('pieces.required-star')
                </label>
                <input type="text" class="form-control form-control-sm" id="articleName" name="name" value="{{ old('name') }}" required>
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
                    value="{{ old('authors') }}"
                    required
                >
                <small class="form-text text-muted">Enter the names of the authors using ',' as a separator</small>
                <input type="hidden" id="ajax-authors-autocomplete" value="{{ route('articles.authors') }}">
            </div>
            <div class="form-group">
                <label for="articleDescription">Description</label>
                <textarea class="form-control form-control-sm" id="articleDescription" rows="3" name="description">{{ old('description') }}</textarea>
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
                        <option value="{{ $publicationType->getKey() }}">{{ $publicationType->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <label for="journalName">
                    Journal Name @include('pieces.required-star')
                </label>
                <!-- Link Button trigger modal -->
                <a href="#" class="btn btn-outline-info btn-sm" data-toggle="modal" data-target="#ajax-journalModal">Add journal</a>
                <input type="text" class="form-control form-control-sm" id="journalName" name="journal_name" value="{{ old('journal_name') }}" required>
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
                    value="{{ old('journal_number') }}"
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
                    value="{{ old('year') }}"
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
                    value="{{ old('pages') }}"
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
                    <option value="{{ $language }}">{{ $language }}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <label for="uploadFile">Upload file</label>
                <input type="file" class="form-control-file  form-control-sm" name="file" id="uploadFile">
            </div>
            <small class="form-text text-muted">Acceptable file extensions: .pdf, .doc, .docx</small>
            <small class="form-text text-muted">@include('pieces.required-star') - Field is required</small>
            <hr>
            <button type="submit" class="btn btn-primary">Submit</button>

        {!! Form::close() !!}
    </div>
@endsection
