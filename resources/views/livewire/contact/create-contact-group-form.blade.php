<div>
    <form wire:submit.prevent="createGroup">
        <input type="text" wire:model="name">
        @error('name') <span class="error">{{ $message }}</span> @enderror

        <button type="submit">Create Group</button>
    </form>
</div>
