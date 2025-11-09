<html>
<title>QR Code - {{ $vehicle->fldYear }} {{ $vehicle->fldMake }} {{ $vehicle->fldModel }} {{ $vehicle->fldModelNo }}</title>
<head>
<link rel="stylesheet" href="http://stricklands.com/client/css/bootstrap.min.css" type="text/css">
<link rel="stylesheet" href="http://stricklands.com/client/css/style.css" type="text/css">
<link rel="stylesheet" href="http://stricklands.com/client/css/custom.css" type="text/css">
    <style>
        body {
            font-family : 'Ubuntu', sans-serif!important;
        }
    </style>
</head>
<body>
    @php 
        if($vehicle->vehicle_sm) {
            $url = $vehicle->vehicle_sm->external_url;
        }
        else{
            $url = "https://www.stricklands.com/vehicle/{{ $vehicle->url }}";
        }
    @endphp
    <div style="width: 500px; margin: 0 auto; padding-top: 20px;text-align: center;">
        <!--<img src="https://chart.googleapis.com/chart?cht=qr&choe=ISO-8859-1&chs=500&chl={{$url}}">-->
        <img src="https://quickchart.io/chart?cht=qr&choe=ISO-8859-1&chs=400&chl={{$url}}">
        <p style="font-weight: bold;margin-top: -30px; margin-bottom:5px;font-size: 24px">Stock # {{ $vehicle->fldStockNo }}</p>
        <p style="font-weight: bold;margin-top: 0;font-size: 22px">{{ $vehicle->fldYear }} {{ $vehicle->fldMake }} {{ $vehicle->fldModel }}</p>
        <img style="max-width: 325px;" src="https://admin.stricklands.com/upload/Stricklands_Black.png">
    </div>
</body>
</html>
