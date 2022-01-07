<?php

namespace App\Http\Livewire\Pegawai;

use App\Events\MessageEvent;
use App\Models\Mahasiswa;
use App\Models\Message;
use Livewire\Component;

class ChatLive extends Component
{
    public $messagesData, $chat, $chat_id, $mahasiswa;

    protected $rules = [
        'chat' => 'required'
    ];

    public function mount()
    {
        $this->fetchMessage();
        $this->mahasiswa = Mahasiswa::find($this->chat_id);
    }

    public function fetchMessage()
    {
        $this->messagesData = Message::where('from_id', $this->chat_id)->where('to_id', auth('pegawai')->user()->id)->orWhere('to_id', $this->chat_id)->where('from_id', auth('pegawai')->user()->id)->get();
        $this->dispatchBrowserEvent('message-update');
    }

    public function pushItem($item)
    {
        $message = Message::find($item);
        $this->messagesData->push($message);
        $this->dispatchBrowserEvent('message-update');
    }

    public function render()
    {
        return view('livewire.pegawai.chat-live');
    }

    public function sendMessage()
    {
        $this->validate();
        $mess = Message::create([
            'message' => $this->chat,
            'from_id' => auth('pegawai')->user()->id,
            'to_id' => $this->chat_id
        ]);
        event(new MessageEvent($mess->id, $mess->to_id));
        $this->chat = "";
    }
}