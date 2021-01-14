<?php

namespace App\Http\Livewire\Posts;

use App\Models\Post;
use Livewire\Component;
use Livewire\WithPagination;
use App\Http\Livewire\Traits\WithSorting;
use Illuminate\Support\Str;

class Index extends Component
{
    use WithPagination;
    use WithSorting;

    public ?array $title = [];
    public $search  = '';
    public $perPage = 5;
    protected $paginationTheme = 'bootstrap';
    protected $queryString = [
        'search' => ['except' => '']
    ];

    protected function updatingSearch() {
        $this->resetPage();
    }

    protected function updatingPerPage() {
        $this->resetPage();
    }

    public function mount()
    {
        $this->title = Post::query()->pluck('title', 'id')->toArray();
    }

    public function render()
    {
        return view('livewire.posts.index', [
                'posts' => Post::search($this->search)
                        ->orderBy($this->sortBy, $this->sortDirection)
                        ->paginate($this->perPage == 'All' ? Post::count() : $this->perPage)
            ])
            ->extends('layouts.master')
            ->section('content');
    }

    public function updateTitle(Post $post)
    {
        $isRedirect = true;
        $title = trim(preg_replace('/\s\s+/', ' ', $this->title[$post->id]));

        if ($post->title == $title) {
            $isRedirect = false;

            $this->resetErrorBag();
        } else {
            $check = Post::where('title', 'LIKE', $title)->first();

            if (! empty($check)) {
                $this->title[$post->id] = $post->title;
                $this->addError('title', 'The title has already been taken.');
                $this->dispatchBrowserEvent('hide-flash-session');

                return;
            }

            $post->title = $title;
            $post->slug  = Str::slug($title);
            $post->update();

            if ($isRedirect) return redirect()->to($this->page > 1 ? '/posts?page='. $this->page : '/posts');
        }
    }

    public function delete(Post $post)
    {
        $post->delete();
        session()->flash('message', 'Post successfully deleted.');

        return redirect()->route('posts.index');
    }
}
