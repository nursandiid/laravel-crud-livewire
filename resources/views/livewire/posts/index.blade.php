<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-lg-10">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    Data Posts
                    <a href="{{ route('posts.create') }}" class="btn btn-dark">Add</a>
                </div>
                <div class="card-body">
                    @if (session()->has('message'))
                        <div class="flash-message alert alert-success alert-dismissible fade show" role="alert">
                            <strong>{{ session('message') }}</strong>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif

                    @error('title')
                        <div class="flash-message alert alert-danger alert-dismissible fade show" role="alert">
                            <strong>{{ $message }}</strong>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @enderror

                    <div class="mb-3 d-flex justify-content-between">
                        <select class="form-select w-auto select2"
                            wire:ignore
                            wire:model="perPage" id="perPage">
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

                    <div class="table-responsive">
                        <table class="table table-bordered table-striped">
                            <thead class="table-dark">
                                <th class="text-center cursor-pointer"
                                    wire:click="sortBy('id')">
                                    #
                                    <x-sort-icon :sortBy="$sortBy" :sortDirection="$sortDirection" :field="'id'" />
                                </th>
                                <th class="text-center">
                                    Image
                                </th>
                                <th class="text-center cursor-pointer"
                                    wire:click="sortBy('title')">
                                    Title
                                    <x-sort-icon :sortBy="$sortBy" :sortDirection="$sortDirection" :field="'title'" />
                                </th>
                                <th class="text-center cursor-pointer"
                                    wire:click="sortBy('slug')">
                                    Slug
                                    <x-sort-icon :sortBy="$sortBy" :sortDirection="$sortDirection" :field="'slug'" />
                                </th>
                                <th class="text-center cursor-pointer"
                                    wire:click="sortBy('body')">
                                    Body
                                    <x-sort-icon :sortBy="$sortBy" :sortDirection="$sortDirection" :field="'body'" />
                                </th>
                                <th class="text-center cursor-pointer"
                                    wire:click="sortBy('status')">
                                    Status
                                    <x-sort-icon :sortBy="$sortBy" :sortDirection="$sortDirection" :field="'status'" />
                                </th>
                                <th class="text-center cursor-pointer"
                                    wire:click="sortBy('is_approved')">
                                    Is Approved
                                    <x-sort-icon :sortBy="$sortBy" :sortDirection="$sortDirection" :field="'is_approved'" />
                                </th>
                                <th class="text-center">Actions</th>
                            </thead>
                            
                            <tbody>
                                @foreach ($posts as $key => $post)
                                    <tr>
                                        <td>{{ $posts->firstItem() + $key }}</td>
                                        <td class="text-center">
                                            <img src="{{ $post->image }}" class="rounded border border-dark"
                                                style="width: 100px;">
                                        </td>
                                        <td class="p-0 position-relative w-25">
                                            <textarea
                                                class="inline-editable"
                                                id="textarea-{{ $post->id }}"
                                                wire:model="title.{{ $post->id }}"
                                                wire:focusout="updateTitle({{ $post->id }})"></textarea>
                                        </td>
                                        <td><a href="{{ url($post->slug) }}">{{ Str::limit(url($post->slug), 50, '...') }}</a></td>
                                        <td>{{ Str::limit($post->body, 50, '...') }}</td>
                                        <td>
                                            @if ((bool) $post->status)
                                                <span class="badge bg-success">Published</span>
                                            @else
                                                <span class="badge bg-danger">Pending</span>
                                            @endif
                                        </td>
                                        <td>
                                            @if ((bool) $post->is_approved)
                                                <span class="badge bg-success">Approved</span>
                                            @else
                                                <span class="badge bg-danger">Pending</span>
                                            @endif
                                        </td>
                                        <td class="text-center">
                                            <div class="btn-group btn-group-sm">
                                                <a href="{{ route('posts.edit', $post->id) }}" class="btn btn-primary">Edit</a>
                                                <button class="btn btn-danger"
                                                    onclick="confirm('Are you sure, you want to deleted it?') || event.stopImmediatePropagation()"
                                                    wire:click="delete({{ $post->id }})">Delete</button>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                    <div class="d-flex justify-content-between">
                        <p>Showing {{ $posts->firstItem() }} to {{ $posts->lastItem() }} of {{ $posts->total() }} entries</p>
                        {{ $posts->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>