

    <div class="relative">
        <input
        type="text"
        class="form-input"
        placeholder="Ve..."
        wire:model="query"
        wire:keydown.escape="reset"
        wire:keydown.tab="reset"
        wire:keydown.arrow-up="decrementHighlight"
        wire:keydown.arrow-down="incrementHighlight"
        wire:keydown.enter="selectContact"
        class="block w-full mt-1 "
        />
        
        <div wire:loading class="absolute z-10 w-full bg-white rounded-t-none shadow-lg list-group">
            <div class="list-item">Searching...</div>
        </div>
 
        @if(!empty($query))
        <div class="fixed top-0 bottom-0 left-0 right-0" wire:click="reset"></div>
        
        <div class="absolute z-10 w-full bg-white rounded-t-none shadow-lg list-group">
            @if(!empty($record))
                @foreach($record as $i => $vendor)
                    <a
                        {{-- href="{{ route('show-contact', $vendor['id']) }}" --}}
                        href="#"
                        class="list-item {{ $highlightIndex === $i ? 'highlight' : '' }}"
                    >{{ $vendor['name'] }}</a>
                @endforeach
            @else
                <div class="list-item">No results!</div>
            @endif
        </div>
    @endif
</div>
   