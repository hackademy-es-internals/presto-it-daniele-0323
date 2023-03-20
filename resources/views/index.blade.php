<x-layout>
    <div class="container">
        <div class="row">
            <div class="col-12 text-center">
                <h1>Presto.it</h1>
                <p class="h2 my-2 fw-bold">Ecco i nostri annunci</p>
                <div class="row">
                    @forelse ($announcements as $announcement)
                        <x-announcementCard 
                            title="{{$announcement->title}}" 
                            body="{{$announcement->body}}" 
                            price="{{$announcement->price}}"
                            categoryShow="{{route('categoryShow', $announcement->category)}}"
                            category="{{$announcement->category->name}}"
                            createdAt="{{$announcement->created_at->format('d/m/Y')}}" 
                            details="{{route('announcements.show', $announcement)}}"
                        >
                            <img src="{{!$announcement->images()->get()->isEmpty() ? $announcement->images()->first()->getUrl(400, 250) : 'https://picsum.photos/400/250'}}" alt="..." class="card-img-top p-3 rounded">
                        </x-announcementCard>
                    @empty
                        <div class="col-12">
                            <div class="alert alert-warning py-3 shadow">
                                <p class="lead">Non ci sono annunci per questa ricerca. Prova a cambiare parola chiave</p>
                            </div>
                        </div>
                    @endforelse
                    {{$announcements->links()}}
                </div>
            </div>
        </div>
    </div>
</x-layout>