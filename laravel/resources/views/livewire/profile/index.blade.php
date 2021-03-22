<div>
    @if ($statusEdit == false)
        <livewire:profile.edit></livewire:profile.edit>
    @else
        <livewire:profile.update :user="$user"></livewire:profile.update>
    @endif
</div>
