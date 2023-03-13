<x-layout>
    <div class="container">
        <div class="col-12">
            <h1>Login</h1>
            <form action="{{route('login')}}" method="post">
                @csrf
                <div class="mb-3">
                    <label for="email" class="form-label">Indirizzo Email</label>
                    <input name="email" id="email" type="text" class="form-control">
                </div>
                <div class="mb-3">
                    <label for="password" class="form-label">Password</label>
                    <input name="password" id="password" type="password" class="form-control">
                </div>
                <div class="mb-3">
                    <input type="checkbox" name="remember" class="form-check" id="remember">
                    <label for="remember" class="form-label">Ricordati di me</label>
                </div>
                <button type="submit"class="btn btn-primary">Login</button>
            </form>
        </div>
    </div>
</x-layout>