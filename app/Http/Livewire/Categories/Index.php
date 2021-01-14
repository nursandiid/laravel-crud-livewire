<?php

namespace App\Http\Livewire\Categories;

use App\Models\Category;
use Livewire\Component;
use Livewire\WithPagination;

class Index extends Component
{
    use WithPagination;

    public $search = '';
    public $perPage = 10;

    protected $paginationTheme = 'bootstrap';
    protected $queryString = [
        'search' => ['except' => '']
    ];

    protected function updatingSearch()
    {
        $this->resetPage();
    }

    protected function updatingPerPage()
    {
        $this->resetPage();
    }

    public function render()
    {
        return view('livewire.categories.index', [
                'categories' => Category::search($this->search)
                            ->withCount('posts')
                            ->latest()
                            ->paginate($this->perPage == 'All' ? Category::count() : $this->perPage)    
            ])
            ->extends('layouts.master')
            ->section('content');
    }

    public function add()
    {
        $this->emit('add');
    }

    public function edit($id)
    {
        $this->emit('edit', $id);
    }

    public function delete(Category $category)
    {
        if (! $category) {
            $this->addError('message', 'Page Not Found.');
        }

        $category->delete();
        session()->flash('message', 'Category selected successfully deleted.');
        
        return redirect()->route('categories.index');
    }
}
