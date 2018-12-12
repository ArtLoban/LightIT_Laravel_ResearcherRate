@extends('admin.layout')

@section('content')
    <div class="content-wrapper">
        <section class="content-header">
            <h1>Theses</h1>
        </section>
        <section class="content">
            <div class="box">
                <div class="box-body">
                    <div class="form-group">
                        <a href="{{ route('theses.create') }}" class="btn btn-success">Add</a>
                    </div>
                    <table id="example1" class="table table-bordered table-striped">
                        <thead>
                        <tr>
                            <th>ID</th>
                            <th>Name</th>
                            <th>Authors</th>
                            <th>Thesis Digest</th>
                            <th>Type</th>
                            <th>Language</th>
                            <th>Year</th>
                            <th>Pages</th>
                            <th>Actions</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($theses as $thesis)
                            <tr>
                                <td>{{ $thesis->getKey() }}</td>
                                <td>{{ $thesis->name }}</td>
                                <td>{{ $thesis->authors->pluck('name')->implode(', ') }}</td>
                                <td>{{ $thesis->thesisDigest->name }}</td>
                                <td>{{ $thesis->publicationType->name }}</td>
                                <td>{{ $thesis->language }}</td>
                                <td>{{ $thesis->year }}</td>
                                <td>{{ $thesis->pages }}</td>
                                <td>
                                    <a href="{{ route('theses.edit', $thesis->getKey()) }}" class="fa fa-pencil"></a>
                                    {!! Form::open([
                                        'route' => ['theses.destroy', $thesis->getKey()],
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
