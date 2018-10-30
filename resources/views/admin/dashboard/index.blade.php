@extends('admin.layout')

@section('content')

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Главная страница
        </h1>
    </section>
    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col">
                <!-- LINE CHART -->
                <div class="box box-info">
                    <div class="box-header with-border">
                        <h3 class="box-title">Динамика продаж блюд</h3>

                        <div class="box-tools pull-right">
                            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                            </button>
                            <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
                        </div>
                    </div>
                    <div class="box-body">
                        <div class="chart">
                            {!! $chart->container() !!}
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-4">
                {!! Form::open(['route' => 'dashboard.store']) !!}
                <div class="form-group">
                    <label>Список блюд, имеющих статистику</label>
                    <select name="dish_id" class="form-control select2 select2-hidden-accessible" data-placeholder="Select here" style="width: 100%;" tabindex="-1" aria-hidden="true">
                        @foreach($dishOrders as $dishOrder)
                            <option value="{{ $dishOrder->dish->getKey() }}">{{ $dishOrder->dish->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="box-footer">
                    <button class="btn btn-success">Добавить кривую</button>
                </div>
                {!! Form::close() !!}
            </div>
        </div>
    </section>
    <!-- /.content -->
    {!! $chart->script() !!}
</div>

@endsection