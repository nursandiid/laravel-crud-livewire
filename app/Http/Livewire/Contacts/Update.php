<?php

namespace App\Http\Livewire\Contacts;

use App\Models\Contact;
use Livewire\Component;

class Update extends Component
{
    public $contactId;
    public $name;
    public $phone;

    protected $listeners = [
        'edit',
        'clearError'
    ];

    protected $rules = [
        'name' => 'required|min:4',
        'phone' => 'required|string|max:15'
    ];

    public function render()
    {
        return view('livewire.contacts.update');
    }

    public function edit($contact)
    {
        $this->contactId = $contact['id'];
        $this->name      = $contact['name'];
        $this->phone     = $contact['phone'];
    }

    public function resetForm()
    {
        $this->reset();
        $this->emit('changeIsUpdate', false);
    }

    public function onSubmit()
    {
        $this->validate();

        $contact = Contact::find($this->contactId);
        if ($contact) {
            $contact->update([
                'name' => $this->name,
                'phone' => $this->phone
            ]);
        }
        
        $this->reset();
        $this->emit('submitted', 'Contact successfully updated.');
    }

    public function clearError()
    {
        return $this->resetErrorBag();
    }
}
