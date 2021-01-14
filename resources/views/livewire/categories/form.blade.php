<div class="modal fade" 
    id="modal-form" 
    data-bs-backdrop="static"
    data-bs-keyboard="false"
    aria-labelledby="modal-formLabel" 
    aria-hidden="true"
    wire:ignore.self>
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modal-formLabel">{{ $modalTitle }}</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form wire:submit.prevent="onSubmit">
                    <div class="mb-3">
                        <label for="name">Name</label>
                        <input type="text" 
                            id="name"
                            class="form-control @error('category.name') is-invalid @enderror"
                            wire:model="category.name">

                        @error('category.name')
                            <span class="invalid-feedback">{{ $message }}</span>
                        @enderror
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" wire:click.prevent="onSubmit">Save changes</button>
            </div>
        </div>
    </div>
</div>