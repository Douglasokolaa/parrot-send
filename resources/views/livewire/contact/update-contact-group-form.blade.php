<div>
    <form wire:submit.prevent="save">
        <label>
            <input type="text" wire:model="contactGroup.name">
        </label>

        <label>
            <select class="app-solid-select" wire:model="contactGroup.status" name="status" required>
                <option value="">Status</option>
                @foreach($statuses as $status)
                    <option value="{{ $status->value }}">{{ $status->name }}</option>
                @endforeach
            </select>
        </label>

        <button type="submit">Save</button>
    </form>
</div>

