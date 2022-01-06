@extends('layouts.app')

@section('title', 'Live Chat')

@section('content')
    @livewire('mahasiswa.chat-live', ['chat_id' => $id])
@endsection
