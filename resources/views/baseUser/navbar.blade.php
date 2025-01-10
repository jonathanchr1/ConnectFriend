<nav class="navbar navbar-expand-sm bg-primary navbar-dark">
  <div class="container-fluid">
    <a class="navbar-brand" href="#">ConnectFriend</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
      <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link" href="{{route('friends.index')}}">@lang('word.nav-home')</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="{{route('friends.list')}}">@lang('word.nav-friends')</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="{{route('messages.index')}}">@lang('word.nav-message')</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="{{route('profile.index')}}">@lang('word.nav-profile')</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="{{route('topup.index')}}">@lang('word.nav-topup')</a>
        </li>
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            @lang('word.nav-lang')
          </a>
          <ul class="dropdown-menu">
            <li><a class="dropdown-item" href="{{route('set-locale', 'en')}}">English</a></li>
            <li><a class="dropdown-item" href="{{route('set-locale', 'id')}}">Indonesia</a></li>
          </ul>
        </li>
        <li>
            <form id="logout-form" action="{{route('logout')}}" method="POST">
                @csrf
                <button type="submit" class="btn btn-danger" style="margin-left: 10px">@lang('word.nav-logout')</button>
            </form>
        </li>
      </ul>
    </div>
  </div>
</nav>