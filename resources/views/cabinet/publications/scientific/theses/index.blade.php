@extends('cabinet.main')

@section('cabinet')
    <div class="col-lg-10">
        <div class="mt-4">
            <p class="h5">Publications / Scientific / <span class="publication-tipe-title">Theses</span></p>
        </div>
        @if (session('status'))
            <div class="alert alert-success">
                {{ session('status') }}
            </div>
        @endif
        <div>
            <p>Total count: <b>{{ $theses->count() }}</b></p>
        </div>
        <div class="form-group">
            <a href="{{ route('scientific.theses.create') }}" class="btn btn-success">Add new thesis</a>
        </div>
        <hr>
        @if(! $theses->isEmpty())
            <div class="row justify-content-center">
                <div class="col-12">
                    <div class="col">
                        <p>Theses list</p>
                    </div>
                    <div class="table-responsive">
                        <table class="table text-center" cellspacing="0">
                            <thead class="thead-dark">
                            <tr class="table">
                                <th>#</th>
                                <th>Name</th>
                                <th>Authors</th>
                                <th>Thesis Digest</th>
                                <th>Type</th>
                                <th>Language</th>
                                <th>Year</th>
                                <th>Pages</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($theses as $thesis)
                                <tr class="table">
                                    <td>{{ $loop->iteration . '.'}}</td>
                                    <td>
                                        <a href="{{ route('scientific.theses.show', $thesis->getKey()) }}">
                                            {{ $thesis->name }}
                                        </a>
                                    </td>
                                    <td>{{ $thesis->authors->pluck('name')->implode(', ') }}</td>
                                    <td>{{ $thesis->thesisDigest->name }}</td>
                                    <td>{{ $thesis->publicationType->name }}</td>
                                    <td>{{ $thesis->language }}</td>
                                    <td>{{ $thesis->year }}</td>
                                    <td>{{ $thesis->pages }}</td>
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
                    <p class="text-center">... no theses added yet</p>
                </div>
            </div>
        @endif
    </div>
@endsection
