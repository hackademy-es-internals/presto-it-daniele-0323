<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width , initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>{{$title ?? 'Presto.it'}}</title>
        @vite(['resources/css/app.css', 'resources/js/app.js'])
        @livewireStyles
    </head>
    <body>
        <x-nav />
        <div class="min-vh-100">
            <div class="col-12 text-center">
                <p class="h3 my-2 fw-bold bg-danger rounded">{{Session::get('access.denied')}}</p>
                <p class="h3 my-2 fw-bold bg-success rounded">{{Session::get('message')}}</p>
            </div>
            {{$slot}}
        </div>

        <x-footer />
        @livewireScripts
    </body>
</html>