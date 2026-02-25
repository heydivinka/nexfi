<!DOCTYPE html>
<html>
<head>
    <title>Profile Nexfi</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <style>
        body{
            font-family:Arial, sans-serif;
            background:#0f172a;
            color:white;
            margin:0;
            padding:0;
        }

        .container{
            max-width:500px;
            margin:auto;
            padding:30px 20px;
            text-align:center;
        }

        .card{
            background:#111827;
            border-radius:16px;
            padding:25px;
        }

        .btn{
            display:inline-block;
            padding:10px 15px;
            border-radius:8px;
            background:#6366f1;
            color:white;
            text-decoration:none;
            margin-top:15px;
        }
    </style>

</head>
<body>

<div class="container">
    @yield('content')
</div>

</body>
</html>