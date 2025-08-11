<nav class="navbar navbar-expand-lg navbar-light bg-white shadow-sm">
    <div class="container">
        <a class="navbar-brand" href="/">{{ config('app.name', 'Shop') }}</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarMain" aria-controls="navbarMain" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarMain">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        Каталог
                    </a>
                    <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                        @isset($navCategories)
                            @foreach($navCategories as $cat)
                                <a class="dropdown-item" href="{{ route('category.show', $cat) }}">{{ $cat->name }}</a>
                            @endforeach
                        @endisset
                    </div>
                </li>
            </ul>
            <ul class="navbar-nav ml-auto">
                <li class="nav-item"><a class="nav-link" href="#">О нас</a></li>
                <li class="nav-item"><a class="nav-link" href="#">Контакты</a></li>
            </ul>
        </div>
    </div>
</nav>
