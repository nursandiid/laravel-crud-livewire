<?php

namespace App\Http\Livewire\Posts;

use App\Models\Category;
use App\Models\Post;
use Livewire\Component;
use Livewire\WithFileUploads;
use Illuminate\Support\Str;

class Create extends Component
{
    use WithFileUploads;
    
    public Post $post;

    public $image;
    public $selectedCategories = [];

    protected $rules = [
        'post.title' => 'required|unique:posts,title',
        'post.body' => 'required|min:10',
        'image' => 'required|mimes:jpeg,jpg,png|max:2048',
        'post.status' => 'nullable',
        'selectedCategories' => 'required'
    ];

    protected $validationAttributes = [
        'post.title' => 'title',
        'post.body' => 'body',
    ];

    public function mount()
    {
        $this->post = new Post();
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

    public function onSubmit()
    {
        $this->validate();

        $post = $this->post;
        $slug = Str::slug($post->title);
        $filename = $this->image->storeAs('/uploads/posts', "{$slug}.{$this->image->extension()}", 'public');
        $filename = '/'. $filename;

        $post->slug = $slug;
        $post->image = $filename;
        $post->status = $post->status ?? 0;
        $post->is_approved = 1;
        $post->save();

        $post->categories()->attach($this->selectedCategories);

        session()->flash('message', 'Post successfully saved.');
        return redirect()->route('posts.index');
    }
}
