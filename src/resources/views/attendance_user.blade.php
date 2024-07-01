<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Atte</title>
    <link rel="stylesheet" href="{{ asset('css/sanitize.css') }}">
    <link rel="stylesheet" href="{{ asset('css/attendance_user.css') }}">
</head>
<body>
    <header class="header">
        <a class="header__logo" href="/">Atte</a>
        <nav class="nav-links">
            <a href="/">ホーム</a>
            <a href="{{ route('attendance.date') }}">日付一覧</a>
            <a href="/create-folder">ユーザー一覧</a>
            <a href="/user">勤怠表</a>
            <a href="/logout">ログアウト</a>
        </nav>
    </header>
  <form class="header__wrap" action="{{ route('user.search') }}" method="post">
    @csrf

    @if($displayUser)
        <p class="header__text">{{ $displayUser }} さんの勤怠表</p>
        
    @else
        <p class="header__text">ユーザーを選択してください</p>
    @endif

    <div class="search__item">
        <input class="search__input" type="text" name="search_name" placeholder="名前検索" value="{{ $searchParams['name'] ?? '' }}" list="user_list">
        <datalist id="user_list">
            @if($userList)
                @foreach($userList as $user)
                    <option value="{{ $user->name }}">{{ $user->name }}</option>
                @endforeach
            @endif
        </datalist>
        <button type="submit" class="search__button">検索</button>
    </div>
</form>
   <div class="table__wrap">
        <table class="attendance__table">
            <tr class="table__row">
                <th class="table__header">日付</th>
                <th class="table__header">勤務開始</th>
                <th class="table__header">勤務終了</th>
                <th class="table__header">休憩時間</th>
                <th class="table__header">勤務時間</th>
            </tr>
            @foreach ($users as $user)
                <tr class="table__row">
                    <td class="table__item">{{ $user->date }}</td>
                    <td class="table__item">{{ $user->start }}</td>
                    <td class="table__item">{{ $user->end }}</td>
                    <td class="table__item">{{ $user->total_rest }}</td>
                    <td class="table__item">{{ $user->total_work }}</td>
                </tr>
            @endforeach
        </table>
    </div> 
</body>
</html>