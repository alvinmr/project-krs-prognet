<?php

namespace App\Http\Livewire\Mahasiswa;

use App\Events\MessageEvent;
use App\Models\Message;
use App\Models\Pegawai;
use Livewire\Component;

class ChatLive extends Component
{
    public $messages, $chat, $chat_id, $pegawai;

    public function mount()
    {
        $this->fetchMessage();
        $this->pegawai = Pegawai::find($this->chat_id);
    }

    public function fetchMessage()
    {
        $this->messages = Message::where('from_id', $this->chat_id)->where('to_id', auth('mahasiswa')->user()->id)->orWhere('to_id', $this->chat_id)->where('from_id', auth('mahasiswa')->user()->id)->get();
        $this->dispatchBrowserEvent('message-update');
    }

    public function pushItem($item)
    {
        $message = Message::find($item);
        $this->messages->push($message);
        $this->dispatchBrowserEvent('message-update');
    }

    public function render()
    {
        return view('livewire.mahasiswa.chat-live');
    }

    public function sendMessage()
    {
        $mess = Message::create([
            'message' => $this->chat,
            'from_id' => auth('mahasiswa')->user()->id,
            'to_id' => $this->chat_id
        ]);
        event(new MessageEvent($mess->id, $mess->to_id));
        $this->chat = "";
    }
}