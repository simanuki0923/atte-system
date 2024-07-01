<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Atte</title>
    <link rel="stylesheet" href="{{ asset('css/attendance.css') }}" />
    <link rel="stylesheet" href="{{ asset('css/user.css') }}" />
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
    <header class="header__wrap">
        <h1 class="text-center">ユーザー一覧</h1>
    </header>
        <p class="current-date">{{ $displayDate->format('Y-m-d') }}</p>
        </div>
        <div class="table__wrap">
         <table class="attendance__table">
           <tr class="table__row">
                <th class="table__header">No.</th>
                <th class="table__header">ID</th>
                <th class="table__header">名前</th>
                <th class="table__header">Email</th>
                <th class="table__header">勤務状態</th>
           </tr>
            @php
                $pageNumber = ($users->currentPage() - 1) * $users->perPage() + 1;
            @endphp
            @foreach ($users as $user)
                <tr class="table__row">
                    <td class="table__item">{{ $pageNumber }}</td>
                    <td class="table__item">{{ $user->id }}</td>
                    <td class="table__item">{{ $user->name }}</td>
                    <td class="table__item">{{ $user->email }}</td>
                    @if ($user->status == 1)
                        <td class="table__item">勤務中</td>
                    @elseif($user->status == 2)
                        <td class="table__item">休憩中</td>
                    @elseif($user->status == 3)
                        <td class="table__item">退勤</td>
                    @else
                        <td class="table__item">その他</td>
                    @endif
                </tr>
                @php
                    $pageNumber++;
                @endphp
            @endforeach
       </table>
      </div>
</body>
</html>