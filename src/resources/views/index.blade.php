<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Atte</title>
    <link rel="stylesheet" href="{{ asset('css/sanitize.css') }}" />
    <link rel="stylesheet" href="{{ asset('css/index.css') }}" />
</head>

<body>
  <header class="header">
    <div class="header__inner">
      <a class="header__logo" href="/">Atte</a>
    </div>
    <nav class="nav-links">
      @if (Auth::check())
        <a href="/">ホーム</a>
        <a href="{{ route('attendance') }}">日付一覧</a>
        <a href="/create-folder">ユーザー一覧</a>
        <a href="/user">勤怠表</a>
        <a href="{{ route('logout') }}">ログアウト</a>
      @endif
    </nav>
  </header>

  <div class="contact-form__content">
    <div class="contact-form__heading">
      @if (Auth::check())
       <h2>{{ Auth::user()->name }} さん、お疲れ様です！</h2>
      @else
       <h2>ゲスト さん、お疲れ様です！</h2>
      @endif
    </div>
  </div>

  <form class="form__wrap" action="{{ route('work.update') }}" method="post">
    @csrf
    <div class="container">
      <!-- ボタンのグループ1 -->
      <div>
        <button class="form__item-button" type="submit" name="start_work" {{ $status == 0 ? '' : 'disabled' }}>勤務開始</button>
        <button class="form__item-button" type="submit" name="end_work" {{ $status == 1 ? '' : 'disabled' }}>勤務終了</button>
      </div>
      <!-- ボタンのグループ2 -->
      <div>
       <button class="form__item-button" type="submit" name="start_rest" {{ $status == 1 ? '' : 'disabled' }}>休憩開始</button>
        <button class="form__item-button" type="submit" name="end_rest" {{ $status == 2 ? '' : 'disabled' }}>休憩終了</button> 
      </div>
    </div>
  </form>

  <footer>
    <div class="company-name">Atte, Inc.</div>
  </footer>
</body>
</html>