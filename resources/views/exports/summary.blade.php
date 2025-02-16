<!DOCTYPE html>
<html>
<head>
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
        }
        th, td {
            border: 1px solid black;
            padding: 8px;
            text-align: left;
        }
        th {
            background-color: #f2f2f2;
        }
    </style>
</head>
<body>
    <table>
        <thead>
            <tr>
                <th>INGREDIENT NAME</th>
                <th>START AMOUNT</th>
                <th>PURCHASE AMOUNT</th>
                <th>USAGE AMOUNT</th>
                <th>ADJUSTMENT AMOUNT</th>
                <th>END AMOUNT</th>
                <th>METRIC UNIT</th>
            </tr>
        </thead>
        <tbody>
            @foreach($summary as $item)
                <tr>
                    <td>{{ $item->INGREDIENT_NAME }}</td>
                    <td>{{ $item->START_AMT }}</td>
                    <td>{{ $item->PURCHASE_AMT }}</td>
                    <td>{{ $item->USAGE_AMT }}</td>
                    <td>{{ $item->ADJUSTMENT_AMT }}</td>
                    <td>{{ $item->END_AMT }}</td>
                    <td>{{ $item->METRIC_UNIT }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
