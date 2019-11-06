@if (!empty($tableButtons))
    @foreach($tableButtons as $button)
        <td class="text-center">
            @if ($button['type'] === 'destroy')
                <form class="text-center p-0 m-0"
                      action="{{route($button['route'], $row)}}"
                      method="POST">
                    @csrf
                    @method('DELETE')
                    <button class="btn btn-sm btn-link" type="submit">
                        <span class="text-danger btn-link-danger">{{$button['title']}}</span>
                    </button>
                </form>
            @elseif ($button['type'] === 'child')
                <a class="btn btn-sm btn-link"
                   href="{{route($button['route'] , [$button['filter'] => $row->id])}}">
                    {{ $button['title'] ?? '' }}
                </a>
            @else
                <a class="btn btn-sm btn-link"
                   href="{{route($button['route'] , $row->id)}}">
                    {{ $button['title'] ?? '' }}
                </a>
            @endif
        </td>
    @endforeach
@endif
