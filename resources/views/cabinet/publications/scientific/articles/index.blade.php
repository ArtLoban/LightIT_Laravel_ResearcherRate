@extends('cabinet.main')

@section('cabinet')
    <div class="col-lg-10">
        <div class="mt-4">
            <p class="h5">Publications / Scientific / <span class="publication-tipe-title">Articles</span></p>
        </div>
        @if (session('status'))
            <div class="alert alert-success">
                {{ session('status') }}
            </div>
        @endif
        <div>
            <p>Total count: <b>{{ $articles->count() }}</b></p>
        </div>
        <div class="form-group">
            <a href="{{ route('scientific.articles.create') }}" class="btn btn-success">Add new article</a>
        </div>
        <hr>
        @if(! $articles->isEmpty())
            <div class="row justify-content-center">
                <div class="col-12">
                    <div class="col">
                        <p>Articles list</p>
                    </div>
                    <div class="table-responsive">
                        <table class="table text-center" cellspacing="0">
                            <thead class="thead-dark">
                            <tr class="table">
                                <th>#</th>
                                <th>Name</th>
                                <th>Authors</th>
                                <th>Journal</th>
                                <th>Date of publication</th>
                                <th>Type</th>
                                <th>Number</th>
                                <th>Pages</th>
                                <th>Language</th>
                            </tr>
                            </thead>
                            <tbody>
                                @foreach($articles as $article)
                                    <tr class="table">
                                        <td>{{ $loop->iteration . '.'}}</td>
                                        <td>
                                            <a href="{{ route('scientific.articles.show', $article->getKey()) }}">
                                                {{ $article->name }}
                                            </a>
                                        </td>
                                        <td>{{ $article->authors->pluck('name')->implode(', ') }}</td>
                                        <td>{{ $article->journal->name }}</td>
                                        <td>{{ $article->year }}</td>
                                        <td>{{ $article->publicationType->name }}</td>
                                        <td>{{ $article->journal_number }}</td>
                                        <td>{{ $article->pages }}</td>
                                        <td>{{ $article->language }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            @else
                <div class="row justify-content-center">
                    <div class="col">
                        <p class="text-center">... no articles added yet</p>
                    </div>
                </div>
            @endif
    </div>
@endsection
