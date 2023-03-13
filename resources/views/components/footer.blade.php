<div class="container-fluid mt-4 p-5 bg-dark text-light">
    <div class="row">
        <div class="col-12 text-center">
            @if (isset(Auth::user()->is_revisor) && Auth::user()->is_revisor)
                @if (Auth::user()->last_reviewed_announcement != null)
                    <p>Presto.it</p>
                    <p>Hai fatto una cagata e vuoi tornare indietro?</p>
                    <p>Non ti preoccupare clicca qui ed annulla la tua ultima revisione</p>
                    
                    <a href="{{route('revisor.undo_review', ['announcement'=>Auth::user()->last_reviewed_announcement])}}" class="btn btn-warning text-light shadow my-3">Annulla errori</a>
                @endif
            @else
                <p>Presto.it</p>
                <p>Vuoi lavorare con noi?</p>
                <p>Registrati e clicca qui</p>
                
                <a href="{{route('become.revisor')}}" class="btn btn-warning text-light shadow my-3">Diventa revisore</a>
            @endif
                
        </div>
    </div>
</div>