@foreach($films as $film)
<tr @if($film->deleted_at) class="has-background-grey-lighter" @endif>
    <td><strong>{{ $film->title }}</strong></td>
    <td>
        @if($film->deleted_at)
        <form action="{{ route('films.restore', $film->id) }}" method="post">
            @csrf
            @method('PUT')
            <button class="button is-primary" type="submit">Restaurer</button>
        </form>
        @else
        <a class="button is-primary" href="{{ route('films.show', $film->id) }}">Voir</a>
        @endif
    </td>
    <td>
        @if($film->deleted_at)
        @else
        <a class="button is-warning" href="{{ route('films.edit', $film->id) }}">Modifier</a>
        @endif
    </td>
    <td>
        <form action="{{ route($film->deleted_at? 'films.force.destroy' : 'films.destroy', $film->id) }}" method="post">
            @csrf
            @method('DELETE')
            <button class="button is-danger" type="submit">Supprimer</button>
        </form>
    </td>
</tr>
@endforeach
