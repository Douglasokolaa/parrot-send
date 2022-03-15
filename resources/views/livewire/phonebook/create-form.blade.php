<div>
    <form wire:submit.prevent="create">
        <input type="text" wire:model="name">
        @error('name') <span class="error">{{ $message }}</span> @enderror

        <button type="submit">Create Phonebook</button>
    </form>
</div>
