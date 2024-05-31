<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Video Call</title>
    <link rel="stylesheet" href="./styles/style.css">
    <link href="css/style.css" rel="stylesheet">
      <link href="css/custom.css" rel="stylesheet">
    <script src="https://cdn.agora.io/sdk/release/AgoraRTCSDK-3.6.9.js"></script>
</head>
<body>
<div class="container-fluid">
	<div class="form-head d-flex mb-3 mb-md-5 align-items-center">
		<div style="background: #f2d5f8; width: 870%; padding: 15px 20px; border-radius: 0.75rem; color:#000;">
        	<span class="text-primary" style="margin-left: 43.5%; font-size: 1.5rem;"><b>Appointment Call</b></span>
		</div>
	</div>
	<div class="row">
		<div id="me" style="margin-left: 6%; flex: 1 0 33.3333333333%; max-width: 43.333333%;" class="col-xl-4 col-lg-8 col-sm-12 widget-stat card">
		</div>
        <div id="remote-container" style="margin-left: 2%; flex: 1 0 33.3333333333%; max-width: 43.333333%;" class="col-xl-4 col-lg-6 col-sm-3 widget-stat card">
		</div>
	</div>
    <button href="" onclick="history.go(-1);return false;" type="button" class="btn light btn-danger mt-2" style="margin-left: 46.5%;"><i class="fa fa-phone"></i><b> End Call</b></button>
</div>
    <script src="./scripts/script.js"></script>
</body>
</html>