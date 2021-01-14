<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-lg-10">
            <div class="card">
                <div class="card-header">Data Contacts
                </div>
                <div class="card-body">

                    @if (session()->has('message'))
                        <div class="flash-message alert alert-success alert-dismissible fade show">
                            <strong>{{ session('message') }}</strong>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif
                    
                    @if ($isUpdate) <livewire:contacts.update />
                    @else <livewire:contacts.create />
                    @endif

                    <hr>
                    
                    <div class="form-group d-flex justify-content-between">
                        <select class="form-select w-auto"
                            wire:model="perPage">
                            <option value="5">5</option>
                            <option value="10">10</option>
                            <option value="25">25</option>
                            <option value="50">50</option>
                            <option value="100">100</option>
                            <option value="All">All</option>
                        </select>
                    
                        <input type="search" class="form-control w-auto"
                            placeholder="Search.."
                            wire:model="search">
                    </div>
                    <table class="table table-bordered table-striped table-sm mt-3">
                        <thead class="table-dark">
                            <th scope="col" class="text-center">#</th>
                            <th scope="col" class="text-center">Name</th>
                            <th scope="col" class="text-center">Phone</th>
                            <th scope="col" class="text-center">Actions</th>
                        </thead>
                        <tbody>
                            @forelse ($contacts as $key => $contact)
                                <tr>
                                    <td class="text-center">{{ $contacts->firstItem() + $key }}</td>
                                    <td>{{ $contact->name }}</td>
                                    <td>{{ $contact->phone }}</td>
                                    <td class="text-center">
                                        <div class="btn-group">
                                            <button 
                                                class="btn btn-primary btn-sm"
                                                wire:click="edit('{{ $contact->id }}')">
                                                Edit
                                            </button>
                                            <button 
                                                class="btn btn-danger btn-sm"
                                                onclick="confirm('Are you sure, want to delete selected data.') || event.stopImmediatePropagation()"
                                                wire:click="delete('{{ $contact->id }}')">
                                                Delete
                                            </button>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="4" class="text-center">There is no data in the table</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>

                    {{ $contacts->links() }}
                    <p class="text-muted text-sm">Showing {{ $contacts->firstItem() }} to {{ $contacts->lastItem() }} of {{ $contacts->total() }} entries</p>
                </div>
            </div>
        </div>
    </div>
</div>