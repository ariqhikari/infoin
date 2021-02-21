<div>
    @if ($contact != null)
        <div class="card chat-box" id="mychatbox">
            <div class="card-header">
                <h4 style="text-transform: capitalize">{{ $contact["name"] }}</h4>
            </div>
            <div class="card-body chat-content" style="overflow: scroll;overflow-x:hidden">
                @foreach ($chatMe as $item)
                    @if ($item->sender_id == $contact["id"])
                        <div class="chat-item chat-left">
                            <img 
                                width="50" height="50"
                                src="
                                @if($contact["google_id"])
                                    {{ $contact["avatar"] }}
                                @else
                                    {{ Storage::url($contact["avatar"]) }}
                                @endif
                                "
                            >
                            <div class="chat-details">
                                @php
                                    $message = $decrypted = Crypt::decrypt($item->message);
                                @endphp
                            <div class="chat-text">{{ $message }}</div>
                                <div class="chat-time">{{ $item->created_at->format("H:i") }}</div>
                            </div>
                        </div>
                    @endif
                    @if ($item->sender_id == Auth::id())
                        <div class="chat-item chat-right" style="">
                            <img 
                                width="50" height="50"
                                src="
                                @if($item->sender->google_id)
                                    {{ $item->sender->avatar }}
                                @else
                                    {{ Storage::url($item->sender->avatar) }}
                                @endif
                                "
                            >
                            <div class="chat-details">
                                @php
                                    $message = $decrypted = Crypt::decrypt($item->message);
                                @endphp
                                <div class="chat-text">{{ $message }}</div>
                                <div class="chat-time">{{ $item->created_at->format("H:i") }}</div>
                            </div>
                        </div>
                    @endif
                @endforeach
            </div>
            <div class="card-footer chat-form">
                <form id="chat-form" wire:submit.prevent="storeMessage">
                    <input type="text" class="form-control" wire:model="message" required placeholder="Type a message">
                    <button type="submit" class="btn btn-primary">
                    <i class="far fa-paper-plane"></i>
                    </button>
                </form>
            </div>
        </div>
    @endif
</div>
