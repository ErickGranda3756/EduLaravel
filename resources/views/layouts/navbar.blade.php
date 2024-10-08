<div class="category-container">
    <ul>
        <li class="nav-item {{request()->routeIs("home.index")?'active': ''}}"><a href="{{route("home.index")}}">Todo</a></li>
        @foreach ($navbar as $category)
        {{-- evitar ataques xss es decir no se puede modificar desde el frontend los datos --}}
        <li class="nav-item {!!(Request::path())=='category/'. $category->slug ? 'active' : '' !!}">
            <a href="{{route('categories.detail',$category->slug)}}">{{$category->name}}</a>
        </li>
        @endforeach

        <li class="nav-item {{request()->routeIs("home.all")?'active': ''}}">
            <a href="{{route("home.all")}}">Todas las categorias</a>
        </li>

    </ul>
</div>