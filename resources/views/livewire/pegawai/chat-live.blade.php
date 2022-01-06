<div>
    <div class="row align-items-center justify-content-center">
        <div class="col-12 col-lg-12">
            <div class="card chat-box card-success" id="mychatbox2">
                <div class="card-header">
                    <h4><i class="fas fa-circle text-success mr-2" title="Online" data-toggle="tooltip"></i> Chat with
                        {{ $mahasiswa->nama }}
                    </h4>
                </div>
                <div class="card-body chat-content" id="chatbox">
                    @foreach ($messages as $item)
                        <div class="chat-item {{ $item->from_id == auth('pegawai')->user()->id ? 'chat-right' : 'chat-left' }}"
                            style=""><img
                                src="https://source.boringavatars.com/beam/120/{{ auth('pegawai')->user()->nama }}">
                            <div class="chat-details">
                                <div class="chat-text">{{ $item->message }}</div>
                                <div class="chat-time">{{ $item->created_at }}</div>
                            </div>
                        </div>
                    @endforeach
                </div>
                <div class="card-footer chat-form">
                    <form id="chat-form2" wire:submit.prevent="sendMessage">
                        <input type="text" wire:model.lazy="chat" class="form-control" placeholder="Type a message">
                        <button class="btn btn-primary">
                            <i class="far fa-paper-plane"></i>
                        </button>
                    </form>
                    @error('chat') <span class="error">{{ $message }}</span> @enderror
                </div>
            </div>
        </div>
    </div>
</div>

@push('scripts')
    <script>
        $(document).ready(function() {
            var div = document.getElementById("chatbox");
            $('#chatbox').animate({
                scrollTop: div.scrollHeight - div.clientHeight
            }, 500);
        })
        document.addEventListener('livewire:load', function() {
            Echo.channel('user-message.' + "{{ auth('pegawai')->user()->id }}")
                .listen('MessageEvent', (e) => {
                    @this.fetchMessage()
                    var div = document.getElementById("chatbox");
                    $('#chatbox').animate({
                        scrollTop: div.scrollHeight - div.clientHeight
                    }, 500);
                })
            Echo.channel('user-message.' + @this.chat_id)
                .listen('MessageEvent', (e) => {
                    @this.pushItem(e.id)
                })
        })
    </script>
@endpush
