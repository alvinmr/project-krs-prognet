@extends('layouts.app')

@section('title', 'Live Chat')

@section('content')
    @livewire('pegawai.chat-live', ['chat_id' => $id])
@endsection
