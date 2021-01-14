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
                            <div wire:ignore>
                                <label for="selectedCategories">Categories</label>
                                <select class="form-select w-100 select2 @error('selectedCategories') is-invalid @enderror"
                                    multiple="multiple"
                                    wire:model="selectedCategories">
                                    <option></option>
                                    @foreach ($categories as $key => $category)
                                        <option value="{{ $key }}">{{ $category }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        @error('test')
                            <span class="invalid-feedback">{{ $message }}</span>
                        @enderror

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
        $('.select2').select2({
            placeholder: 'Select a Category',
            // theme: 'bootstrap4'
        });

        $(document).on('change', '.select2', function (e) {
            // @this.selectedCategories = $(this).val();
        });
    });

    // document.addEventListener("DOMContentLoaded", function () {
    //     Livewire.hook('element.updated', (el, component) => {
    //         console.log(component)
    //         $('.select2').select2({
    //             placeholder: 'Select a Category',
    //         });
    //     });
    // });
    // function select2() {
    //     this.select2 = $(this.$refs.select).select2({
    //         theme: "bootstrap4"
    //     });
    //     this.select2.on("select2:select", (event) => {
    //         this.selectedCategories = event.target.value;
    //     });
    //     this.$watch("selectedCategories", (value) => {
    //         this.select2.val(value).trigger("change");
    //         // this.$wire.set('selectedCategories', value);
    //     });
    // }
</script>
@endpush