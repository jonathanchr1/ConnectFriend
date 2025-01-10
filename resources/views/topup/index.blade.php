@extends('baseUser.master')

@section('content')
<div class="container-fluid" style="margin-top: 20px; margin-bottom: 20px">
    <div class="row">
        <div class="col-12" style="text-align: center">
            <h1>@lang('word.nav-topup')</h1>
            <p>@lang('word.topup-info')</p>
            @if(session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif
        </div>
        <div class="col-12" style="text-align: center">
            <img src="{{asset('img/wallet.png')}}" style="width:40%">
        </div>
        <div class="col-12" style="text-align: center">
            <div class="mb-2">
                <h5>@lang('word.wallet-info'): {{ $user->wallet }} @lang('word.coins-lbl')</h3>
            </div>

            <form action="{{ route('topup.store') }}" method="POST">
                @csrf
                <button type="submit" class="btn btn-primary">@lang('word.nav-topup')</button>
            </form>
        </div>
    </div>
</div>
@endsection