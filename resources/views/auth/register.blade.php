<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <title>My Pace Sign Up</title>
        <style>
            body {
                font-family: Arial, sans-serif;
                background-color: #f0f0f0;
                display: flex;
                justify-content: center;
                align-items: center;
                height: 100vh;
                margin: 0;
            }

            .container {
                position: relative;
                width: 400px;
                padding: 20px;
                background-color: #add8e6;
                border-radius: 10px;
                box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            }

            .form-container {
                text-align: center;
            }

            h1 {
                font-size: 36px;
                font-family: "Comic Sans MS", cursive, sans-serif;
                margin-bottom: 10px;
            }

            h2 {
                font-size: 24px;
                margin-bottom: 20px;
            }

            form {
                display: flex;
                flex-direction: column;
                align-items: center;
            }

            label {
                font-size: 18px;
                margin-bottom: 5px;
            }

            input {
                width: 80%;
                padding: 10px;
                margin-bottom: 15px;
                border: 1px solid #ccc;
                border-radius: 5px;
            }

            button {
                width: 80%;
                padding: 10px;
                background-color: #000;
                color: #fff;
                border: none;
                border-radius: 5px;
                cursor: pointer;
            }

            button:hover {
                background-color: #444;
            }

            /* 赤い三角形 */
            .container::before {
                content: "";
                position: absolute;
                top: 10px;
                left: 10px;
                width: 0;
                height: 0;
                border-left: 50px solid transparent;
                border-right: 50px solid transparent;
                border-bottom: 50px solid #ff6347;
            }

            /* 緑の円（右上） */
            .container::after {
                content: "";
                position: absolute;
                top: -50px;
                right: -50px;
                width: 100px;
                height: 100px;
                background-color: #90ee90;
                border-radius: 50%;
                z-index: 1;
            }

            /* ピンクの円（左下） */
            .container .circle {
                position: absolute;
                bottom: -50px;
                left: -50px;
                width: 100px;
                height: 100px;
                background-color: #ffb6c1;
                border-radius: 50%;
                z-index: 1;
            }
        </style>
    </head>
    <body>
        <div class="container">
            <div class="form-container">
                <h1>My Pace</h1>
                <h2>sign up</h2>
                <form method="POST" action="{{ route('register') }}">
                    @csrf
                    <!-- Name -->
                    <div>
                        <x-input-label for="name" :value="__('Name')" />
                        <x-text-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" />
                        <x-input-error :messages="$errors->get('name')" class="mt-2" />
                    </div>
                    <!-- Email Address -->
                    <div class="mt-4">
                        <x-input-label for="email" :value="__('Email')" />
                        <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autocomplete="username" />
                        <x-input-error :messages="$errors->get('email')" class="mt-2" />
                    </div>
                    <!-- Password -->
                    <div class="mt-4">
                        <x-input-label for="password" :value="__('Password')" />
                        <x-text-input id="password" class="block mt-1 w-full" type="password" name="password" required autocomplete="new-password" />
                        <x-input-error :messages="$errors->get('password')" class="mt-2" />
                    </div>
                    <!-- Confirm Password -->
                    <div class="mt-4">
                        <x-input-label for="password_confirmation" :value="__('Confirm Password')" />
                        <x-text-input id="password_confirmation" class="block mt-1 w-full" type="password" name="password_confirmation" required autocomplete="new-password" />
                        <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
                    </div>
                    <div class="flex items-center justify-end mt-4">
                        <a class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500" href="{{ route('login') }}">
                            {{ __('Already registered?') }}
                        </a>
                        <x-primary-button class="ms-4">
                            {{ __('Register') }}
                        </x-primary-button>
                    </div>
                </form>
            </div>
            <div class="circle"></div>
        </div>
    </body>
</html>
