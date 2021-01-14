<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-lg-10">
            <div class="card">
                <div class="card-header">Add Post
                </div>
                <div class="card-body">
                    <form wire:submit.prevent="onSubmit">
                        <div class="mb-3">
                            <label for="title">Title</label>
                            <input type="text"
                                class="form-control w-auto @error('post.title') is-invalid @enderror"
                                id="title"
                                wire:model="post.title">

                            @error('post.title')
                                <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="selectedCategories">Categories</label>
                            <div class="chosen @error('selectedCategories') is-invalid @enderror">
                                <div wire:ignore>
                                    <x-chosen-select
                                        :class="'w-50'"
                                        :multiple="'multiple'"
                                        :model="'selectedCategories'"
                                        :placeholder="'Select a Category'">
                                        @foreach ($categories as $key => $category)
                                            <option value="{{ $key }}"
                                                @foreach($post->categories as $postCategory)
                                                    {{ $postCategory->id == $key ? 'selected' : '' }}
                                                @endforeach
                                            >{{ $category }}</option>
                                        @endforeach
                                    </x-chosen-select>
                                </div>
                            </div>

                            @error('selectedCategories')
                                <span class="invalid-feedback">{{ $message }}</span>
                            @enderror

                        </div>

                        <div class="mb-3">
                            <label for="body">Body</label>
                            <textarea class="form-control w-50 @error('post.body') is-invalid @enderror" 
                                rows="5"
                                id="body"
                                wire:model="post.body"></textarea>

                            @error('post.body')
                                <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="image">Image</label>
                            <input type="file" 
                                class="form-control w-auto @error('image') is-invalid @enderror" 
                                id="image"
                                wire:model="image">

                            @error('image')
                                <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                            
                            @if ((! isset($isUpdate) && $image) || (isset($isUpdate) && \Str::contains($image, '/tmp/')))
                                <img src="{{ ! is_string($image) ? $image->temporaryUrl() : '-' }}" 
                                    class="rounded border mt-4"
                                    width="200">
                            @elseif($image)
                                <img src="{{ $image }}" 
                                    class="rounded border mt-4"
                                    width="200">
                            @endif
                        </div>

                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="checkbox" 
                                value="1" 
                                id="status"
                                wire:model="post.status">
                            <label class="form-check-label" for="status">
                                Publish
                            </label>
                        </div>
                        <div class="mt-3">
                            <button class="btn btn-primary">Save</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@push('js')
<script>
    $(document).ready(function () {
        $('.chosen-select').chosen();
        $('.chosen-select').trigger("chosen:updated");
    });
    
    function changeChosen(event, property) {
        $('[name=selectedCategories]').val($(event.target).val());
        @this.set(property, $(event.target).val());
    }
</script>
@endpush