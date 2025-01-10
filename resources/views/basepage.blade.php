@extends('base.master')

@section('content')
<div class="container" style="margin-top: 20px">
    <form method="GET" action="{{ route('welcome') }}" class="d-flex align-items-center mb-4">
        <input type="text" name="search" class="form-control me-2" placeholder="@lang('word.search-bar')"
            value="{{ request('search') }}">

        <select name="gender" class="form-select me-2">
            <option value="">@lang('word.all-genders')</option>
            <option value="Male" {{ request('gender') == 'Male' ? 'selected' : '' }}>@lang('word.male-gender')</option>
            <option value="Female" {{ request('gender') == 'Female' ? 'selected' : '' }}>@lang('word.female-gender')</option>
        </select>

        <button type="submit" class="btn btn-primary me-2">@lang('word.search-btn')</button>
        <a href="{{ route('welcome') }}" class="btn btn-secondary">Reset</a>
    </form>

    <div class="row">
        @forelse($users as $user)
        <div class="col-md-4 mb-4">
            <div class="card">
                <div class="card-body" style="text-align:center">
                    <img src="{{ $user->gender == 'Male' ? asset('img/profile/male-pp.jpg') : asset('img/profile/female-pp.jpg') }}" class="rounded-circle" width="150">
                    <h5 class="card-title">{{ $user->name }}</h5>
                    <p>@lang('word.interests-lbl'): {{ implode(', ', json_decode($user->field_of_work_interests)) }}</p>
                    <p>@lang('word.profession-lbl'): {{ $user->profession }}</p>
                    <a href="{{ route('friends.show', $user) }}" class="btn btn-primary">@lang('word.view-det-btn')</a>
                </div>
            </div>
        </div>
        @empty
            <p class="text-center">@lang('word.nuf-lbl')</p>
        @endforelse
    </div>

    <div class="d-flex justify-content-center">
        {{ $users->links() }}
    </div>
</div>
@endsection