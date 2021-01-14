<?php

namespace App\Http\Livewire;

use App\Models\Post;
use Livewire\Component;
use Illuminate\Support\Str;

class ExternalLibrary extends Component
{
    public $search = '';
    public $searchbox = [];

    public function render()
    {
        return view('livewire.external-library');
    }

    public function updatingSearch($value)
    {
        if ($value !== '') {
            $results = $this->searchbox = Post::search($value)
                ->get()
                ->pluck('title');

            if (count($results) == 0) {
                $this->searchbox = ['No results match '. $value];
            }
        } else {
            $this->reset('searchbox');
        }
    }
}
