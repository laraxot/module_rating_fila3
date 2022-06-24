<div>
    {{-- non "acchiappa" il wire:click, anche con la blade originale --}}
    <li>
        <span wire:click="update()">
            <i
                @if ($fav) class="ri-heart-fill"
                @else
                    class="ri-heart-line" @endif>
            </i>
        </span>
    </li>
</div>
