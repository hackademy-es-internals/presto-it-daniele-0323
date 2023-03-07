<nav class="navbar navbar-expand-lg bg-body-tertiary bg-primary">
    <div class="container-fluid">
      <a class="navbar-brand" href="#">Navbar</a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav me-auto mb-2 mb-lg-0">
          <li class="nav-item">
            <a class="nav-link active" aria-current="page" href="/">Home</a>
          </li>
          
              @guest
                <li class="nav-item"><a href="{{route('login')}}" class="nav-link">Login</a></li>
                <li class="nav-item"><a href="{{route('register')}}" class="nav-link">Registrati</a></li>
              @else
                <li class="nav-item dropdown">
                  <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">{{Auth::user()->name}}</a>
                  <ul class="dropdown-menu">
                  <li><a class="dropdown-item" href="{{route('announcements.create')}}">Crea il tuo annuncio</a></li>
                  <li><a class="dropdown-item" href="#">Another action</a></li>
                  <li><hr class="dropdown-divider"></li>
                  <li><a class="dropdown-item" href="#">Something else here</a></li>
                  <li><a href="/logout" class="dropdown-item" onclick="event.preventDefault();getElementById('form-logout').submit();">Logout</a></li>
                  </ul>
                  <form id="form-logout" action="{{route('logout')}}" method="POST" class="d-none">
                  @csrf
                  </form>
                </li>
              @endguest
        </ul>
        <form class="d-flex" role="search">
          <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
          <button class="btn btn-outline-success" type="submit">Search</button>
        </form>
      </div>
    </div>
  </nav>