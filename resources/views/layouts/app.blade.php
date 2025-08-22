<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
    <link
        href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700&family=Knewave&family=Noto+Sans+JP:wght@400;700&display=swap"
        rel="stylesheet">
    <!-- TUI Calendar のCSS（公式デザイン） -->
    <link rel="stylesheet" href="https://uicdn.toast.com/calendar/latest/toastui-calendar.min.css">
    <!-- 自分のCSS（カスタム上書きは最後に） -->
    <link rel="stylesheet" href="{{ asset('assets/css/top.css') }}">

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="font-sans antialiased">
    <div class="min-h-screen bg-gray-100">
        {{-- @include('layouts.navigation') --}}

        <!-- Page Heading -->
        {{-- @if (isset($header))
                <header class="bg-white shadow">
                    <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                        {{ $header }}
                    </div>
                </header>
            @endif --}}

        <header class="header">
            <!-- 画像ロゴを削除して文字に変更 -->
            <div class="logo">
                <h1 class="logo-text">My Pace</h1>
            </div>
            <div class="header-icons">
                <button class="icon-btn" aria-label="Add">＋</button>
                <button class="icon-btn bell-btn" aria-label="Notifications">
                    <img src="{{ asset('assets/img/bell1.png') }}" alt="通知">
                </button>

                <div class="user-menu" style="position: relative;">
                    <button id="avatarBtn" class="avatar-btn" aria-haspopup="true" aria-expanded="false"
                        style="border:none;background:transparent;padding:0;cursor:pointer;">
                        <img class="avatar" src="{{ asset('assets/img/normal.jpg') }}" alt="Me"
                            style="display:block;">
                    </button>
                    <div id="avatarMenu" class="avatar-dropdown" role="menu" aria-labelledby="avatarBtn"
                        style="position:absolute; right:0; top:calc(100% + 8px); min-width: 160px; background:#fff; border:1px solid #e5e7eb; border-radius:8px; box-shadow:0 8px 24px rgba(0,0,0,0.12); padding:8px 0; display:none; z-index:1000;">
                        <a href="{{ route('profile.edit') }}" role="menuitem" class="menu-item"
                            style="display:block; padding:10px 14px; text-decoration:none; color:#111827;">
                            Profile
                        </a>
                        <form method="POST" action="{{ route('logout') }}" style="margin:0;" role="none">
                            @csrf
                            <button type="submit" role="menuitem" class="menu-item"
                                style="display:block; width:100%; text-align:left; padding:10px 14px; background:none; border:none; cursor:pointer; color:#111827;">
                                Logout
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </header>

        <!-- Page Content -->
        <main>
            @yield('content')
        </main>
    </div>

    <script>
        // 選んだ画像をプレビュー表示する
        function previewImage(event, previewId) {
            const file = event.target.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    document.getElementById(previewId).src = e.target.result;
                };
                reader.readAsDataURL(file);
            }
        }
    </script>

    {{-- <script>
        // --- ToDo: 追加/削除/完了トグル（ローカル保存つき） ---
        (function() {
            // ★ 今のHTMLに合わせたID
            const list = document.getElementById('todo-list'); // <ul id="todo-list">
            const input = document.getElementById('new-task'); // <input id="new-task">
            const addBtn = document.getElementById('add-task'); // <button id="add-task">
            const STORAGE_KEY = 'mypace_todos_v1';

            if (!list) return; // 要素がなければ何もしない

            // ---- 便利関数：liからテキストとチェック状態を取得 ----
            function getItemState(li) {
                const checkbox = li.querySelector('input[type="checkbox"]');
                // <span class="todo-text"> or <label> のどちらでもOKにする
                const textNode = li.querySelector('.todo-text') || li.querySelector('label');
                const text = textNode ? textNode.textContent : '';
                const done = !!(checkbox && checkbox.checked);
                return {
                    text,
                    done
                };
            }

            // ---- 保存 & 読み込み ----
            function save() {
                const data = [...list.querySelectorAll('li')].map(getItemState);
                localStorage.setItem(STORAGE_KEY, JSON.stringify(data));
            }

            function load() {
                const raw = localStorage.getItem(STORAGE_KEY);
                if (!raw) return; // 初回はそのまま（HTMLに書いた初期5件を使う）
                try {
                    const arr = JSON.parse(raw);
                    list.innerHTML = '';
                    arr.forEach(({
                        text,
                        done
                    }) => list.appendChild(makeItem(text, done)));
                } catch {
                    // 破損してたら無視
                }
            }

            // ---- 要素生成（現在のCSS/HTMLに合わせた構造で作る）----
            function makeItem(text, done = false) {
                const li = document.createElement('li');
                li.innerHTML = `
        <input type="checkbox" ${done ? 'checked' : ''}>
        <label></label>
        <button class="todo-del" aria-label="削除">×</button>`;
                li.querySelector('label').textContent = text;
                if (done) li.classList.add('is-done');
                return li;
            }

            // ---- 追加 ----
            function addTask() {
                const val = (input?.value || '').trim();
                if (!val) return;
                list.appendChild(makeItem(val));
                input.value = '';
                save();
            }

            // ---- 既存のliに .is-done を同期（リロード時の見た目を揃える）----
            function syncDoneClass() {
                list.querySelectorAll('li').forEach(li => {
                    const {
                        done
                    } = getItemState(li);
                    li.classList.toggle('is-done', done);
                });
            }

            // ---- クリック（削除＆完了切替）----
            list.addEventListener('click', (e) => {
                const li = e.target.closest('li');
                if (!li) return;

                if (e.target.matches('.todo-del')) {
                    li.remove();
                    save();
                } else if (e.target.matches('input[type="checkbox"]')) {
                    li.classList.toggle('is-done', e.target.checked);
                    save();
                }
            });

            // ---- イベント登録 ----
            addBtn?.addEventListener('click', addTask);
            input?.addEventListener('keydown', (e) => {
                if (e.key === 'Enter') addTask();
            });

            // ---- 初期化 ----
            syncDoneClass(); // 既存HTMLのチェック状態を反映
            load(); // 保存があれば復元（上書き）
        })();
    </script> --}}

    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const Calendar = tui.Calendar;
            const cal = new Calendar('#calendar', {
                defaultView: 'month',
                usageStatistics: false,
                isReadOnly: true,
                month: {
                    startDayOfWeek: 0,
                    isAlways6Weeks: true
                }
            });

            const labelEl = document.getElementById('calMonthLabel');

            function formatMonthLabel(date) {
                const y = date.getFullYear();
                const m = date.getMonth() + 1; // 1-12
                return `${y}年 ${m}月`; // ← 常にこの形式
            }

            function updateMonthLabel() {
                labelEl.textContent = formatMonthLabel(cal.getDate());
            }

            // ナビ
            document.getElementById('calPrev').onclick = () => {
                cal.prev();
                updateMonthLabel();
            };
            document.getElementById('calNext').onclick = () => {
                cal.next();
                updateMonthLabel();
            };
            document.getElementById('calToday').onclick = () => {
                cal.today();
                updateMonthLabel();
            };

            updateMonthLabel();
        });
    </script>

    <script>
        document.addEventListener('DOMContentLoaded', () => {
            // TUI Calendar
            const Calendar = tui.Calendar;
            const cal = new Calendar('#calendar', {
                defaultView: 'month',
                usageStatistics: false,
                isReadOnly: true, // クリック選択OFF（青枠出ない）
                month: {
                    startDayOfWeek: 0,
                    isAlways6Weeks: true
                },
                theme: {
                    common: {
                        saturday: {
                            color: '#237bff'
                        }
                    }
                }, // 土曜の色
                calendars: [{
                        id: 'school',
                        name: 'School',
                        backgroundColor: '#00a9ff'
                    },
                    {
                        id: 'personal',
                        name: 'Personal',
                        backgroundColor: '#03bd9e'
                    }
                ]
            });

            // 月ラベル固定フォーマット
            const labelEl = document.getElementById('calMonthLabel');
            const fmt = (d) => `${d.getFullYear()}年 ${d.getMonth() + 1}月`;
            const updateLabel = () => labelEl.textContent = fmt(cal.getDate());
            document.getElementById('calPrev').onclick = () => {
                cal.prev();
                updateLabel();
            };
            document.getElementById('calNext').onclick = () => {
                cal.next();
                updateLabel();
            };
            document.getElementById('calToday').onclick = () => {
                cal.today();
                updateLabel();
            };
            updateLabel();

            // ローカル保存で予定を保持
            const STORAGE_KEY = 'mypace_calendar_events_v1';
            const loadEvents = () => {
                try {
                    return JSON.parse(localStorage.getItem(STORAGE_KEY) || '[]');
                } catch {
                    return [];
                }
            };
            const saveEvents = (arr) => localStorage.setItem(STORAGE_KEY, JSON.stringify(arr));

            let events = loadEvents();
            if (events.length) cal.createEvents(events);

            // 予定追加フォーム
            const $ = (id) => document.getElementById(id);
            $('calForm').addEventListener('submit', () => {
                const title = ($('evtTitle').value || '').trim();
                const start = $('evtStart').value;
                const end = $('evtEnd').value;
                const allDay = $('evtAllDay').checked;
                if (!title || !start) return;

                const startISO = allDay ? `${start}T00:00:00` : `${start}T09:00:00`;
                const endDate = end || start;
                const endISO = allDay ? `${endDate}T23:59:59` : `${endDate}T10:00:00`;

                const evt = {
                    id: String(Date.now()),
                    calendarId: 'personal',
                    title,
                    category: allDay ? 'allday' : 'time',
                    start: startISO,
                    end: endISO
                };

                cal.createEvents([evt]);
                events.push(evt);
                saveEvents(events);

                // 軽くリセット
                $('evtTitle').value = '';
                $('evtEnd').value = '';
            });

            // 予定削除（任意）
            cal.on('clickEvent', ({
                event
            }) => {
                if (!event) return;
                const ok = confirm(`「${event.title}」を削除しますか？`);
                if (!ok) return;
                cal.deleteEvent(event.id, event.calendarId);
                events = events.filter(e => !(e.id === event.id && e.calendarId === event.calendarId));
                saveEvents(events);
            });
        });
    </script>

    <!-- TUI Calendar の JS（機能用） -->
    <script src="https://uicdn.toast.com/calendar/latest/toastui-calendar.min.js" defer></script>

    <!-- 自分のJS（TUIの後に実行する必要あり） -->
    <script src="/js/top.js" defer></script>

    <script>
        (function() {
            const btn = document.getElementById('avatarBtn');
            const menu = document.getElementById('avatarMenu');
            if (!btn || !menu) return;

            function openMenu() {
                menu.style.display = 'block';
                btn.setAttribute('aria-expanded', 'true');
            }

            function closeMenu() {
                menu.style.display = 'none';
                btn.setAttribute('aria-expanded', 'false');
            }

            function toggleMenu() {
                const isOpen = menu.style.display === 'block';
                isOpen ? closeMenu() : openMenu();
            }

            btn.addEventListener('click', (e) => {
                e.stopPropagation();
                toggleMenu();
            });

            document.addEventListener('click', (e) => {
                if (!menu.contains(e.target) && e.target !== btn) {
                    closeMenu();
                }
            });

            document.addEventListener('keydown', (e) => {
                if (e.key === 'Escape') closeMenu();
            });
        })();
    </script>
</body>

</html>
