<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Scan Barcode</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
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
            width: 90%;
            max-width: 400px;
        }
        .container h1 {
            margin: 0 0 20px;
            color: #333;
        }
        .button-container {
            margin-bottom: 20px;
        }
        .button-container a {
            text-decoration: none;
        }
        .button-container button {
            background-color: #007bff;
            color: #fff;
            border: none;
            padding: 10px 20px;
            border-radius: 5px;
            cursor: pointer;
            font-size: 16px;
            transition: background-color 0.3s;
        }
        .button-container button:hover {
            background-color: #0056b3;
        }
        form {
            margin-top: 20px;
        }
        input[type="text"] {
            width: calc(100% - 22px);
            padding: 10px;
            border: 1px solid #ddd;
            border-radius: 5px;
            font-size: 16px;
            box-sizing: border-box;
        }
        input[type="text"]:focus {
            border-color: #007bff;
            outline: none;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Please scan the barcode</h1>
        <form action="{{route('item.add')}}" method="GET">
            @csrf
            <input type="text" id="barcode" name="barcode" autofocus placeholder="Enter barcode here...">
        </form>
        <div style="color:red;padding: 10px;">{{$error_text}}</div>
		<div class="button-container">
            <a href="{{route('item.index')}}"><button>Back</button></a>
        </div>
    </div>
</body>
</html>

</html>