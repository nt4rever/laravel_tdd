<html>

<head>
    <style>
        body {
            font-family: "notosansjp", sans-serif;
            font-size: 10px;
        }

        @page {
            size: 21cm 29.7cm;
            margin: 10mm;
        }

        table,
        th,
        td {
            border: 1px solid black;
            border-collapse: collapse;
        }
    </style>
</head>

<body>
    <h2>Collapsed Borders</h2>
    <p>重調＠CITY同様、角印を追加できるようにする。
    </p>

    <table style="width:100%">
        <tr>
            <th>Firstname</th>
            <th>Lastname</th>
            <th>Age</th>
        </tr>
        <tr>
            <td>Jill</td>
            <td>Smith</td>
            <td>50</td>
        </tr>
        <tr>
            <td>Eve</td>
            <td>Jackson</td>
            <td>94</td>
        </tr>
        <tr>
            <td>John</td>
            <td>Doe</td>
            <td>80</td>
        </tr>
    </table>
    <script type="text/php">
        if (isset($pdf)) {
            $x = 280;
            $y = 810;
            $text = "{PAGE_NUM} / {PAGE_COUNT}";
            $font = null;
            $size = 10;
            $color = array(0,0,0);
            $word_space = 0.0;
            $char_space = 0.0;
            $angle = 0.0;
            $pdf->page_text($x, $y, $text, $font, $size, $color, $word_space, $char_space, $angle);
        }
    </script>
</body>

</html>
