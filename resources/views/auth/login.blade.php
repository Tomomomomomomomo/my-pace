<x-guest-layout>
    <style>
        body .container {
            position: relative;
            width: 300px;
            height: 440px;
            background-color: #add8e6;
            padding: 20px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            margin: 40px auto;
        }
        body .triangle {
            position: absolute;
            top: 0;
            left: 0;
            width: 0;
            height: 0;
            border-left: 40px solid transparent;
            border-right: 40px solid transparent;
            border-bottom: 40px solid red;
        }
        body .circle {
            position: absolute;
            width: 100px;
            height: 100px;
            border-radius: 50%;
        }
        body .top-right { top: -50px; right: -50px; background-color: #ccffcc; }
        body .bottom-left { bottom: -50px; left: -50px; background-color: #ffccff; }
        body .login-box { position: relative; z-index: 1; text-align: center; }
        body .login-box h1 {
            font-family: "Comic Sans MS", cursive, sans-serif;
            font-size: 36px;
            color: black;
            margin: 0;
        }
        body .login-box p {
            font-family: "Comic Sans MS", cursive, sans-serif;
            font-size: 18px;
            color: black;
            margin: 10px 0;
        }
        body .login-form { display: flex; flex-direction: column; align-items: center; }
        body .login-form label {
            font-family: "Comic Sans MS", cursive, sans-serif;
            font-size: 14px;
            color: black;
            margin: 10px 0 5px;
        }
        body .login-form input[type="email"],
        body .login-form input[type="password"] {
            width: 200px;
            padding: 10px;
            margin-bottom: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }
        body .login-actions { display: flex; gap: 8px; margin-top: 6px; }
        body .login-actions button,
        body .login-actions a.button-link {
            width: 100px;
            padding: 10px;
            border: none;
            border-radius: 5px;
            background-color: black;
            color: white;
            cursor: pointer;
            text-align: center;
            text-decoration: none;
            display: inline-block;
        }
        body .login-actions .secondary {
            background-color: white;
            color: black;
            border: 1px solid black;
        }
        body .helper-row { margin-top: 10px; display: flex; align-items: center; justify-content: space-between; gap: 12px; }
        body .helper-row label { display: inline-flex; align-items: center; gap: 6px; font-size: 12px; margin: 0; }
        body .helper-row a { font-size: 12px; text-decoration: underline; color: #374151; }
        body .error { color: #dc2626; font-size: 12px; margin-top: 4px; }
    </style>

    <div class="container">
        <div class="triangle"></div>
        <div class="circle top-right"></div>
        <div class="circle bottom-left"></div>
        <div class="login-box">
            <h1>My Pace</h1>
            <p>Welcome</p>
            <form class="login-form" method="POST" action="{{ route('login') }}">
                @csrf
                <label for="email">log in ID</label>
                <input type="email" id="email" name="email" value="{{ old('email') }}" required autocomplete="username" />
                @error('email')
                    <div class="error">{{ $message }}</div>
                @enderror

                <label for="password">password</label>
                <input type="password" id="password" name="password" required autocomplete="current-password" />
                @error('password')
                    <div class="error">{{ $message }}</div>
                @enderror

                <div class="helper-row">
                    <label for="remember_me">
                        <input id="remember_me" type="checkbox" name="remember" />
                        <span>{{ __('Remember me') }}</span>
                    </label>
                    @if (Route::has('password.request'))
                        <a href="{{ route('password.request') }}">{{ __('Forgot your password?') }}</a>
                    @endif
                </div>

                <div class="login-actions">
                    <button type="submit">sign in</button>
                    @if (Route::has('register'))
                        <a class="button-link secondary" href="{{ route('register') }}">sign up</a>
                    @endif
                </div>
            </form>
        </div>
    </div>
</x-guest-layout>
