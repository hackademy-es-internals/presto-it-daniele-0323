<x-layout>
    <div class="container-fluid p-5 bg-gradient bg-success shadow mb-4">
        <div class="row">
            <div class="col-12 text-light p-5">
                <h1 class="display-2">Esplora la categoria {{$announcement->category->name}}</h1>
            </div>
        </div>
    </div>
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div id="showCarousel" class="carousel slide" data-bs-ride="carousel">
                    <div class="carousel-inner">
                        <div class="carousel-item active">
                            <img src="http://picsum.photos/id/27/1200/200" alt="..." class="img-fluid p-3 rounded">
                        </div>
                        <div class="carousel-item active">
                            <img src="http://picsum.photos/id/28/1200/200" alt="..." class="img-fluid p-3 rounded">
                        </div>
                        <div class="carousel-item active">
                            <img src="http://picsum.photos/id/29/1200/200" alt="..." class="img-fluid p-3 rounded">
                        </div>
                        <button class="carousel-control-prev" type="button" data-bs-target="#showCarousel" data-bs-slide="prev">
                            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                            <span class="visually-hidden">Previous</span>
                        </button>
                        <button class="carousel-control-next" type="button" data-bs-target="#showCarousel" data-bs-slide="next">
                            <span class="carousel-control-next-icon" aria-hidden="true"></span>
                            <span class="visually-hidden">Next</span>
                        </button>
                    </div>
                    <h5 class="card-title">Titolo: {{$announcement->title}}</h5>
                    <p class="card-text">Descrizione: {{$announcement->body}}</p>
                    <p class="card-text">Prezzo: {{$announcement->price}}</p>
                    <a href="{{route('categoryShow', $announcement->category)}}" class="btn btn-success my-2 border-top pt-2 border-dark card-link shadow">
                        Categoria: {{$announcement->category->name}}
                    </a>
                    <p class="card-footer">
                        Pubblicato il: {{$announcement->created_at->format('d/m/Y')}} - Autore: {{$announcement->user->name ?? ''}}
                    </p>
                </div>
            </div>
        </div>
    </div>
</x-layout>