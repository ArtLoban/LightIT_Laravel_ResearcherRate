@extends('cabinet.main')

@section('cabinet')
    <div class="col-lg-10">
        <div class="mt-4">
            <p class="h4">{{ $article->name }}</p>
        </div>
        <button type="submit" class="btn ">
            <a href="{{ route('articles.index')}}" class="">Back</a>
        </button>
        <hr>
        <div class="container article-item">
            <div class="row">
                <div class="col-2 text-right article-item-header">
                    Authors
                </div>
                <div class="col-10">
                    {{ $article->authors->pluck('name')->implode(', ') }}
                </div>
            </div>
            <div class="row">
                <div class="col-2 text-right article-item-header">
                    Year of publication
                </div>
                <div class="col-10">
                    {{ $article->year }}
                </div>
            </div>
            <div class="row">
                <div class="col-2 text-right article-item-header">
                    Journal
                </div>
                <div class="col-10">
                    {{ $article->journal->name }}
                </div>
            </div>
            <div class="row">
                <div class="col-2 text-right article-item-header">
                    Number
                </div>
                <div class="col-10">
                    {{ $article->journal_number }}
                </div>
            </div>
            <div class="row">
                <div class="col-2 text-right article-item-header">
                    Pages
                </div>
                <div class="col-10">
                    {{ $article->pages }}
                </div>
            </div>
            <div class="row">
                <div class="col-2 text-right article-item-header">
                    Description
                </div>
                <div class="col-10">
                    {{ $article->description }}
                </div>
            </div>
            <div class="row">
                <div class="col-2 text-right article-item-header">
                    Type
                </div>
                <div class="col-10">
                    {{ $article->publicationType->name }}
                </div>
            </div>
            <div class="row">
                <div class="col-2 text-right article-item-header">
                    Language
                </div>
                <div class="col-10">
                    {{ $article->language }}
                </div>
            </div>
        </div>
        <hr>
        <div class="form-group">
            <a href="#" class="btn btn-light">View file</a>
            <a href="#" class="btn btn-light">Download file</a>
        </div>
    </div>
@endsection
