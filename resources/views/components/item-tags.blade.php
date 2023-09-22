@props(['tags'])

<ul class="flex flex-wrap">
    @foreach ($tags as $tag)

            <a class="bg-black text-white text-xl rounded px-3 py-2 mr-2 mb-2"
            href="/?tag={{$tag->name}}">#{{$tag->name}}</a>

    @endforeach
</ul>
