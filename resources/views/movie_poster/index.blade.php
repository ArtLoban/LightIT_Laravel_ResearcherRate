@extends('layouts.main')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-lg-6">
                <h4 class="my-4">Poster</h4>
                <h3 class="my-4">{{ \Carbon\Carbon::today()->format('m F') }}</h3>
            </div>
        </div>
        <div class="card-deck">
            @foreach($movies as $movie)
                <div class="card">
                    <img class="card-img-top" src="{{ \App\Services\MovieParser\MovieParser::DOVZHENKO_DOMAIN . $movie->poster_path }}" alt="Card image cap">
                    <div class="card-body">
                        <h5 class="card-title">{{ $movie->name }}</h5>
                        <p class="card-text">{{ $movie->time }}</p>
                    </div>
                </div>
            @endforeach
        </div>

        @for($page = 1; $page < count($movies)/2; $page++)
            <div class="card-deck">
                @foreach($movies->forPage($page, 3) as $movie)
                    <div class="card">
                        <img
                            class="card-img-top"
                            src="{{ \App\Services\MovieParser\MovieParser::DOVZHENKO_DOMAIN . $movie->poster_path }}"
                            alt="Card image cap"
                        >
                        <div class="card-body">
                            <h5 class="card-title">{{ $movie->name }}</h5>
                            <p class="card-text">{{ $movie->time }}</p>
                        </div>
                    </div>
                @endforeach
            </div>
        @endfor

        @foreach($movies as $movie)
            <div class="card text-white bg-secondary mb-3" style="max-width: 18rem;">
                <div class="card-header">{{ $movie->name }}</div>
                <div class="card-body">
                    <h5 class="card-title">{{ $movie->time }}</h5>
                    <img class="card-img-top" src="{{ \App\Services\MovieParser\MovieParser::DOVZHENKO_DOMAIN . $movie->poster_path }}" alt="Card image cap">
                </div>
            </div>
        @endforeach
    </div>
@endsection

