<div>
    <form wire:submit.prevent="saveUpdate">
        <input type="text" wire:model="contact.first_name">
        <input type="text" wire:model="contact.last_name">
        <input type="text" wire:model="contact.phone">
        <input type="text" wire:model="contact.phone_country">
        <button type="submit">Save</button>
    </form>
</div>

