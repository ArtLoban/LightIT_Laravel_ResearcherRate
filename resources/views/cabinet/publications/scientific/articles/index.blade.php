@extends('cabinet.main')

@section('cabinet')
    <div class="col-lg-10">
        <div class="mt-4">
            <p class="h5">Publications/Scientific/Articles</p>
        </div>
        <div>
            <p>Total count: 3</p>
        </div>
        <div class="form-group">
            <a href="{{ route('articles.create') }}" class="btn btn-success">Add new article</a>
        </div>
        <hr>
        {{--@if(! $orders->isEmpty())--}}
            <div class="row justify-content-center">
                <div class="col-12">
                    <div class="col">
                        <p>Articles list</p>
                    </div>
                    <div class="table-responsive">
                        <table class="table text-center" cellspacing="0">
                            <thead class="thead-dark">
                            <tr class="table">
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
                                <tr class="table">
                                    <td>(Coumarin-3-yl)-benzoates as a Series of New Fluorescent Compounds: Synthesis, Characterization and Fluorescence Properties in the Solid State</td>
                                    <td>Sosso Siaka, Jules Yoda, Abdoulaye Djandé, Bruno Coulomb</td>
                                    <td>American Journal of Organic Chemistry</td>
                                    <td>2018</td>
                                    <td>Scientific</td>
                                    <td>8(2)</td>
                                    <td>32-36</td>
                                    <td>En</td>
                                </tr>
                                <tr class="table">
                                    <td>(Coumarin-3-yl)-benzoates as a Series of New Fluorescent Compounds: Synthesis, Characterization and Fluorescence Properties in the Solid State</td>
                                    <td>Sosso Siaka, Jules Yoda, Abdoulaye Djandé, Bruno Coulomb</td>
                                    <td>American Journal of Organic Chemistry</td>
                                    <td>2018</td>
                                    <td>Scientific</td>
                                    <td>8(2)</td>
                                    <td>32-36</td>
                                    <td>En</td>
                                </tr>
                                <tr class="table">
                                    <td>(Coumarin-3-yl)-benzoates as a Series of New Fluorescent Compounds: Synthesis, Characterization and Fluorescence Properties in the Solid State</td>
                                    <td>Sosso Siaka, Jules Yoda, Abdoulaye Djandé, Bruno Coulomb</td>
                                    <td>American Journal of Organic Chemistry</td>
                                    <td>2018</td>
                                    <td>Scientific</td>
                                    <td>8(2)</td>
                                    <td>32-36</td>
                                    <td>En</td>
                                </tr>
                            {{--@foreach($orders as $order)--}}
                                {{--<tr class="table">--}}
                                    {{--<td>{{ $loop->iteration }}</td>--}}
                                    {{--<td>{{ $order->created_at }}</td>--}}
                                    {{--<td class="text-left">{{ $order->dishOrders->pluck('dish')->implode('name', ', ') }}</td>--}}
                                    {{--<td>-</td>--}}
                                    {{--<td>{{ $order->status->name }}</td>--}}
                                {{--</tr>--}}
                            {{--@endforeach--}}

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            {{--@else--}}
                {{--<div class="row justify-content-center">--}}
                    {{--<div class="col">--}}
                        {{--<p class="text-center">У вас пока нет заказов</p>--}}
                    {{--</div>--}}
                {{--</div>--}}
            {{--@endif--}}
    </div>
@endsection
