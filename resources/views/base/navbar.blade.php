<nav class="navbar navbar-expand-sm bg-primary navbar-dark">
  <div class="container-fluid">
    <a class="navbar-brand" href="#">ConnectFriend</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
      <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link" href="{{route('welcome')}}">@lang('word.nav-home')</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="{{route('login')}}">@lang('word.nav-login')</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="{{route('register')}}">@lang('word.nav-reg')</a>
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
      </ul>
    </div>
  </div>
</nav>