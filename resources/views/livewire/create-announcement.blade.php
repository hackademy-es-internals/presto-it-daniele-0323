<div>
    <h1>Crea il tuo annuncio</h1>
    <form wire:submit.prevent="store">
        @csrf
        
        <div class="mb-3">
            <label for="title">Titolo Annuncio</label>
            @if (session()->has('message'))
                <div class="flex flex-row justify-center my-2 alert alert-success">
                    {{ session('message') }}
                </div>
            @endif
            <input wire:model="title" type="text" class="form-control @error('title') is-invalid @enderror">
            @error('title') 
                {{$message}}
            @enderror
        </div>
        
        <div class="mb-3">
            <label for="body">Descrizione</label>
            <textarea wire:model="body" type="text" class="form-control @error('body') is-invalid @enderror"></textarea>
            @error('body') 
                {{$message}}
            @enderror
        </div>

        <div class="mb-3">
            <label for="price">Prezzo</label>
            <input wire:model="price" type="number" class="form-control @error('price') is-invalid @enderror">
            @error('price') 
                {{$message}}
            @enderror
        </div>

        <div class="mb-3">
            <label for="category">Categoria</label>
            <select wire:model.defer="category" id="category" class="form-control">
                <option value="">Scegli la categoria</option>
                @foreach ($categories as $category)
                    <option value="{{$category->id}}">{{$category->name}}</option>
                @endforeach
            </select>
        </div>

        <button type="submit" class="btn btn-primary shadow px-4 py-2">Crea</button>
    </form>
</div>
