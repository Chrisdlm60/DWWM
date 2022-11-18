@extends('template')

@section('content')
    <div class="card">
        <header class="card-header">
            <p class="card-header-title">Titre : {{ $film->title }}</p>
        </header>
        <div class="card-content">
            <div class="content">
                <p>Année de sortie : {{ $film->year }}</p>
                <hr>
                <p>Catégorie : </p>
                <ul>
                    @foreach($film->categories as $category)
                        <li>{{ $category->name }}</li>
                    @endforeach
                </ul>
                <hr>
                <p>Acteurs :</p>
                <ul>
                    @foreach($film->actors as $actor)
                        <li>{{ $actor->name }}</li>
                    @endforeach
                </ul>
                <hr>
                <p>{{ $film->description }}</p>
            </div>
        </div>
    </div>
@endsection
