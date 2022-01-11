<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
    <title>@yield('title')</title>
    <style type="text/css">
        * {
            font-family: Verdana, Arial, sans-serif;
        }
        table{
            margin-left:2em
            font-size: x-small;
        }
        tfoot tr td{
            font-weight: bold;
            font-size: x-small;
        }
        .gray {
            background-color: lightgray
        }

        h1 { 
            text-align:center
        }

        .alignMe b {
          display: inline-block;
          width: 20%;
          position: relative;
          padding-right: 5px; /* Ensures colon does not overlay the text */
        }

        .alignMe b::after {
          content: ":";
          position: absolute;
          right: 5px;
        }

        .data_mahasiswa { 
            margin: 2em; 
        }

        .tanggal { 
            text-align:right;
            margin: 2em;
        }

    </style>
</head>

<body>
    @yield('header')
    @yield('content')
    @yield('footer')
</body>

</html>
