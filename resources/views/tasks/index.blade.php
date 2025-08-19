@extends('layouts.app')
@section('content')
    <!-- メインコンテンツ -->
    <main class="main-container">
        <!-- To Do リスト -->
        <section class="todo-area">
            <!-- 左カラム：ToDo -->
            <div class="todo">
                <img class="tag-img" src="/public/assets/img/todo_design_tag.png" alt="tag">
                <div class="todo-head">
                    <h2>To Do list</h2>
                </div>

                <ul id="todo-list">
                    @forelse ($tasks as $task)
                        <li>
                            <input type="checkbox">
                            <label>{{ $task->title }}</label>
                            <form action="{{ route('tasks.destroy', $task) }}" method="POST" style="display:inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="todo-del" onclick="return confirm('このタスクを削除しますか？')">×</button>
                            </form>
                        </li>
                    @empty
                        <li class="todo-empty">タスクがありません</li>
                    @endforelse
                </ul>

                <!-- 追加フォーム（ToDo用） -->
                <div class="todo-form">
                    <button id="add-task" class="btn"
                        onclick="window.location.href='{{ route('tasks.create') }}'">追加</button>
                </div>
            </div>

            <!-- 右カラム：ツールバー＋フォーム＋カレンダー -->
            <div class="calendar-col">
                <div class="cal-toolbar">
                    <button id="calPrev">◀︎</button>
                    <h3 id="calMonthLabel"></h3>
                    <button id="calNext">▶︎</button>
                    <button id="calToday">Today</button>
                </div>

                <form id="calForm" class="cal-form">
                    <input type="text" id="evtTitle" placeholder="予定タイトル">
                    <input type="date" id="evtStart">
                    <input type="date" id="evtEnd">
                    <label><input type="checkbox" id="evtAllDay"> 終日</label>
                    <button type="submit" id="evtAddBtn">追加</button>
                </form>

                <div id="calendar"></div>
            </div>
        </section>

        <!-- School time & Project -->
        <section class="projects">
            <h2 class="projects-title">School time & Project</h2>

            <div class="days">
                <!-- ★ 1日ぶんのカード（必要なら複製して使う） -->
                <article class="day">
                    <header class="day-head">
                        <span class="day-label">Mon.</span>
                    </header>

                    <div class="day-photo">
                        <input id="mondayFile" type="file" accept="image/*" class="file-input"
                            onchange="previewImage(event, 'mondayPreview')">
                        <img id="mondayPreview" alt="">
                    </div>

                    <div class="timetable">
                        <div class="tt-time">1限</div><input class="tt-subject" type="text" placeholder="科目">
                        <div class="tt-time">2限</div><input class="tt-subject" type="text" placeholder="科目">
                        <div class="tt-time">3限</div><input class="tt-subject" type="text" placeholder="科目">
                        <div class="tt-time">4限</div><input class="tt-subject" type="text" placeholder="科目">
                        <div class="tt-time">5限</div><input class="tt-subject" type="text" placeholder="科目">
                        <div class="tt-time">6限</div><input class="tt-subject" type="text" placeholder="科目">
                    </div>

                    <textarea class="note" placeholder="課題・持ち物メモ"></textarea>
                </article>

                <!-- Tue -->
                <article class="day">
                    <header class="day-head"><span class="day-label">Tue.</span></header>
                    <div class="day-photo">
                        <input id="tuesdayFile" type="file" accept="image/*" class="file-input"
                            onchange="previewImage(event, 'tuesdayPreview')">
                        <img id="tuesdayPreview" alt="">
                    </div>
                    <div class="timetable">
                        <div class="tt-time">1限</div><input class="tt-subject" type="text" placeholder="科目">
                        <div class="tt-time">2限</div><input class="tt-subject" type="text" placeholder="科目">
                        <div class="tt-time">3限</div><input class="tt-subject" type="text" placeholder="科目">
                        <div class="tt-time">4限</div><input class="tt-subject" type="text" placeholder="科目">
                        <div class="tt-time">5限</div><input class="tt-subject" type="text" placeholder="科目">
                        <div class="tt-time">6限</div><input class="tt-subject" type="text" placeholder="科目">
                    </div>
                    <textarea class="note" placeholder="課題・持ち物メモ"></textarea>
                </article>

                <!-- Wed -->
                <article class="day">
                    <header class="day-head"><span class="day-label">Wed.</span></header>
                    <div class="day-photo">
                        <input id="wednesdayFile" type="file" accept="image/*" class="file-input"
                            onchange="previewImage(event, 'wednesdayPreview')">
                        <img id="wednesdayPreview" alt="">
                    </div>
                    <div class="timetable">
                        <div class="tt-time">1限</div><input class="tt-subject" type="text" placeholder="科目">
                        <div class="tt-time">2限</div><input class="tt-subject" type="text" placeholder="科目">
                        <div class="tt-time">3限</div><input class="tt-subject" type="text" placeholder="科目">
                        <div class="tt-time">4限</div><input class="tt-subject" type="text" placeholder="科目">
                        <div class="tt-time">5限</div><input class="tt-subject" type="text" placeholder="科目">
                        <div class="tt-time">6限</div><input class="tt-subject" type="text" placeholder="科目">
                    </div>
                    <textarea class="note" placeholder="課題・持ち物メモ"></textarea>
                </article>

                <!-- Thu -->
                <article class="day">
                    <header class="day-head"><span class="day-label">Thu.</span></header>
                    <div class="day-photo">
                        <input id="thursdayFile" type="file" accept="image/*" class="file-input"
                            onchange="previewImage(event, 'thursdayPreview')">
                        <img id="thursdayPreview" alt="">
                    </div>
                    <div class="timetable">
                        <div class="tt-time">1限</div><input class="tt-subject" type="text" placeholder="科目">
                        <div class="tt-time">2限</div><input class="tt-subject" type="text" placeholder="科目">
                        <div class="tt-time">3限</div><input class="tt-subject" type="text" placeholder="科目">
                        <div class="tt-time">4限</div><input class="tt-subject" type="text" placeholder="科目">
                        <div class="tt-time">5限</div><input class="tt-subject" type="text" placeholder="科目">
                        <div class="tt-time">6限</div><input class="tt-subject" type="text" placeholder="科目">
                    </div>
                    <textarea class="note" placeholder="課題・持ち物メモ"></textarea>
                </article>

                <!-- Fri -->
                <article class="day">
                    <header class="day-head"><span class="day-label">Fri.</span></header>
                    <div class="day-photo">
                        <input id="fridayFile" type="file" accept="image/*" class="file-input"
                            onchange="previewImage(event, 'fridayPreview')">
                        <img id="fridayPreview" alt="">
                    </div>
                    <div class="timetable">
                        <div class="tt-time">1限</div><input class="tt-subject" type="text" placeholder="科目">
                        <div class="tt-time">2限</div><input class="tt-subject" type="text" placeholder="科目">
                        <div class="tt-time">3限</div><input class="tt-subject" type="text" placeholder="科目">
                        <div class="tt-time">4限</div><input class="tt-subject" type="text" placeholder="科目">
                        <div class="tt-time">5限</div><input class="tt-subject" type="text" placeholder="科目">
                        <div class="tt-time">6限</div><input class="tt-subject" type="text" placeholder="科目">
                    </div>
                    <textarea class="note" placeholder="課題・持ち物メモ"></textarea>
                </article>
            </div>
        </section>
    </main>
@endsection
