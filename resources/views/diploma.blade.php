<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>

</head>
<body>
    <style>
        body{
            background-image: url(https://previews.123rf.com/images/vantuz/vantuz1905/vantuz190500009/122695287-dise%C3%B1o-de-plantilla-de-certificado-o-diploma-con-sello-y-marca-de-agua-ilustraci%C3%B3n-vectorial.jpg);
            background-position: center;
            background-repeat: no-repeat;
            background-size: cover;
        }
        h1{
            text-align: center;
            position: relative;
            top: 48%;
        }
        p{
            position: relative;
            top: 74%;
            left: 21%;
        }
    </style>
    <h1>{{$nombre}}</h1>
    <p><b>{{$fecha}}</b></p>
    {{-- <h1>{{$data['nombre']}}</h1>
    <p>{{$data['fecha']}}</p> --}}
</body>
</html>