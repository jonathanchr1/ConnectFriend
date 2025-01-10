@extends('baseUser.master')

@section('content')
<div class="container-fluid">
    <div class="row" style="margin-top: 20px; margin-bottom: 20px">
        <div class="col-12" style="text-align: center">
            <img src="{{ $user->gender == 'Male' ? asset('img/profile/male-pp.jpg') : asset('img/profile/female-pp.jpg') }}" class="rounded-circle" width="150">
        </div>
        <div class="col-12" style="text-align: center">
            <h1>{{ $user->name }}</h1>
            <p>Email: {{ $user->email }}</p>
            <p>@lang('word.gender-lbl'): {{ $user->gender }}</p>
            <p>@lang('word.interests-lbl'): {{ implode(', ', json_decode($user->field_of_work_interests)) }}</p>
            <p>LinkedIn: <a href="{{ $user->linkedin_username }}" target="_blank">{{ $user->linkedin_username }}</a></p>
            <p>@lang('word.mobile-num-lbl'): {{ $user->mobile_number }}</p>
            <p>@lang('word.profession-lbl'): {{ $user->profession }}</p>

            @if ($isFriend)
                <p class="text-success">@lang('word.already-friend')</p>
            @elseif ($hasSentRequest)
                <p class="text-warning">@lang('word.request-sent')</p>
            @elseif ($hasReceivedRequest)
                <form action="{{ route('friends.accept', $user->id) }}" method="POST">
                    @csrf
                    <button type="submit" class="btn btn-success">@lang('word.accept-fr-req')</button>
                </form>
            @else
                <form action="{{ route('friends.request', $user->id) }}" method="POST">
                    @csrf
                    <button type="submit" class="btn btn-primary">@lang('word.make-fr-btn')</button>
                </form>
            @endif  
        </div>
    </div>
</div>
@endsection
