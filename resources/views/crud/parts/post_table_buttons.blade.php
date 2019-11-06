@if (!empty($postTableButtons))
    @foreach($postTableButtons as $button)
        <a class="btn btn-sm btn-primary"
           href="{{route($button['route' ?? 'main'])}}">
            {{ $button['title'] ?? '' }}
        </a>
    @endforeach
@endif

