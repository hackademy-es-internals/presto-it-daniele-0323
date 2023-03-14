<div>
    <h1>Crea il tuo annuncio</h1>
    <form wire:submit.prevent="store">
        @csrf
        
        <div class="mb-3">
            <label for="title">Titolo Annuncio: {{$title}}</label>
            @if (session()->has('message'))
                <div class="flex flex-row justify-center my-2 alert alert-success">
                    {{ session('message') }}
                </div>
            @endif
            <input wire:model.lazy="title" type="text" class="form-control @error('title') is-invalid @enderror" >
            @error('title') 
                {{$message}}
            @enderror
        </div>
        
        <div class="mb-3">
            <label for="body">Descrizione</label>
            <textarea wire:model.lazy="body" type="text" class="form-control @error('body') is-invalid @enderror"></textarea>
            @error('body') 
                {{$message}}
            @enderror
        </div>

        <div class="mb-3">
            <label for="price">Prezzo</label>
            <input wire:model.lazy="price" type="number" class="form-control @error('price') is-invalid @enderror">
            @error('price') 
                <p class="text-danger mt-2">{{$message}}</p>
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
            @error('category') 
                <p class="text-danger mt-2">{{$message}}</p>
            @enderror
        </div>

        <div class="mb-3">
            <input type="file" wire:model="temporary_images" name="images" multiple class="form-control shadow @error('temporary_images.*') is-invalid @enderror" placeholder="img" />
            @error('temporary_images.*') 
                <p class="text-danger mt-2">{{$message}}</p>
            @enderror
        </div>
        @if (!empty($images))
            <div class="row">
                <div class="col-12">
                    <p>Photo preview:</p>
                    <div class="row border border-4 border-info rounded shadow py-4">
                        @foreach ($images as $key => $image)
                            <div class="col my-3">
                                <div class="img-preview mx-auto shadow rounded" style="background-image: url({{$image->temporaryUrl()}});"></div>
                                <button type="button" class="btn btn-danger shadow d-block text-center mt-2 mx-auto" wire:click="removeImage({{$key}})">Cancella</button>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        @endif
        <button type="submit" class="btn btn-primary shadow px-4 py-2">Crea</button>
    </form>
</div>
