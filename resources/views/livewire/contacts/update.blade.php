<div>
    <form class="row"
        wire:submit.prevent="onSubmit"
        >
        <input type="hidden"
            wire:model="contactId">

        <div class="col-lg-6">
            <label for="name">Name</label>
            <input type="text"
                class="form-control @error('name') is-invalid @enderror" 
                id="name"
                wire:model="name"
                >

            @error('name')
                <span class="invalid-feedback">{{ $message }}</span>
            @enderror
        </div>
    
        <div class="col-lg-6">
            <label for="phone">Phone</label>
            <input type="text"
                class="form-control @error('phone') is-invalid @enderror" 
                id="phone"
                wire:model="phone"
                >

            @error('phone')
                <span class="invalid-feedback">{{ $message }}</span>
            @enderror
        </div>
    
        <div class="col">
            <button class="btn btn-success mt-3">Saved</button>
            <button type="reset" wire:click="resetForm" class="btn btn-secondary mt-3 ml-2">Reset</button>
        </div>
    </form>
</div>
