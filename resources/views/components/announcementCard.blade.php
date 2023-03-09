<div class="col-12 col-md-4 my-4">
    <div class="card shadow" style="width: 18rem;">
        <img src="https://picsum.photos/200" alt="..." class="card-img-top p-3 rounded">
        <div class="card-body">
            <h5 class="card-title">{{$title}}</h5>
            <p class="card-text">{{$body}}</p>
            <p class="card-text">{{$price}}</p>
            <a href="{{$details}}" class="btn btn-primary shadow">Visualizza</a>
            @if (isset($category))
                <a href="{{$categoryShow}}" class="btn btn-success my-2 border-top pt-2 border-dark card-link shadow">
                    Categoria: {{$category}}
                </a>
            @endif
            
            <p class="card-footer">
                Pubblicato il: {{$createdAt}} 
                @if (isset($author))
                    - Autore: {{$author}}
                @endif
            </p>
        </div>
    </div>
</div>