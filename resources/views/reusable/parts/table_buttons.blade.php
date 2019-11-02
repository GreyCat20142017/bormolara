@if (!empty($tableButtons))
    @foreach($tableButtons as $buttonKey=>$button)
        <td class="text-center">
            @if ($buttonKey === 'destroy')
                <form class="text-center p-0 m-0"
                      action="{{route($resource . '.destroy', $row)}}"
                      method="POST">
                    @csrf
                    @method('DELETE')
                    <button class="btn btn-sm btn-link" type="submit">
                        <span class="text-danger btn-link-danger">{{$button['title']}}</span>
                    </button>
                </form>
            @else
                <a class="btn btn-sm btn-link"
                   href="{{route($resource . '.' . $buttonKey, $row->id)}}">
                    {{ $button['title'] ?? '' }}
                </a>
            @endif
        </td>
    @endforeach
@endif
