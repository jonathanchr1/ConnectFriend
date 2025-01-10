@extends('baseUser.master')

@section('content')
<div class="container-fluid" style="margin-top: 20px; margin-bottom: 20px">
    <div class="row">
        <div class="col-12">
            <h1>@lang('word.yf-lbl')</h1>
            <h3>@lang('word.fl-lbl')</h3>
        </div>
    </div>
    <div class="row">
        @forelse ($friends as $friend)
            <div class="col-2">
                <img src="{{ $friend->gender == 'Male' ? asset('img/profile/male-pp.jpg') : asset('img/profile/female-pp.jpg') }}" class="rounded-circle" width="150">
            </div>
            <div class="col-10">
                <h5 style="margin-top: 20px">{{ $friend->name }}</h5>
                <p>{{ $friend->profession }}</p>
                <a href="{{ route('friends.show', $friend) }}" class="btn btn-primary btn-sm">@lang('word.view-det-btn')</a>
                <form action="{{ route('friends.delete', $friend) }}" method="POST" style="display:inline;">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger btn-sm">@lang('word.remove-fr-btn')</button>
                </form>
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

    <div class="row" style="margin-top: 20px">
        <div class="col-12">
            <h3>@lang('word.rec-fr-req')</h3>
        </div>
    </div>
    <div class="row">
        @forelse ($receivedRequests as $request)
            <div class="col-2">
                <img src="{{ $request->sender->gender == 'Male' ? asset('img/profile/male-pp.jpg') : asset('img/profile/female-pp.jpg') }}" class="rounded-circle" width="150">
            </div>
            <div class="col-10">
                <h5 style="margin-top: 20px">{{ $request->sender->name }}</h5>
                <p>{{ $request->sender->profession }}</p>
                <form action="{{ route('friends.accept', $request) }}" method="POST" style="display:inline;">
                    @csrf
                    <button type="submit" class="btn btn-success btn-sm">@lang('word.acc-btn')</button>
                </form>
                <form action="{{ route('friends.reject', $request) }}" method="POST" style="display:inline;">
                    @csrf
                    <button type="submit" class="btn btn-danger btn-sm">@lang('word.rej-btn')</button>
                </form>
            </div>
        @empty
            <div class="col-2">
                <img src="{{ asset('img/profile/blank-pp.png') }}" class="rounded-circle" width="150">
            </div>
            <div class="col-10">
                <p style="margin-top: 50px">@lang('word.nrf-lbl')</p>
            </div>
        @endforelse
    </div>

    <div class="row" style="margin-top: 20px">
        <div class="col-12">
            <h3>@lang('word.sen-fr-req')</h3>
        </div>
    </div>
    <div class="row">
        @forelse ($sentRequests as $request)
            <div class="col-2">
                <img src="{{ $request->receiver->gender == 'Male' ? asset('img/profile/male-pp.jpg') : asset('img/profile/female-pp.jpg') }}" class="rounded-circle" width="150">
            </div>
            <div class="col-10">
                <h5 style="margin-top: 20px">{{ $request->receiver->name }}</h5>
                <p>{{ $request->receiver->profession }}</p>
            </div>
        @empty
            <div class="col-2">
                <img src="{{ asset('img/profile/blank-pp.png') }}" class="rounded-circle" width="150">
            </div>
            <div class="col-10">
                <p style="margin-top: 50px">@lang('word.nrf-lbl')</p>
            </div>
        @endforelse
    </div>
</div>
@endsection