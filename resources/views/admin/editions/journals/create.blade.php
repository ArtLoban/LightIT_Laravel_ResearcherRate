@extends('admin.layout')

@section('content')
    <div class="content-wrapper">
        <section class="content-header">
            <h1>Add journal</h1>
        </section>
        <section class="content">
            {!! Form::open(['route' => 'admin.journals.store']) !!}
            <div class="box">
                <div class="box-body">
                    <div class="col-md-6">

                        @include('components.errors')

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
                </div>
                <div class="box-body">
                    <p class="help-block">
                        <span class="field-required_star"> *</span> - Field is required
                    </p>
                </div>
                <div class="box-footer">
                    <button class="btn btn-success">Add</button>
                    <a href="{{ route('admin.journals.index')}}" class="btn btn-default">Back</a>
                </div>
            </div>
            {!! Form::close() !!}
        </section>
    </div>
@endsection
