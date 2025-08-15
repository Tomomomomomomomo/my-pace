<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Pace Login</title>
    <style>
        body {
            margin: 0;
            height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            background-color: #add8e6;
            font-family: Arial, sans-serif;
            position: relative;
        }

        .triangle {
            position: absolute;
            top: 0;
            left: 0;
            width: 0;
            height: 0;
            border-left: 50px solid transparent;
            border-right: 50px solid transparent;
            border-bottom: 50px solid red;
        }

        .circle.green {
            position: absolute;
            top: -50px;
            right: -50px;
            width: 100px;
            height: 100px;
            background-color: #90ee90;
            border-radius: 50%;
        }

        .circle.pink {
            position: absolute;
            bottom: -50px;
            left: -50px;
            width: 100px;
            height: 100px;
            background-color: #ffb6c1;
            border-radius: 50%;
        }

        .login-container {
            background-color: #add8e6;
            padding: 30px;
            width: 300px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.2);
            text-align: center;
            position: relative;
            z-index: 1;
        }

        .login-container h1 {
            font-size: 32px;
            margin-bottom: 10px;
            color: black;
        }

        .login-container p {
            font-size: 18px;
            margin-bottom: 20px;
            color: black;
        }

        .login-container input {
            width: 80%;
            padding: 10px;
            margin: 10px 0;
            border-radius: 5px;
            border: 1px solid #ccc;
        }

        .login-container button {
            width: 80%;
            padding: 10px;
            margin: 10px 0;
            border: none;
            border-radius: 5px;
            background-color: #333;
            color: white;
            cursor: pointer;
        }

        .login-container button:hover {
            background-color: #555;
        }
    </style>
</head>

<body>
    <div class="triangle"></div>
    <div class="circle green"></div>
    <div class="circle pink"></div>

    <div class="login-container">
        <h1>My Pace</h1>
        <p>Welcome</p>
        <input type="text" placeholder="log in ID">
        <input type="password" placeholder="password">
        <button>sign in</button>
        <button>sign up</button>
    </div>
</body>

</html>
