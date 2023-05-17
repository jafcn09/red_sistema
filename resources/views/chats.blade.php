@extends('layouts.app', ['class' => 'off-canvas-sidebar', 'activePage' => 'planes', 'title' => __('REDSOTEC')])

@section('content')
<div id="app" class="container">
    <chats></chats>
</div>
@endsection