@if (!empty($postTableButtons))
    @foreach($postTableButtons as $buttonKey=>$button)
        <a class="btn btn-sm btn-primary"
           href="{{route($resource . '.' . $buttonKey)}}">
            {{ $button['title'] ?? '' }}
        </a>
    @endforeach
@endif
