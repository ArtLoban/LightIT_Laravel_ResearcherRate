@extends('admin.layout')

@section('content')
    <div class="content-wrapper">
        <section class="content-header">
            <h1>Journals</h1>
        </section>
        <section class="content">
            <div class="box">
                <div class="box-body">
                    <div class="form-group">
                        <a href="{{ route('admin.journals.create') }}" class="btn btn-success">Add</a>
                    </div>
                    <table id="example1" class="table table-bordered table-striped">
                        <thead>
                        <tr>
                            <th>ID</th>
                            <th>Name</th>
                            <th>ISSN code</th>
                            <th>Country</th>
                            <th>Category</th>
                            <th>Type</th>
                            <th>Actions</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($journals as $journal)
                            <tr>
                                <td>{{ $journal->getKey() }}</td>
                                <td>{{ $journal->name }}</td>
                                <td>{{ $journal->issn }}</td>
                                <td>{{ $journal->country }}</td>
                                <td>{{ $journal->category }}</td>
                                <td>
                                    {{ $journal->journalType ? $journal->journalType->name : '' }}
                                </td>
                                <td>
                                    <a href="{{ route('admin.journals.edit', $journal->getKey()) }}" class="fa fa-pencil"></a>
                                    {!! Form::open([
                                        'route' => ['admin.journals.destroy', $journal->getKey()],
                                        'method' => 'delete'])
                                    !!}
                                    <button type="submit" class="delete-task" onclick="return confirm('Are you sure?')">
                                        <a class="fa fa-remove"></a>
                                    </button>
                                    {!! Form::close() !!}
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </section>
    </div>
@endsection
