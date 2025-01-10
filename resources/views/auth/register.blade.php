@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Register') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('register') }}">
                        @csrf

                        <div class="form-group">
                            <label for="name">{{ __('Name') }}</label>

                            <div class="col-md-12">
                                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>

                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="email">{{ __('Email Address') }}</label>

                            <div class="col-md-12">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="password">{{ __('Password') }}</label>

                            <div class="col-md-12">
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="password-confirm">{{ __('Confirm Password') }}</label>

                            <div class="col-md-12">
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                            </div>
                        </div>
                        
                        <div class="form-group">
                            <label for="gender">Gender</label>
                            <select class="form-control" id="gender" name="gender" required>
                                <option value="Male">Male</option>
                                <option value="Female">Female</option>
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="field_of_work_interests">Field of Work Interests (3)</label>
                            <input type="text" name="field_of_work_interests[]" class="form-control mb-1" value="{{ old('field_of_work_interests.0') }}" required>
                            <input type="text" name="field_of_work_interests[]" class="form-control mb-1" value="{{ old('field_of_work_interests.1') }}" required>
                            <input type="text" name="field_of_work_interests[]" class="form-control mb-1" value="{{ old('field_of_work_interests.2') }}" required>
                            @error('field_of_work_interests')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                            @foreach ($errors->get('field_of_work_interests.*') as $error)
                                <span class="text-danger">{{ $error[0] }}</span>
                            @endforeach
                        </div>

                        <div class="form-group">
                            <label for="linkedin_username">LinkedIn Profile</label>
                            <input type="url" class="form-control" id="linkedin_username" name="linkedin_username" placeholder="https://www.linkedin.com/in/username" required>
                        </div>

                        <div class="form-group">
                            <label for="mobile_number">Mobile Number</label>
                            <input type="text" class="form-control" id="mobile_number" name="mobile_number" placeholder="Mobile Number" required>
                        </div>

                        <div class="form-group">
                            <label for="profession">Current Profession</label>
                            <input type="text" name="profession" class="form-control" required>
                        </div>

                        <br>
                        <div class="row justify-content-center">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Register') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
