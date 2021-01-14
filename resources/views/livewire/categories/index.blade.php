<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-lg-10">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    List of Categories
                    <button class="btn btn-dark"
                        wire:click="add">
                        Add
                    </button>
                </div>
                <div class="card-body">
                    @if (session()->has('message'))
                        <div class="flash-message alert alert-success alert-dismissible fade show" role="alert">
                            <strong>{{ session('message') }}</strong>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif

                    <div class="mb-3 d-flex justify-content-between">
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

                    <table class="table table-striped table-bordered">
                        <thead class="table-dark">
                            <th class="text-center">#</th>
                            <th class="text-center">Name</th>
                            <th class="text-center">Post Count</th>
                            <th class="text-center">Actions</th>
                        </thead>
                        <tbody>
                            @foreach ($categories as $key => $category)
                                <tr>
                                    <td class="text-center">{{ $categories->firstItem() + $key }}</td>
                                    <td>{{ $category->name }}</td>
                                    <td class="text-center">{{ $category->posts_count }}</td>
                                    <td class="text-center">
                                        <div class="btn-group btn-group-sm">
                                            <button class="btn btn-primary"
                                                wire:click="edit({{ $category->id }}, true)"
                                                >Edit</button>
                                            <button class="btn btn-danger"
                                                onclick="confirm('Are you sure, you want to deleted it?') || event.stopImmediatePropagation()"
                                                wire:click="delete({{ $category->id }})">Delete</button>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>

                    {{ $categories->links() }}
                </div>
            </div>
        </div>
    </div>

    <livewire:categories.form />
</div>

@push('js')
    <script>
        $(document).ready(function () {
            $('#modal-form').on('shown.bs.modal', function () {
                $('#name').focus();
            });
        });

        window.livewire.on('show-modal', () => {
            $('#modal-form').modal('show');
        });

        window.livewire.on('hide-modal', () => {
            $('#modal-form').modal('hide');
        });
    </script>
@endpush