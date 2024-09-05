<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Item Data</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }
        .container {
            width: 90%;
            max-width: 1200px;
            margin: 20px auto;
            background: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
        }
        .button-container {
            margin-bottom: 20px;
            display: flex;
            gap: 10px;
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
            transition: background-color 0.3s;
        }
        .button-container button.blue {
            background-color: #007bff;
            color: #fff;
            border: none;
            padding: 10px 20px;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s;
        }
        .button-container button.yellow {
            background-color: yellow;
            color: #fff;
            border: none;
            padding: 10px 20px;
            border-radius: 5px;
            cursor: pointer;
            color: black;
            transition: background-color 0.3s;
        }
        .button-container button.red {
            background-color: red;
            color: #fff;
            border: none;
            padding: 10px 20px;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s;
        }
        .button-container button:hover {
            background-color: #0056b3;
        }
        form {
            margin-bottom: 20px;
            display: flex;
            flex-wrap: wrap;
            gap: 10px;
        }
        form input[type="search"], 
        form select, 
        form button {
            padding: 10px;
            border-radius: 5px;
            border: 1px solid #ddd;
            font-size: 16px;
        }
        form input[type="search"] {
            flex: 1;
            max-width: 300px;
        }
        form select {
            max-width: 150px;
        }
        form button {
            background-color: #007bff;
            color: #fff;
            border: none;
            cursor: pointer;
            transition: background-color 0.3s;
        }
        form button:hover {
            background-color: #0056b3;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }
        table, th, td {
            border: 1px solid #ddd;
        }
        th, td {
            padding: 12px;
            text-align: left;
        }
        th {
            background-color: #007bff;
            color: #fff;
        }
        tr:nth-child(even) {
            background-color: #f2f2f2;
        }
        tr:hover {
            background-color: #ddd;
        }
        @media (max-width: 768px) {
            table, th, td {
                display: block;
                width: 100%;
            }
            th, td {
                box-sizing: border-box;
                padding: 10px;
                text-align: right;
                position: relative;
            }
            th::before, td::before {
                content: attr(data-label);
                position: absolute;
                left: 0;
                width: 150px;
                padding-left: 10px;
                font-weight: bold;
                white-space: nowrap;
            }
            td::before {
                display: block;
                text-align: left;
                content: attr(data-label);
                position: absolute;
                left: 0;
                width: 150px;
                padding-left: 10px;
            }
            .bg-yellow {
                background-color: yellow;
            }
            .bg-red {
                background-color: #ff4d4d;
                color: white;
            }
            .bg-red:hover {
                background-color: #cc0000;
            }
        }
    </style>
</head>
<body>
    <?php use App\Http\Controllers\ItemController; ?>
    <div class="container">
        <div class="button-container">
            <a href="{{route('user.index')}}"><button>Back</button></a>
            <a href="{{route('item.create')}}"><button>Create</button></a>
        </div>

        <form method="get" action="{{Route('item.search')}}">
            <input type="search" name="search" placeholder="Search barcode or product name" autofocus>
            <label>Brand :</label>
            <select name="brand">
                <option>N/A</option>
                @foreach($brandname as $brand)
                    <option>{{$brand['brand']}}</option>
                @endforeach
            </select>
            <button type="submit">Search</button>
        </form>

        <table>
            <thead>
                <tr>
                    <th>No.</th>
                    <th>Code</th>
                    <th>Product Name</th>
                    <th>Brand Name</th>
                    <th>Stock</th>
                    <th>Unit</th>
                    <th>Price</th>
                    <th>Discount</th>
                    <th>Total</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
            <span class="run-function"></span>
            @foreach($items as $item)
                <tr>
                    <td>{{$i++}}</td>
                    <td data-label="Code">{{$item['code']}}</td>
                    <td data-label="Product Name">{{$item['name']}}</td>
                    <td data-label="Brand Name">{{$item['brand']}}</td>
                    <td data-label="Stock">{{$item['stock']}}</td>
                    <td data-label="Unit">{{ItemController::getUnitById($item->unitId)['name']}}</td>
                    <td data-label="Price">Rp.{{number_format($item['price'],2)}}</td>
                    <td data-label="Discount">{{$item['discount']}}%</td>
                    <td data-label="Total">Rp.{{number_format($item['total'],2)}}</td>
                    <td data-label="Action">
                        <div class="button-container">
                            <a href="{{Route('item.edit',$item['code'])}}"><button class="yellow">Edit</button></a>
                            <form method="post" action="{{route('item.delete',$item->id)}}">
                                @method('delete')
                                @csrf
                                <button type="submit" class="red">Delete</button>
                            </form>
                        </div>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
</body>
</html>
