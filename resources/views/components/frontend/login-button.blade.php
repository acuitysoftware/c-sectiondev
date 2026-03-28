@props(['name' => $name, "target"=> $target])
<button class="login_btn" >
    <span >{{ $name }}</span>
    <span wire:loading wire:target="{{ $target }}" >
        <div class="text-center" >
            <div class="spinner-border text-white spinner-border-sm" role="status">
            </div>
        </div>
    </span>
</button>
