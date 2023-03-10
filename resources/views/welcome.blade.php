<x-layout>
    <div class="container">
        <div class="row">
            <div class="col-12 text-center">
                <h1>Presto.it</h1>
                <p class="h2 my-2 fw-bold">Ecco i nostri annunci</p>
                

                <div class="row">
                    @foreach ($announcements as $announcement)
                    <x-announcementCard 
                        title="{{$announcement->title}}" 
                        body="{{$announcement->body}}" 
                        price="{{$announcement->price}}"
                        categoryShow="{{route('categoryShow', $announcement->category)}}"
                        category="{{$announcement->category->name}}"
                        createdAt="{{$announcement->created_at->format('d/m/Y')}}" 
                        details="{{route('announcements.show', $announcement)}}"
                    />
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</x-layout>