<?php

namespace App\Http\Livewire\Categories;

use App\Models\Category;
use Livewire\Component;

class Form extends Component
{
    public Category $category;

    public $updateMode = false;
    public $modalTitle;

    protected $listeners = [
        'add',
        'edit'
    ];

    protected $rules = [
        'category.name' => 'required|unique:categories,name'
    ];

    protected $validationAttributes = [
        'category.name' => 'name'
    ];

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }

    public function mount()
    {
        // $this->category = $this->updateMode ?: new Category();
    }

    public function render()
    {
        return view('livewire.categories.form');
    }

    public function add()
    {
        $this->modalTitle = 'Add Category';
        $this->updateMode = false;
        $this->category   = new Category();

        $this->resetErrorBag('category.name');
        $this->emit('show-modal');
    }

    public function edit(Category $category)
    {
        $this->modalTitle = 'Edit Category';
        $this->updateMode = true;
        $this->category   = $category;

        $this->resetErrorBag('category.name');
        $this->emit('show-modal');
    }

    public function onSubmit()
    {
        if ($this->updateMode) {
            $this->rules['category.name'] = 'required';
        }
        $this->validate();

        $this->category->save();
        
        $this->emit('hide-modal');
        session()->flash('message', $this->updateMode ? 'Category successfully updated' : 'Category successfully saved');

        return redirect()->route('categories.index');
    }
}
