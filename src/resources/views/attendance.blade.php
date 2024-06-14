<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Atte</title>
    <link rel="stylesheet" href="{{ asset('css/sanitize.css') }}">
    <link rel="stylesheet" href="{{ asset('css/attendance.css') }}">
</head>
<body>
    <header class="header">
        <a class="header__logo" href="/">Atte</a>
        <nav class="nav-links">
            <a href="/">ホーム</a>
            <a href="{{ route('attendance.date') }}">日付一覧</a>
            <a href="/logout">ログアウト</a>
        </nav>
    </header>
    <div class="content">
        <div class="date-navigation">
          
         <div class="button-container">
            <form method="GET" action="{{ route('attendance.perDate', $displayDate->format('Y-m-d')) }}">
                <button type="submit" class="date__change-button" name="prevDate">&lt;</button>
            </form>
             <p class="current-date">{{ $displayDate->format('Y-m-d') }}</p>
            <form method="GET" action="{{ route('attendance.perDate', $displayDate->format('Y-m-d')) }}">
                <input type="hidden" name="displayDate" value="{{ $displayDate->format('Y-m-d') }}">
                <button type="submit" class="date__change-button" name="nextDate">&gt;</button>
            </form>
        </div>
    </div>
        <table class="attendance-table">
            <thead>
                <tr>
                    <th>ユーザー名</th>
                    <th>勤務開始</th>
                    <th>勤務終了</th>
                    <th>休憩時間</th>
                    <th>勤務時間</th>
                </tr>
            </thead>
            <tbody>
         @isset($works)
           @foreach ($works as $work)
                <tr class="table__row">
                    <td class="table__item">{{ $work->user->name }}</td>
                    <td class="table__item">{{ $work->start }}</td>
                    <td class="table__item">{{ $work->end ?? '未登録' }}</td>
                    <td>{{ gmdate('H:i:s', strtotime($work->end) - strtotime($work->start) - $work->rests->sum(fn($rest) => strtotime($rest->end) - strtotime($rest->start))) }}</td>
                    <td>{{ gmdate('H:i:s', strtotime($work->end) - strtotime($work->start)) }}</td>
                </tr>
           @endforeach
        @endisset        
            </tbody>
        </table>
       @if ($works->hasPages())
    <div class="pagination__wrap">
        <div class="pagination">
            <ul class="pagination__nav" role="navigation">
                {{-- Previous Page Link --}}
                @if ($works->onFirstPage())
                    <li class="pagination__list" aria-disabled="true" aria-label="@lang('pagination.previous')">
                        <span class="pagination__item">&lt;</span>
                    </li>
                @else
                    <li class="pagination__list">
                        <a class="pagination__item" href="{{ $works->previousPageUrl() }}" rel="prev" aria-label="@lang('pagination.previous')">&lt;</a>
                    </li>
                @endif

                {{-- Pagination Links --}}
                @for ($i = max(1, $works->currentPage() - 4); $i <= min($works->lastPage(), $works->currentPage() + 5); $i++)
                    <li class="pagination__list">
                        <a class="pagination__item {{ $i == $works->currentPage() ? 'active' : '' }}" href="{{ $works->url($i) }}">{{ $i }}</a>
                    </li>
                @endfor

                {{-- Next Page Link --}}
                @if ($works->hasMorePages())
                    <li class="pagination__list">
                        <a class="pagination__item" href="{{ $works->nextPageUrl() }}" rel="next" aria-label="@lang('pagination.next')">&gt;</a>
                    </li>
                @else
                    <li class="pagination__list" aria-disabled="true" aria-label="@lang('pagination.next')">
                        <span class="pagination__item">&gt;</span>
                    </li>
                @endif
            </ul>
        </div>
    </div>
@endif
    </div>
    <footer>
        <div class="company-name">Atte, Inc.</div>
    </footer>
</body>
</html>