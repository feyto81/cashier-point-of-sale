<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>QR-Code Product {{$data->barcode}}</title>
	
</head>
<body>
    
    <img src="uploads/qr-code/item-<?=$data->barcode?>.png" style="width: 140px;">
    <br>
    <p style="margin-left: 30px">{{$data->barcode}}</p>
    
</body>
</html>