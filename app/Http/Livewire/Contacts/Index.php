<?php

namespace App\Http\Livewire\Contacts;

use App\Models\Contact;
use Livewire\Component;
use Livewire\WithPagination;

class Index extends Component
{
    use WithPagination;

    public $isUpdate = false;
    public $perPage  = 10;
    public $search   = '';
    protected $paginationTheme = 'bootstrap';

    protected $listeners = [
        'submitted',
        'changeIsUpdate',
    ];

    protected $queryString = [
        'search' => ['except' => '']
    ];

    public function updatingSearch()
    {
        $this->resetPage();
        $this->emit('clearError');
    }

    public function gotoPage($page)
    {
        $this->page = $page;

        $this->emit('clearError');
        $this->isUpdate = false;
    }

    public function updatingPerPage()
    {
        $this->resetPage();
        $this->emit('clearError');
    }

    public function render()
    {
        return view('livewire.contacts.index', [
                'contacts' => Contact::search($this->search)
                    ->latest()
                    ->paginate($this->perPage == 'All' ? Contact::count() : $this->perPage)
            ])
            ->extends('layouts.master')
            ->section('content');
    }

    public function submitted($message)
    {
        session()->flash('message', $message);
        $this->dispatchBrowserEvent('hide-flash-session');
    }

    public function edit(Contact $contact)
    {
        $this->isUpdate = true;
        $this->emit('edit', $contact);
    }

    public function changeIsUpdate($status)
    {
        $this->isUpdate = $status;
    }

    public function delete(Contact $contact)
    {
        $this->isUpdate = false;
        $this->emit('clearError');

        if ($contact) {
            $contact->delete();
            
            session()->flash('message', 'Data selected successfully deleted.');
            $this->dispatchBrowserEvent('hide-flash-session');
        }
    }
}
