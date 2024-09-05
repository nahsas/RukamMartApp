<!DOCTYPE html>
<html lang="en">
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
            width: 90%;
            max-width: 600px;
        }
        .container h1 {
            margin-top: 0;
            color: #333;
        }
        .error {
            color: red;
            margin-bottom: 20px;
        }
        .form-group {
            margin-bottom: 15px;
            display: flex;
            align-items: center;
        }
        .form-group label {
            width: 150px;
            font-weight: bold;
            text-align: right;
            margin-right: 10px;
        }
        .form-group input, .form-group select {
            width: calc(100% - 170px);
            padding: 10px;
            border: 1px solid #ddd;
            border-radius: 5px;
            box-sizing: border-box;
        }
        .form-group input[readonly] {
            background-color: #f9f9f9;
        }
        .form-group input:focus, .form-group select:focus {
            border-color: #007bff;
            outline: none;
        }
        .form-group .price-label {
            font-weight: normal;
        }
        .total-price {
            font-weight: bold;
            color: #007bff;
        }
        .button-container {
            display: flex;
            justify-content: flex-end;
            gap: 10px;
            margin-top: 20px;
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
        .cancel-button {
            background-color: #6c757d;
        }
        .cancel-button:hover {
            background-color: #5a6268;
        }
    </style>
</head>
<body>
    <div class="container">
        @if($errors->any())
            <div class="error">
                @foreach($errors->all() as $error)
                    <p><b>{{$error}}</b></p>
                @endforeach
            </div>
        @endif

        <span style="color: gray; display: block; text-align: right;">Date: {{$datenow}}</span>

        <form method="POST" action="{{route('item.store')}}">
            @csrf
            <div class="form-group">
                <label for="barcode">Item code</label>
                <input type="text" id="barcode" name="barcode" value="{{$barcode}}" readonly>
            </div>
            <div class="form-group">
                <label for="itemName">Item name</label>
                <input type="text" id="itemName" name="itemName" placeholder="Ex: Javana Tea">
            </div>
            <div class="form-group">
                <label for="brand">Brand</label>
                <input type="text" id="brand" name="brand" placeholder="Ex: Indofood">
            </div>
            <div class="form-group">
                <label for="stock">Stock</label>
                <input type="number" id="stock" name="stock" placeholder="Ex: 5" onchange="calculate()">
            </div>
            <div class="form-group">
                <label for="unit">Unit</label>
                <select id="unit" name="unit">
                    @foreach($units as $unit)
                        <option>{{$unit->name}}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <label for="price">Price</label>
                <input type="number" id="price" name="price" placeholder="Ex: 4000" onchange="calculate()">
            </div>
            <div class="form-group">
                <label for="discount">Discount</label>
                <input type="number" id="discount" name="discount" placeholder="Ex: 20" onchange="calculate()">
            </div>
            <div class="form-group">
                <label>Total</label>
                <span id="totalprice" class="total-price">Rp.0</span>
            </div>
            <div class="button-container">
                <button type="submit">Save</button>
                <a href="{{route('item.create')}}"><button type="button" class="cancel-button">Cancel</button></a>
            </div>
        </form>
    </div>
    <script type="text/javascript">
        function calculate() {
            const totalPriceElem = document.getElementById('totalprice');
            const stock = document.getElementById('stock').value || 0;
            const price = document.getElementById('price').value || 0;
            const discount = document.getElementById('discount').value || 0;

            const total = stock * price * (1 - discount / 100);
            totalPriceElem.innerHTML = `Rp.${total.toFixed(2)}`;
        }
    </script>
</body>
</html>
