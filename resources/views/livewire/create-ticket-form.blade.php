<form wire:submit="save" class="flex flex-col gap-6">

    <flux:input wire:model="title" label="Subject" placeholder="Brief summary of the issue"/>

    <flux:select wire:model="priority" label="Priority">
        <flux:select.option value="low">Low</flux:select.option>
        <flux:select.option value="medium">Medium</flux:select.option>
        <flux:select.option value="high">High</flux:select.option>
    </flux:select>

    <flux:textarea wire:model="description" label="Description" rows="4" placeholder="Describe your issue..."/>

    <flux:input type="file" wire:model="attachments" multiple label="Attachment (Optional)"/>

    <div class="flex justify-end">
        <flux:button variant="primary" type="submit">Submit Ticket</flux:button>
    </div>
</form>
