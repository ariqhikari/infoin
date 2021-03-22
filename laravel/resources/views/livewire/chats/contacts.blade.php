<div>
    <div class="card">
        <div class="card-header">
            <h4>
                @if (Auth::user()->role_id != 3)
                    Daftar Admin
                @else
                    Daftar User & Event Organizer
                @endif
            </h4>
        </div>
        <div class="card-body">
            <ul class="list-unstyled list-unstyled-border">
                @foreach ($contacts as $item)
                    <li class="media" style="cursor: pointer" wire:click="chooseContact({{ $item->id }})">
                        <img alt="image" class="mr-3 rounded-circle" width="50"  height="50"
                            src="
                            @if($item->google_id)
                                {{ $item->avatar }}
                            @else
                                {{ Storage::url($item->avatar) }}
                            @endif
                            "
                        >
                        <div class="media-body">
                            <h6 class="mt-0 mb-1 font-weight-bold">{{ $item->name }}</h6>
                            <div>
                                <div class="float-left">
                                    @if ($item->sender->count() != null)
                                        @php
                                            $chat = [];
                                        @endphp
                                        @foreach ($item->sender as $item2)
                                            @if ($item2->receiver_id == Auth::id())
                                                @php
                                                    $chat[] = $item2;
                                                @endphp
                                            @endif
                                        @endforeach
                                        @if ($chat)
                                            @php
                                            $message = Crypt::decrypt($chat[sizeOf($chat)-1]["message"]);
                                            @endphp
                                            {{ substr($message,0,100) }}
                                        @endif
                                    @endif
                                </div>
                                <span class="badge badge-primary float-right" style="margin-top: -1px">{{ $item->unread() }}</span>
                            </div>
                        </div>
                    </li>
                @endforeach
            </ul>
        </div>
    </div>
</div>
