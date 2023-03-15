<x-layout>
    <div class="container-fluid p-5 bg-gradient bg-success shadow mb-4">
        <div class="row">
            <div class="col-12 text-light p-5">
                <h1 class="display-2">Esplora la categoria {{$category->name}}</h1>
            </div>
        </div>
    </div>

    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="row">
                    @forelse ($category->announcements as $announcement)
                    <x-announcementCard 
                        title="{{$announcement->title}}" 
                        body="{{$announcement->body}}" 
                        price="{{$announcement->price}}" 
                        createdAt="{{$announcement->created_at->format('d/m/Y')}}" 
                        author="{{$announcement->user->name}}"
                        details="{{route('announcements.show', $announcement)}}"
                    >
                        <img src="{{!$announcement->images()->get()->isEmpty() ? Storage::url($announcement->images()->first()->path) : 'https://picsum.photos/200'}}" alt="..." class="card-img-top p-3 rounded">
                    </x-announcementCard>
                    @empty
                        <div class="col-12">
                            <p class="h1">Non sono presenti annunci in questa categoria</p>
                            <p class="h2">Pubblicane uno: <a href="{{route('announcements.create')}}" class="btn btn-success shadow">pubblica annuncio</a></p>
                        </div>
                    @endforelse
                </div>
            </div>
        </div>
    </div>
</x-layout>