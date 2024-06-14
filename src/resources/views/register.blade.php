<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Atte</title>
    <link rel="stylesheet" href="{{ asset('css/sanitize.css') }}" />
  <link rel="stylesheet" href="{{ asset('css/register.css') }}" />
  
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
        <h2>会員登録</h2>

      </div>

    <form method="POST" action="{{ route('register.store') }}">
     @csrf

     <!-- 名前入力フォーム -->
    
     <div>
        <label for="name"></label>
        <input id="name" type="text" name="name" placeholder="名前" value="{{ old('name') }}" required >
        <div class="form__error">
             @error('name')
               <span class="error">{{ $message }}</span>
             @enderror
         </div>
        
     </div>
        <!-- メールアドレス入力フォーム -->
     <div>  
        <label for="email"></label>
        <input id="email" type="email" name="email" placeholder="メールアドレス" value="{{ old('email') }}" required>
        <div class="form__error">
             @error('email')
               <span class="error">{{ $message }}</span>
             @enderror
        </div>
        
     </div>

     <!-- パスワード入力フォーム -->
     <div>
        <label for="password"></label>
           <input id="password" type="password" name="password" required placeholder="パスワード" autocomplete="new-password">
           <div class="form__error">
             @error('password')  
                <span class="error">{{ $message }}</span>
             @enderror
           </div>
     </div>

     <!-- パスワード確認入力フォーム -->
     <div>
         <label for="password_confirmation"></label>
        
   
         <input id="password_confirmation" type="password" name="password_confirmation" required placeholder="確認用パスワード">
     </div>
          <button type="submit">会員登録</button>
    </form>
      <p>アカウントをお持ちの方はこちらから<a href="{{ route('login') }}"><br>ログイン</a></p>
  </main>
    <footer>
        <div class="company-name">Atte, Inc.</div>
    </footer>
    
</body>
</html>