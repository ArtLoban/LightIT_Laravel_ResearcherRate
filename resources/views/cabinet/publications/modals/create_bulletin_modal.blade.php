<!-- Modal Form -->
<div class="modal fade" id="bulletinModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Add Bulletin publication</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            {!! Form::open(['route' => 'scientific.patent_bulletin.store', 'method' => 'POST']) !!}

            @include('components.errors')

            <div class="modal-body">
                <div class="form-group">
                    <label for="modalBulletinWeek">
                        Week @include('components.required-star')
                    </label>
                    <input
                        type="number"
                        pattern="[0-9]{2}"
                        min="1"
                        max="52"
                        class="form-control form-control-sm"
                        id="modalBulletinWeek"
                        name="week"
                        placeholder="_ _"
                        value="{{ old('week') }}"
                        required
                    >
                </div>
                <div class="form-group">
                    <label for="modalBulletinYear">
                        Year @include('components.required-star')
                    </label>
                    <input
                        type="number"
                        pattern="[0-9]{4}"
                        min="1900"
                        class="form-control form-control-sm"
                        id="modalBulletinYear"
                        name="year"
                        placeholder="_ _ _ _"
                        value="{{ old('year') }}"
                        required
                    >
                </div>
                <div class="form-group">
                    <label for="bulletinDate">
                        Date @include('components.required-star')
                    </label>
                    <input type="date" class="form-control form-control-sm" id="bulletinDate" name="date" value="{{ old('date') }}" required>
                </div>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary" id="ajax-submit-journal">Save</button>
            </div>
            {!! Form::close() !!}
        </div>
    </div>
</div>