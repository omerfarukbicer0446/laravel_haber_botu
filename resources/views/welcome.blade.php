<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet">
    <title>Haber Botu</title>
</head>
<body class="m-5">
    <div class="card mb-5">
        <div class="card-body">
            <h4 class="m-2">
                Sağlayıcı: <a href="https://t.me/keyiflerolsun">@keyiflerolsun</a><br>
                Kodlayan: <a href="https://t.me/omerfarukbicer">@omerfarukbicer</a>
            </h4>
        </div>
    </div>
    <div class="row row-cols-1 row-cols-md-2 g-4" id="news"></div>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script>
    $(document).ready(function(){
		$.ajax({
			type: "POST",
			url: "/news",
            data: "_token={{csrf_token()}}",
			beforeSend: function(){
				$("#news").html('<h4>Yükleniyor...</h4>')
			},
			success: function(response) {
				$("#news").html(response)
			}
		})
	})
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>