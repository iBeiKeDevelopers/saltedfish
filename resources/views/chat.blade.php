@extends('layouts.app')

@section('title', '聊天室')

@section('content')
<meta name="id" content="{{ Auth::id() }}">
<meta name="that_id" content="{{ $id }}">
<chat-room></chat-room>
@endsection