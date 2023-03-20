<nav class="navbar navbar-expand-lg bg-body-tertiary bg-primary">
    <div class="container-fluid">
      <a class="navbar-brand" href="{{route('welcome')}}">Home</a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav me-auto mb-2 mb-lg-0">
          <li class="nav-item">
            <a class="nav-link active" aria-current="page" href="{{route('announcements.index')}}">Annunci</a>
          </li>

          <li class="nav-item dropdown">
            <!-- CATEGORIES -->
            <a href="#" class="nav-link dropdown-toggle" role="button" data-bs-toggle="dropdown" aria-expanded="false">Categorie</a>
            <ul class="dropdown-menu">
              @foreach ($categories as $category)
                  <li><a class="dropdown-item" href="{{route('categoryShow', compact('category'))}}" class="dropdown-item">{{$category->name}}</a></li>
                  <li><hr class="dropdown-divider"></li>
              @endforeach
            </ul>
            
          </li>
          
              @guest
                <li class="nav-item"><a href="{{route('login')}}" class="nav-link">Login</a></li>
                <li class="nav-item"><a href="{{route('register')}}" class="nav-link">Registrati</a></li>
              @else
                <li class="nav-item"><a class="nav-link active" href="{{route('announcements.create')}}">Aggiungi il tuo annuncio</a></li>
                <li class="nav-item dropdown">
                  <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">{{Auth::user()->name}}</a>
                  <ul class="dropdown-menu">
                  @if (Auth::user()->is_revisor)
                    <li>
                      <a class="dropdown-item" href="{{route('revisor.index')}}">Zona revisore</a>
                      <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
                        {{App\Models\Announcement::toBeRevisionedCount()}}
                        <span class="visually-hidden">unread messages</span>
                      </span>
                    </li>
                    <li><hr class="dropdown-divider"></li>
                  @endif
                  <li><a class="dropdown-item" href="#">Something else here</a></li>
                  <li><a href="/logout" class="dropdown-item" onclick="event.preventDefault();getElementById('form-logout').submit();">Logout</a></li>
                  </ul>
                  <form id="form-logout" action="{{route('logout')}}" method="POST" class="d-none">
                  @csrf
                  </form>
                </li>
              @endguest
              <li class="nav-item">
                <x-_locale lang="it"></x-locale>
              </li>
              <li class="nav-item">
                <x-_locale lang="en"></x-locale>
              </li>
              <li class="nav-item">
                <x-_locale lang="es"></x-locale>
              </li>
        </ul>
        <form class="d-flex" action="{{route('announcements.search')}}" method="GET">
          <input class="form-control me-2" name="searched" type="search" placeholder="Search" aria-label="Search">
          <button class="btn btn-outline-success" type="submit">Search</button>
        </form>
      </div>
    </div>
  </nav>