@props(['tags'])

<ul class="flex">
    @foreach ($tags as $tag)
        <li class="bg-black text-white rounded-xl px-3 py-1 mr-2">
            <a href="/?tag={{$tag->name}}">{{$tag->name}}</a>
        </li>
    @endforeach
</ul>
