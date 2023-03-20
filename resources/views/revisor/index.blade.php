<x-layout>
    <div class="container-fluid p-5 bg-gradient bg-success shadow mb-4">
        <div class="row" style="height: 50px">
            <div class="col-12 text-center text-light ">
                <h1 class="display-2">{{$announcement_to_check ? 'Ecco l\'annuncio da revisionare' : 'Non ci sono annunci da revisionare'}}</h1>
            </div>
        </div>
    </div>
    @if ($announcement_to_check)
    <div class="container">
        <div class="row">
            <div class="col-4">
                <div id="showCarousel" class="carousel slide" data-interval="false">
                    <div class="carousel-inner">
                        @if (!$announcement_to_check->images->isEmpty())
                            @foreach ($announcement_to_check->images as $image)
                                <div class="carousel-item @if($loop->first) active @endif">
                                    <img src="{{$image->getUrl(400, 250)}}" alt="..." class="img-fluid p-3 rounded">
                                </div>
                            @endforeach
                        @else
                            <div class="carousel-item active">
                                <img src="http://picsum.photos/id/27/1200/200" alt="..." class="img-fluid p-3 rounded">
                            </div>
                            <div class="carousel-item">
                                <img src="http://picsum.photos/id/28/1200/200" alt="..." class="img-fluid p-3 rounded">
                            </div>
                            <div class="carousel-item">
                                <img src="http://picsum.photos/id/29/1200/200" alt="..." class="img-fluid p-3 rounded">
                            </div>
                        @endif
                        
                        <button class="carousel-control-prev" type="button" data-bs-target="#showCarousel" data-bs-slide="prev">
                            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                            <span class="visually-hidden">Previous</span>
                        </button>
                        <button class="carousel-control-next" type="button" data-bs-target="#showCarousel" data-bs-slide="next">
                            <span class="carousel-control-next-icon" aria-hidden="true"></span>
                            <span class="visually-hidden">Next</span>
                        </button>
                    </div>
                    <h5 class="card-title">Titolo: {{$announcement_to_check->title}}</h5>
                    <p class="card-text">Descrizione: {{$announcement_to_check->body}}</p>
                    <p class="card-text">Prezzo: {{$announcement_to_check->price}}</p>
                    <p class="card-text">
                        Categoria: {{$announcement_to_check->category->name}}
                    </p>
                    <p class="card-footer">
                        Pubblicato il: {{$announcement_to_check->created_at->format('d/m/Y')}} - Autore: {{$announcement_to_check->user->name ?? ''}}
                    </p>
                </div>
            </div>
            @foreach ($announcement_to_check->images as $image)

                <div id="imgrev_{{$loop->index}}" class="col-4 @if($loop->index>0)d-none @endif">
                    <div class="card-body">
                        <h5 class="tc-accent">Revisione immagine</h5>
                        <p>Adulti: <span class="{{$image->adult}}"></span></p>
                        <p>Satira: <span class="{{$image->spoof}}"></span></p>
                        <p>Medicina: <span class="{{$image->medical}}"></span></p>
                        <p>Violenza: <span class="{{$image->violence}}"></span></p>
                        <p>Contenuto sessuale: <span class="{{$image->racy}}"></span></p>
                        
                    </div>
                </div>
                <div id="imglbl_{{$loop->index}}" class="col-4 @if($loop->index>0)d-none @endif">
                    <div class="card-body">
                        <h5 class="tc-accent">Etichette immagine</h5>
                        <div class="overflow-auto">
                            @foreach ($image->labels as $label)
                                <p>{{$label}}</p>
                            @endforeach
                        </div>
                    </div>
                </div>
            @endforeach
            <div class="row">
                <div class="col-12 col-md-3">
                    <form action="{{route('revisor.accept_announcement', ['announcement'=>$announcement_to_check])}}" method="POST">
                        @csrf
                        @method('PATCH')
                        <button type="submit" class="btn btn-success shadow">Accetta</button>
                    </form>
                </div>
                <div class="col-12 col-md-3">
                    <form action="{{route('revisor.reject_announcement', ['announcement'=>$announcement_to_check])}}" method="POST">
                        @csrf
                        @method('PATCH')
                        <button type="submit" class="btn btn-danger shadow">Rifiuta</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    @endif
    <x-slot:scripts>
        <script type="text/javascript">
            window.imageInfo = function foo(carouselID){
            const myCarousel = document.getElementById(carouselID);
    
            myCarousel.addEventListener('slide.bs.carousel', function(e) {
                    console.log(e.from);
                    console.log(e.to);
                    var revToHide = document.getElementById("imgrev_"+ e.from);
                    var lblToHide = document.getElementById("imglbl_"+ e.from);
                    var revToShow = document.getElementById("imgrev_"+ e.to);
                    var lblToShow = document.getElementById("imglbl_"+ e.to);
                    
                    revToHide.classList.add("d-none");
                    lblToHide.classList.add("d-none");
                    revToShow.classList.remove("d-none");
                    lblToShow.classList.remove("d-none");
    
                })
            }
            window.imageInfo('showCarousel');
        </script>
    </x-slot>
    
</x-layout>