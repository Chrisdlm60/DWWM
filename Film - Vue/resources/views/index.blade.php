@extends('template')
@section('css')
    <style>
        .card-footer {
            justify-content: center;
            align-items: center;
            padding: 0.4em;
        }
        select, .is-info {
            margin: 0.3em;
        }
    </style>
@endsection
@section('content')
    @if(session()->has('info'))
        <x-notification :text="session('info')"/>
    @endif
    <div class="card">
        <header class="card-header">
            <p class="card-header-title">Films</p>
            <div class="select">
                <select onchange="window.location.href = this.value">
                    <option value="{{ route('films.index') }}" @unless($slug) selected @endunless>Toutes catégories</option>
                    @foreach($categories as $category)
                        <option value="{{ route('films.category', $category->slug) }}" {{ $slug == $category->slug ? 'selected' : '' }}>{{ $category->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="select">
                <select onchange="window.location.href = this.value">
                    <option value="{{ route('films.index') }}" @unless($slug) selected @endunless>Tous acteurs</option>
                    @foreach($actors as $actor)
                        <option value="{{ route('films.actor', $actor->slug) }}" {{ $slug == $actor->slug ? 'selected' : '' }}>{{ $actor->name }}</option>
                    @endforeach
                </select>
            </div>
            <a class="button is-info" href="{{ route('films.create') }}">Créer un film</a>
        </header>
        <div class="card-content">
            <div class="content">
                <table class="table is-hoverable">
                    <thead>
                        <tr>
                            <th>Titre</th>
                            <th></th>
                            <th></th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        @include('partials.lines')
                    </tbody>
                </table>
            </div>
        </div>
        <footer class="card-footer is-centered">
            {{ $films->links() }}
        </footer>
    </div>
@endsection
