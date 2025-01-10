@extends('baseUser.master')

@section('content')
<div class="container-fluid" style="margin-top: 20px; margin-bottom: 20px">
    <div class="row">
        <div class="col-12">
            <h1>@lang('word.hello-lbl'), {{$user->name}}</h1>
    
            @if(session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif

            <div class="mb-4">
                <img src="{{ $user->gender == 'Male' ? asset('img/profile/male-pp.jpg') : asset('img/profile/female-pp.jpg') }}" class="rounded-circle" width="150">
            </div>

            <form action="{{ route('profile.update') }}" method="POST">
                @csrf

                <div class="form-group" style="margin-bottom: 5px">
                    <label>@lang('word.name-lbl')</label>
                    <input type="text" class="form-control" value="{{ $user->name }}" disabled>
                </div>

                <div class="form-group" style="margin-bottom: 5px">
                    <label>Email</label>
                    <input type="text" class="form-control" value="{{ $user->email }}" disabled>
                </div>

                <div class="form-group" style="margin-bottom: 5px">
                    <label>@lang('word.gender-lbl')</label>
                    <input type="text" class="form-control" value="{{ $user->gender }}" disabled>
                </div>

                <div class="form-group">
                    <label>@lang('word.interests-lbl')</label>
                    <div id="field-of-work-container">
                        @foreach(json_decode($user->field_of_work_interests) as $key => $interest)
                            <div class="d-flex mb-2">
                                <input type="text" name="field_of_work_interests[]" class="form-control" value="{{ $interest }}" required>
                            </div>
                        @endforeach
                    </div>
                    @error('field_of_work_interests')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-group" style="margin-bottom: 5px">
                    <label>@lang('word.lin-user')</label>
                    <input type="text" name="linkedin_username" class="form-control" value="{{ $user->linkedin_username }}" required>
                    @error('linkedin_username')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-group" style="margin-bottom: 5px">
                    <label>@lang('word.mobile-num-lbl')</label>
                    <input type="text" name="mobile_number" class="form-control" value="{{ $user->mobile_number }}" required>
                    @error('mobile_number')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-group" style="margin-bottom: 5px">
                    <label>@lang('word.profession-lbl')</label>
                    <input type="text" name="profession" class="form-control" value="{{ $user->profession }}" required>
                    @error('profession')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-group">
                    <label>@lang('word.wallet-bal')</label>
                    <input type="text" class="form-control" value="{{ $user->wallet }} @lang('word.coins-lbl')" disabled>
                </div>
                <br>
                <button type="submit" class="btn btn-success" style="margin-bottom: 20px">@lang('word.up-pr-btn')</button>
            </form>
        </div>
    </div>
</div>
@endsection