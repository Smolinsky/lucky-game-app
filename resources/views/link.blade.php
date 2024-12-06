<!DOCTYPE html>
<html lang="uk">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Link Details</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f7f6;
            color: #333;
            margin: 0;
            padding: 0;
        }
        .container {
            width: 80%;
            margin: 0 auto;
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
            margin-top: 30px;
        }
        h1 {
            color: #0056b3;
            text-align: center;
        }
        .form-container {
            display: flex;
            justify-content: space-between;
            margin-bottom: 20px;
        }
        form {
            display: inline-block;
            background-color: #f1f1f1;
            border-radius: 5px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
            transition: 0.3s;
        }
        form:hover {
            background-color: #e0e0e0;
        }
        button {
            background-color: #0056b3;
            color: #fff;
            border: none;
            padding: 10px 20px;
            border-radius: 5px;
            cursor: pointer;
            font-size: 16px;
            transition: 0.3s;
        }
        button:hover {
            background-color: #004080;
        }
        .info {
            margin-bottom: 20px;
        }
        .info p {
            font-size: 16px;
            margin: 5px 0;
        }
        .history {
            margin-top: 30px;
            padding: 10px 0;
            border-radius: 5px;
        }
        .history h3 {
            font-size: 18px;
            color: #333;
        }
        .history ul {
            list-style: none;
            padding: 0;
        }
        .history li {
            background-color: #f1f1f1;
            margin-bottom: 10px;
            padding: 10px;
            border-radius: 5px;
        }
        .history li p {
            margin: 5px 0;
        }
        .history li:last-child {
            margin-bottom: 0;
        }
    </style>
</head>
<body>
<div class="container">
    <h1>Link Details</h1>

    <!-- Link info -->
    <div class="info">
        <p><strong>Username:</strong> {{ $link->user->name }}</p>
        <p><strong>Phone:</strong> {{ $link->user->phone }}</p>
        <p><strong>Unique Link:</strong> {{ route('link.show', $link->unique_link) }}</p>
        <p><strong>Expires At:</strong> {{ $link->expires_at }}</p>
    </div>

    <!-- Regenerate and Deactivate buttons -->
    <div class="form-container">
        <form method="POST" action="/link/{{ $link->unique_link }}/regenerate">
            @csrf
            <button type="submit">Regenerate</button>
        </form>
        <form method="POST" action="/link/{{ $link->unique_link }}/deactivate">
            @csrf
            <button type="submit">Deactivate</button>
        </form>
    </div>

    <!-- Imfeelinglucky button -->
    <div class="form-container">
        <form method="POST" action="{{ route('game.play', ['user' => $link->user_id]) }}">
            @csrf
            <button type="submit">Imfeelinglucky</button>
        </form>
    </div>

    @if(isset($number))
        <div class="info">
            <p><strong>Random Number:</strong> {{ $number }}</p>
            <p><strong>Result:</strong> {{ $result }}</p>
            <p><strong>Win Amount:</strong> ${{ number_format($amount, 2) }}</p>
        </div>
    @endif

    <!-- History button -->
    <div class="form-container">
        <form method="GET" action="{{ route('game.history', ['user' => $link->user_id]) }}">
            <button type="submit">History</button>
        </form>
    </div>

    @if(isset($history) && $history->count() > 0)
        <div class="history">
            <h3>Game History</h3>
            <ul>
                @foreach($history as $game)
                    <li>
                        <p><strong>Game Date:</strong> {{ $game->created_at }}</p>
                        <p><strong>Random Number:</strong> {{ $game->random_number }}</p>
                        <p><strong>Result:</strong> {{ $game->result }}</p>
                        <p><strong>Win Amount:</strong> ${{ number_format($game->win_amount, 2) }}</p>
                    </li>
                @endforeach
            </ul>
        </div>
    @else
    @endif
</div>
</body>
</html>
