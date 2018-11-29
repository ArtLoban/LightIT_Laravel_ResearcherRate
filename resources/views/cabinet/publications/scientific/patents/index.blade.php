@extends('cabinet.main')

@section('cabinet')
    <div class="col-lg-10">
        <div class="mt-4">
            <p class="h5">Publications / Scientific / <span class="publication-tipe-title">Patents</span></p>
        </div>
        @if (session('status'))
            <div class="alert alert-success">
                {{ session('status') }}
            </div>
        @endif
        <div>
            <p>Total count: <b>{{ $patents->count() }}</b></p>
        </div>
        <div class="form-group">
            <a href="{{ route('scientific.patents.create') }}" class="btn btn-success">Add new patent</a>
        </div>
        <hr>
        @if(! $patents->isEmpty())
            <div class="row justify-content-center">
                <div class="col-12">
                    <div class="col">
                        <p>Patent list</p>
                    </div>
                    <div class="table-responsive">
                        <table class="table text-center" cellspacing="0">
                            <thead class="thead-dark">
                            <tr class="table">
                                <th>Name</th>
                                <th>IPC</th>
                                <th>Patent number</th>
                                <th>Application number</th>
                                <th>Filing date</th>
                                <th>Priority date</th>
                                <th>Inventors</th>
                            </tr>
                            </thead>
                            <tbody>
                                @foreach($patents as $patent)
                                    <tr class="table">
                                        <td>
                                            <a href="{{ route('scientific.patents.show', $patent->getKey()) }}">
                                                {{ $patent->name }}
                                            </a>
                                        </td>
                                        <td>{{ $patent->ipc }}</td>
                                        <td>{{ $patent->patent_number }}</td>
                                        <td>{{ $patent->application_number }}</td>
                                        <td>{{ $patent->filing_date }}</td>
                                        <td>{{ $patent->priority_date }}</td>
                                        <td>{{ $patent->authors->pluck('name')->implode(', ') }}</td>
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
                        <p class="text-center">... no patents added yet</p>
                    </div>
                </div>
            @endif
    </div>
@endsection
