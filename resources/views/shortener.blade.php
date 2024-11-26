<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>URL Shortener</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Arial', sans-serif;
            background: linear-gradient(135deg, #ff9a9e 0%, #fad0c4 99%, #fad0c4 100%);
            background-size: 400% 400%;
            animation: gradientAnimation 15s ease infinite;
            color: #333;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            text-align: center;
        }

        @keyframes gradientAnimation {
            0% { background-position: 0% 50%; }
            50% { background-position: 100% 50%; }
            100% { background-position: 0% 50%; }
        }

        .container {
            background: #ffffff;
            padding: 2rem;
            border-radius: 10px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
            width: 90%;
            max-width: 400px;
        }

        h1 {
            font-size: 2rem;
            margin-bottom: 1rem;
            color: #ff6f61;
        }

        label {
            display: block;
            font-size: 1rem;
            margin-bottom: 0.5rem;
            font-weight: bold;
        }

        input[type="text"] {
            width: 100%;
            padding: 0.5rem;
            font-size: 1rem;
            border: 1px solid #ddd;
            border-radius: 5px;
            margin-bottom: 1rem;
            outline: none;
            transition: border-color 0.3s ease;
        }

        input[type="text"]:focus {
            border-color: #ff6f61;
        }

        button {
            padding: 0.7rem 1.5rem;
            font-size: 1rem;
            color: #fff;
            background: #ff6f61;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            transition: background 0.3s ease;
        }

        button:hover {
            background: #e05c50;
        }

        .short-url {
            margin-top: 1.5rem;
        }

        .short-url a {
            color: #ff6f61;
            font-weight: bold;
            text-decoration: none;
        }

        .short-url a:hover {
            text-decoration: underline;
        }

        .errors {
            margin-top: 1rem;
            color: #e05c50;
        }

        .errors ul {
            list-style: none;
            padding-left: 0;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>URL Shortener</h1>
        <form method="POST" action="{{ route('shorten') }}">
            @csrf
            <label for="long_url">Enter a URL to shorten:</label>
            <input type="text" name="long_url" id="long_url" placeholder="https://example.com" required>
            <button type="submit">Shorten</button>
        </form>

        @if (session('short_url'))
            <div class="short-url">
                <p>Short URL: <a href="{{ session('short_url') }}" target="_blank">{{ session('short_url') }}</a></p>
            </div>
        @endif

        @if ($errors->any())
            <div class="errors">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
    </div>
</body>
</html>
