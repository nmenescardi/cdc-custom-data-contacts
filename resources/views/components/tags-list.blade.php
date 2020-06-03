@props(['tagList'])

<div class="tags">
    @foreach ($tagList as $tag)
    <span class="tag badge badge-pill bg-color-{{$tag->color}}">
        <a href="{{ route('tags.edit', ['tag' => $tag] ) }}">
            {{$tag->name}}
        </a>
    </span>
    @endforeach
</div>
