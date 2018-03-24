<html>
<head>
</head>
<body>

<h3>{{$mailData["job"]->name}}</h3>

<p><strong>İsim Soyisim:</strong><br />{{$mailData["user"]->name}}</p>

<p><strong>Email:</strong><br />{{$mailData["user"]->email}}</p>

<p><strong>Telefon Numarası:</strong><br />{{$mailData["user"]->phoneNumber}}</p>

<p><strong>Kısa Özgeçmiş:</strong><br />{{$mailData["user"]->resume->body}}</p>

<p><strong>Eğitim:</strong><br />{{$mailData["user"]->resume->education}}</p>

<p><strong>Çalışma İzni:</strong><br />{{$mailData["user"]->resume->education}}</p>
</body>
</html>