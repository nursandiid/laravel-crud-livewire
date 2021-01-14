<?php

namespace App\Http\Livewire\Posts;

use App\Models\Category;
use Livewire\Component;
use App\Models\Post;
use Livewire\WithFileUploads;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class Edit extends Component
{
    use WithFileUploads;

    public Post $post;

    public $image;
    public $selectedCategories = [];
    public $isUpdate = true;

    protected $rules = [
        'post.title' => 'required',
        'post.body' => 'required|min:10',
        'post.status' => 'nullable',
        'selectedCategories' => 'required'
    ];

    protected $validationAttributes = [
        'post.title' => 'title',
        'post.body' => 'body',
    ];

    public function mount(Post $post)
    {
        $this->image = $post->image;
        $this->selectedCategories = $post->categories->pluck('id');
    }

    public function render()
    {
        return view('livewire.posts.form', [
                'categories' => Category::query()->pluck('name', 'id')->toArray()    
            ])
            ->extends('layouts.master')
            ->section('content');
    }

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }

    public function updatedImage()
    {
        $this->validate(['image' => 'required|mimes:png,jpg,jpeg|max:2048']);
    }

    public function onSubmit()
    {
        $this->validate();

        $post     = $this->post;
        $slug     = Str::slug($post->title);
        $filename = $post->image;

        if ($this->image == $post->image) {
            $filename = $post->image;
        } else {
            $this->rules['image'] = 'required|mimes:png,jpg,jpeg|max:2048';
            $this->validate();

            Storage::disk('public')->delete($post->image);

            $filename = $this->image->storeAs('/uploads/posts', "{$slug}.{$this->image->extension()}", 'public');
            $filename = '/'. $filename;
        }

        $post->slug = $slug;
        $post->image = $filename;
        $post->status = $post->status ?? false;
        $post->save();

        $post->categories()->sync($this->selectedCategories);

        $this->selectedCategories = [];

        session()->flash('message', 'Post successfully update.');
        return redirect()->route('posts.index');
    }
}
