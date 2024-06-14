<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Atte</title>
    <link rel="stylesheet" href="{{ asset('css/sanitize.css') }}" />
  <link rel="stylesheet" href="{{ asset('css/login.css') }}" />
  
</head>
<body>
    <header class="header">
    <div class="header__inner">
      <a class="header__logo" href="/">
        Atte
      </a>
    </div>
  </header>

  <main>
    <div class="contact-form__content">
      <div class="contact-form__heading">
        <h2>ログイン</h2>

      </div>

      <form class="form" action="/login" method="post">
    @csrf
        <!-- メールアドレス入力フォーム -->
    <div>  
        <label for="email"></label>
        <input id="email" type="email" name="email" placeholder="メールアドレス" value="{{ old('email') }}" required>
        
    </div>

    <!-- パスワード入力フォーム -->
    <div>
        <label for="password"></label>   
           <input id="password" type="password" name="password" required placeholder="パスワード" autocomplete="new-password">
        
    </div>
          <button type="submit">ログイン</button>
    </form>
      <p>アカウントをお持ちでない方はこちらから<a href="{{ route('register') }}"><br>会員登録</a></p>
  </main>
    <footer>
        <div class="company-name">Atte, Inc.</div>
    </footer>
    
</body>
</html>