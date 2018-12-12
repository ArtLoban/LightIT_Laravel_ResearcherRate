@extends('admin.layout')

@section('content')
    <div class="content-wrapper">
        <section class="content-header">
            <h1>Articles</h1>
        </section>
        <section class="content">
            <div class="box">
                <div class="box-body">
                    <div class="form-group">
                        <a href="{{ route('articles.create') }}" class="btn btn-success">Add</a>
                    </div>
                    <table id="example1" class="table table-bordered table-striped">
                        <thead>
                        <tr>
                            <th>ID</th>
                            <th>Name</th>
                            <th>Authors</th>
                            <th>Journal</th>
                            <th>Date of publication</th>
                            <th>Type</th>
                            <th>Number</th>
                            <th>Pages</th>
                            <th>Language</th>
                            <th>Actions</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($articles as $article)
                            <tr>
                                <td>
                                    {{ $article->getKey() }}
                                </td>
                                <td>{{ $article->name }}</td>
                                <td>{{ $article->authors->pluck('name')->implode(', ') }}</td>
                                <td>{{ $article->journal->name }}</td>
                                <td>{{ $article->year }}</td>
                                <td>{{ $article->publicationType->name }}</td>
                                <td>{{ $article->journal_number }}</td>
                                <td>{{ $article->pages }}</td>
                                <td>{{ $article->language }}</td>
                                <td>
                                    <a href="{{ route('articles.edit', $article->getKey()) }}" class="fa fa-pencil"></a>
                                    {!! Form::open([
                                        'route' => ['articles.destroy', $article->getKey()],
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
