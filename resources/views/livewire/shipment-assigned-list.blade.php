<div>
    <p>Clicked times: {{ $clickCount }}</p>
    <button wire:click="increment">Click me</button>
    <button wire:click="decrement">Decrement</button>

    <p>{{$errorMessage}}</p>
    <input type="number" wire:model.live="amount"/>
    <p>Amount: {{ $amount }}</p>
</div>