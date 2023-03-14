<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Category;
use App\Models\Announcement;
use Illuminate\Support\Facades\Auth;
use Livewire\WithFileUploads;

class CreateAnnouncement extends Component
{
    use WithFileUploads;

    public $title;
    public $body;
    public $price;
    public $temporary_images;
    public $images = [];
    public $category;

    protected $rules = [
        'title' => 'required|min:4',
        'body' => 'required|min:8',
        'category' => 'required',
        'price' => 'required|numeric',
        'images.*' =>'image|max:1024',
        'temporary_images.*' =>'image|max:1024',
    ];

    protected $messages = [
        'required' => 'Il campo :attribute è richiesto',
        'min' => 'Il campo :attribute è troppo corto',
        'images.image' =>'L\'immagine deve essere un\'immagine',
        'images.max' =>'L\'immagine deve essere massimo 1MB',
        'temporary_images.required' =>'L\'immagine è richiesta',
        'temporary_images.*.image' =>'I file devono essere un\'immagine',
        'temporary_images.*.max' =>'L\'immagine deve essere massimo 1MB',
    ];

    public function updatedTemporaryImages(){
        if($this->validate([
            'temporary_images.*' => 'image|max:1024',
        ])){
            foreach($this->temporary_images as $image){
                $this->images[] = $image;
            }
        }
    }

    public function removeImage($key){
        if(in_array($key, array_keys($this->images))){
            unset($this->images[$key]);
        }
    }

    public function store(){
        $this->validate();
        $category = Category::find($this->category);
        $announcement = $category->announcements()->create([
            'title' => $this->title,
            'body' => $this->body,
            'price' => $this->price
        ]);
        foreach($this->images as $image){
            $announcement->images()->create(['path' => $image->store('images', 'public')]);
        }
        Auth::user()->announcements()->save($announcement);

        session()->flash('message', 'Annuncio inserito con successo');
        $this->cleanForm();
    }

    public function cleanForm(){
        $this->title = '';
        $this->body = '';
        $this->price = '';
        $this->category = '';
        $this->temporary_images = [];
        $this->images = [];
    }

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }

    public function render()
    {
        return view('livewire.create-announcement');
    }
}

?>
