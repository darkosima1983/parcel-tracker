<div>
    <p>Clicked times: <span class="{{ $clickCount > 5000 ? 'red' : '' }}">{{ $clickCount }}</span></p>
    <button wire:click="increment">Click me</button>
    <button wire:click="decrement">Decrement</button>

    <p>{{$errorMessage}}</p>
    <input type="number"wire:blur="validateAmount" wire:model.live="amount"/>
    <p>Amount: {{ $amount }}</p>

    <style>
        .red{
            color: red;
        }
    </style>
</div>