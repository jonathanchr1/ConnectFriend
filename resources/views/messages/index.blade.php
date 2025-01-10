@extends('baseUser.master')

@section('content')
<div class="container-fluid" style="margin-top: 20px; margin-bottom: 20px">
    <h1>@lang('word.fl-lbl')</h1>
    <p>@lang('word.message-info')</p>
    <div class="row">
    @forelse ($friends as $friend)
        <div class="col-2">
            <img src="{{ $friend->gender == 'Male' ? asset('img/profile/male-pp.jpg') : asset('img/profile/female-pp.jpg') }}" class="rounded-circle" width="150">
        </div>
        <div class="col-10">
            <h5 style="margin-top: 20px">{{ $friend->name }}</h5>
            <p>{{ $friend->profession }}</p>
            <a href="{{ route('messages.chat', $friend->id) }}" class="btn btn-primary">@lang('word.chat-now-btn')</a>
        </div>
    @empty
        <div class="col-2">
            <img src="{{ asset('img/profile/blank-pp.png') }}" class="rounded-circle" width="150">
        </div>
        <div class="col-10">
            <p style="margin-top: 50px">@lang('word.nuf-lbl')</p>
        </div>
    @endforelse
    </div>
</div>
@endsection