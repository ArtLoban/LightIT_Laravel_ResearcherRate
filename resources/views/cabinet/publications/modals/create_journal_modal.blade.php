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

            @include('components.errors')

            <div class="modal-body">
                <div class="form-group">
                    <label for="modalJournalName">
                        Journal Name @include('components.required-star')
                    </label>
                    <input type="text" class="form-control form-control-sm" id="modalJournalName" name="name" value="{{ old('name') }}" required>
                </div>
                <div class="form-group">
                    <label for="issnNumber">
                        ISSN code @include('components.required-star')
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
                        Country @include('components.required-star')
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
                        Type @include('components.required-star')
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