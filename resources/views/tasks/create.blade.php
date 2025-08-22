@extends('layouts.app')

@section('content')
    <div class="container">
        <style>
            .container {
                max-width: 420px;
                margin: 50px auto;
                padding: 30px;
                background-color: #add4f4;
                border: 1px solid #000;
                border-radius: 5px;
                box-shadow: 0 0 10px rgba(0, 0, 0, .1);
            }

            h1 {
                text-align: center;
                font-size: 1.6em;
                margin-bottom: 20px;
                color: #1e3a8a;
            }

            .form-group {
                margin-bottom: 20px;
            }

            label {
                display: block;
                margin-bottom: 6px;
                font-weight: bold;
                color: #1e3a8a;
            }

            input[type="text"],
            input[type="date"],
            textarea {
                width: 100%;
                padding: 10px;
                border: 1px solid #000;
                border-radius: 5px;
                box-sizing: border-box;
            }

            textarea {
                height: 100px;
                resize: vertical;
            }

            .datepicker-button {
                background: transparent;
                border: none;
                cursor: pointer;
                font-size: 1.4em;
                margin-top: 4px;
            }

            .post-button {
                display: block;
                width: 100%;
                padding: 12px;
                background-color: #3b82f6;
                color: #fff;
                border: none;
                border-radius: 5px;
                cursor: pointer;
                font-size: 1em;
            }

            .post-button:hover {
                background-color: #2563eb;
            }
        </style>

        <h1>タスク作成</h1>
        <form method="POST" action="{{ route('tasks.store') }}">
            @csrf
            <div class="form-group">
                <label for="title">タイトル</label>
                <input type="text" id="title" name="title" value="{{ old('title') }}" required>
            </div>
            <div class="form-group">
                <label for="content">内容</label>
                <textarea id="content" name="content">{{ old('content') }}</textarea>
            </div>
            <div class="form-group">
                <label for="datepicker">日付</label>
                <div style="display:flex; gap:6px; align-items:center;">
                    <input type="date" id="datepicker" name="datepicker" value="{{ old('datepicker') }}" required>
                    <button type="button" class="datepicker-button" id="openDate">📅</button>
                </div>
            </div>
            <button type="submit" class="post-button">保存</button>
        </form>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const btn = document.getElementById('openDate');
            const input = document.getElementById('datepicker');
            if (btn && input) {
                btn.addEventListener('click', () => {
                    if (input.showPicker) {
                        input.showPicker();
                    } else {
                        input.focus();
                    }
                });
            }
        });
    </script>
@endsection
