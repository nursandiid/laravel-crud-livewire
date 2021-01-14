<?php

namespace App\Http\Livewire\Contacts;

use App\Models\Contact;
use Livewire\Component;

class Create extends Component
{
    public $name;
    public $phone;

    protected $rules = [
        'name'  => 'required|min:4',
        'phone' => 'required|string|max:15'
    ];

    protected $listeners = [
        'clearError'
    ];

    public function render()
    {
        return view('livewire.contacts.create');
    }

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }

    public function onSubmit()
    {
        $validateData = $this->validate();
        
        Contact::create($validateData);
        
        $this->reset('name', 'phone');
        $this->emit('submitted', 'Contact successfully saved.');
    }

    public function clearError()
    {
        return $this->resetErrorBag();
    }
}
