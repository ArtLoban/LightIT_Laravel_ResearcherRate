<!-- Modal Form -->
<div class="modal fade" id="ajax-digestModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Add new digest</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            {!! Form::open(['route' => 'scientific.digests.store', 'class' => 'ajax-create-form', 'method' => 'POST']) !!}

            @include('components.errors')

            <div class="modal-body">
                <div class="form-group">
                    <label for="modalDigestName">
                        Digest Name @include('components.required-star')
                    </label>
                    <input type="text" class="form-control form-control-sm" id="modalDigestName" name="name" value="{{ old('name') }}" required>
                </div>
                <div class="form-group">
                    <label for="isbnNumber">
                        ISBN code @include('components.required-star')
                    </label>
                    <input
                            type="text"
                            class="form-control form-control-sm"
                            id="isbnNumber"
                            name="isbn"
                            value="{{ '978-5-9904243-3-3' }}"
                            required
                    >
                </div>
                <div class="form-group">
                    <label for="typeName">
                        Type @include('components.required-star')
                    </label>
                    <input type="text" class="form-control form-control-sm" id="typeName" name="type" value="{{ 'Сборник тезисов конференции' }}" required>
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
                    <label for="yearDiges">
                        Year
                    </label>
                    <input type="text" class="form-control form-control-sm" id="yearDiges" name="year" value="{{ old('year') }}" required>
                </div>
                <div class="form-group">
                    <label for="pagesDiges">
                        Pages
                    </label>
                    <input type="text" class="form-control form-control-sm" id="pagesDiges" name="pages" value="{{ old('pages') }}" required>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary" id="ajax-submit-digest">Save</button>
            </div>
            {!! Form::close() !!}
        </div>
    </div>
</div>