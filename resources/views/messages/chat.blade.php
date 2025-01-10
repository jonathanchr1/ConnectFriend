@extends('baseUser.master')

@section('content')
<div class="container-fluid" style="margin-top: 20px; margin-bottom: 20px">
    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif
    <div class="row">
        <div class="col-1">
            <img src="{{ $friend->gender == 'Male' ? asset('img/profile/male-pp.jpg') : asset('img/profile/female-pp.jpg') }}" class="rounded-circle" width="75">
        </div>
        <div class="col-6">
            <h3 style="margin-top: 15px">{{ $friend->name }}</h3>
        </div>
        <div class="col-4">
        </div>
        <div class="col-1">
            <div class="d-flex justify-content-between align-items-right mb-3">
                <a href="{{ route('messages.index') }}" class="btn btn-secondary" style="margin-top: 12px">@lang('word.back-btn')</a>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body" id="chat-messages" style="height: 400px; overflow-y: auto;">
                    @foreach($messages as $message)
                        <div class="d-flex mb-2 {{ $message->sender_id === auth()->id() ? 'justify-content-end' : '' }}">
                            <div class="pt-2 px-2 pb-2 rounded {{ $message->sender_id === auth()->id() ? 'bg-primary text-white' : 'bg-light text-dark' }}">
                                <strong>{{ $message->sender_id === auth()->id() ? 'You' : $friend->name }}:</strong>
                                <p class="mb-0">{{ $message->message }}</p>
                                <small class="text-info">{{ $message->created_at->format('H:i') }}</small>
                            </div>
                        </div>
                    @endforeach
                </div>

                <div class="card-footer">
                    <form id="chat-form" action="{{ route('messages.send') }}" method="POST">
                        @csrf
                        <input type="hidden" id="receiver-id" name="receiver_id" value="{{ $friend->id }}">
                         <div class="input-group">
                            <input id="chat-input" type="text" name="message" class="form-control" placeholder="@lang('word.tym-lbl')" required>
                            <button class="btn btn-primary" type="submit">@lang('word.send-btn')</button>
                         </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection