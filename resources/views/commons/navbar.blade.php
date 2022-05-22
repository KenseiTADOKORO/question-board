<header>
    <nav class="navbar navbar-expand-sm navbar-light bg-white">
        <a class="navbar-brand" href="/">QuestionBoard</a>
        
        @if(Auth::check())
            <button type="button" class="navbar-toggler" data-toggle="collapse" data-target="#nav-bar">
                <span class="navbar-toggler-icon"></span>
            </button>
                
            <div class="collapse navbar-collapse" id="nav-bar">
                <ul class="navbar-nav mr-auto"></ul>
                <ul class="navbar-nav">
                    <li class="nav-item mt-2 mr-2">{!! link_to_route('logout.get', 'ログアウト') !!}</li>
                </ul>
            </div>
        @else
            <ul class="navbar-nav mr-auto"></ul>
            <ul class="navbar-nav">
                <li class="nav-item">{!! link_to_route('login', 'ログイン', [], ['class' => 'nav-link']) !!}</li>
                <li class="nav-item">{!! link_to_route('signup.get', '会員登録', [], ['class' => 'nav-link']) !!}</li>
            </ul>
        @endif
    </nav>
</header>