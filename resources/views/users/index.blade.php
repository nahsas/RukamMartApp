<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Dashboard</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f0f2f5;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }
        .container {
            background-color: #fff;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 0 15px rgba(0, 0, 0, 0.1);
            text-align: center;
            width: 80%;
            max-width: 600px;
        }
        h4 {
            color: #555;
            margin-bottom: 10px;
        }
        h2 {
            color: #333;
            margin: 0 0 20px;
        }
        .button-container {
            display: flex;
            justify-content: center;
            gap: 20px;
        }
        .button-container a {
            text-decoration: none;
        }
        .button-container button.blue {
            background-color: #007bff;
            color: #fff;
            border: none;
            padding: 15px 25px;
            border-radius: 5px;
            cursor: pointer;
            font-size: 16px;
            transition: background-color 0.3s, transform 0.2s;
        }
        .button-container button.red {
            background-color: #FF0000;
            color: #fff;
            border: none;
            padding: 15px 25px;
            border-radius: 5px;
            cursor: pointer;
            font-size: 16px;
            transition: background-color 0.3s, transform 0.2s;
        }

        .button-container button:hover {
            background-color: #0056b3;
            transform: translateY(-2px);
        }
        .button-container button:active {
            transform: translateY(0);
        }
    </style>
</head>
<body>
    <div class="container">
        <h4>Welcome</h4>
        <h2>{{session('fullname')}}</h2>
        <div class="button-container">
            <a href="{{route('item.index')}}"><button class="blue">Item Stock</button></a>
            <a href="{{route('transaction.index')}}"><button class="blue">Start Transaction</button></a>
            <a href="{{route('user.logout')}}"><button class="red">Logout</button></a>
        </div>
    </div>
</body>
</html>
