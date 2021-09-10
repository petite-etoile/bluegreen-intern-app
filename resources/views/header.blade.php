<nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">
    <div style="width:30px; float:left;"> </div>
    <a href="/home" class="navbar-brand mb-0 h1 ml-3"> サービス名</a> 
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="true" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button> 


    <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav">
            <li class="nav-item" >
                <a class="nav-link {{ $path == 'home' ? 'active' : ''}}" href="/home">ホーム <span class="sr-only"></span></a>
            </li>
            <li class="nav-item" >
                <a class="nav-link {{ $path == 'mypage' ? 'active' : ''}}" href="/mypage">マイページ</a>
            </li>
            <li class="nav-item" >
                <a class="nav-link {{ $path == 'user-list' ? 'active' : ''}}" href="/user-list">ユーザ一覧</a>
            </li>
            <li class="nav-item" >
                <a class="nav-link {{ $path == 'tweet-form' ? 'active' : ''}}" href="/tweet-form">ツイート作成</a>
            </li>
        </ul>
    </div>
    
</nav>
