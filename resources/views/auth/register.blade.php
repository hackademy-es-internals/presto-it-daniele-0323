<x-layout>
    <div class="container">
        <div class="row">
            <h1>Benvenuto nella Registrazione</h1>
        </div>
        <div class="row">
            <div class="col-12">
                <form action="{{route('register')}}" method="post">
                @csrf
                <div class="mb-3">
                    <label for="name" class="form-label">Nome e Cognome</label>
                    <input name="name" id="name" type="text" class="form-control" aria-describedby="name">
                </div>
                <div class="mb-3">
                    <label for="email" class="form-label">Indirizzo Email</label>
                    <input name="email" id="email" type="text" class="form-control" aria-describedby="emailHelp">
                    <div id="emailHelp" class="form-text">La tua mail non sarà condivisa con nessuno</div>
                </div>
                <div class="mb-3">
                    <label for="password" class="form-label">Password</label>
                    <input name="password" id="password" type="password" class="form-control">
                </div>
                <div class="mb-3">
                    <label for="password_confirmation" class="form-label">Conferma Password</label>
                    <input name="password_confirmation" id="password_confirmation" type="password" class="form-control">
                </div>
                <button type="submit" class="btn btn-primary">Registrati</button>
                </form>
            </div>
        </div>
    </div>
</x-layout>