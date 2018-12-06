@extends('admin.layout')

@section('content')
    <div class="content-wrapper">
        <section class="content-header">
            <h1>Patents</h1>
        </section>
        <section class="content">
            <div class="box">
                <div class="box-body">
                    <div class="form-group">
                        <a href="{{ route('patents.create') }}" class="btn btn-success">Add</a>
                    </div>
                    <table id="example1" class="table table-bordered table-striped">
                        <thead>
                        <tr>
                            <th>ID</th>
                            <th>Name</th>
                            <th>IPC</th>
                            <th>Patent number</th>
                            <th>Application number</th>
                            <th>Filing date</th>
                            <th>Priority date</th>
                            <th>Inventors</th>
                            <th>Patent Bulletin</th>
                            <th>Actions</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($patents as $patent)
                            <tr>
                                <td>{{ $patent->getKey() }}</td>
                                <td>{{ $patent->name }}</td>
                                <td>{{ $patent->ipc }}</td>
                                <td>{{ $patent->patent_number }}</td>
                                <td>{{ $patent->application_number }}</td>
                                <td>{{ $patent->filing_date }}</td>
                                <td>{{ $patent->priority_date }}</td>
                                <td>{{ $patent->authors->pluck('name')->implode(', ') }}</td>
                                <td>
                                    {{ '(' . $patent->patentBulletin->week .'/' . $patent->patentBulletin->year . ') ' . $patent->patentBulletin->date->format('d.m.Y') }}
                                </td>
                                <td>
                                    <a href="{{ route('patents.edit', $patent->getKey()) }}" class="fa fa-pencil"></a>
                                    {!! Form::open([
                                        'route' => ['patents.destroy', $patent->getKey()],
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
