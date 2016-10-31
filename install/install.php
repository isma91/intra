<?php
$configFile = include('config.php');
if (!empty($configFile) || !empty($configFile['install'])) {
	header('Location: ./../');
}
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="description" content="Create your intra !!" />
	<title>intra intallation</title>
	<link rel="apple-touch-icon" sizes="57x57" href="../media/img/apple-icon-57x57.png">
	<link rel="apple-touch-icon" sizes="60x60" href="../media/img/apple-icon-60x60.png">
	<link rel="apple-touch-icon" sizes="72x72" href="../media/img/apple-icon-72x72.png">
	<link rel="apple-touch-icon" sizes="76x76" href="../media/img/apple-icon-76x76.png">
	<link rel="apple-touch-icon" sizes="114x114" href="../media/img/apple-icon-114x114.png">
	<link rel="apple-touch-icon" sizes="120x120" href="../media/img/apple-icon-120x120.png">
	<link rel="apple-touch-icon" sizes="144x144" href="../media/img/apple-icon-144x144.png">
	<link rel="apple-touch-icon" sizes="152x152" href="../media/img/apple-icon-152x152.png">
	<link rel="apple-touch-icon" sizes="180x180" href="../media/img/apple-icon-180x180.png">
	<link rel="icon" type="image/png" sizes="192x192"  href="../media/img/android-icon-192x192.png">
	<link rel="icon" type="image/png" sizes="32x32" href="../media/img/favicon-32x32.png">
	<link rel="icon" type="image/png" sizes="96x96" href="../media/img/favicon-96x96.png">
	<link rel="icon" type="image/png" sizes="16x16" href="../media/img/favicon-16x16.png">
	<link rel="manifest" href="../media/img/manifest.json">
	<meta name="msapplication-TileColor" content="#ffffff">
	<meta name="msapplication-TileImage" content="/ms-icon-144x144.png">
	<meta name="theme-color" content="#ffffff">
	<link media="all" type="text/css" rel="stylesheet" href="../media/css/google_material_icons.css" />
	<link media="all" type="text/css" rel="stylesheet" href="../media/css/mui.min.css" />
	<link media="all" type="text/css" rel="stylesheet" href="../media/css/materialize.min.css" />
	<link media="all" type="text/css" rel="stylesheet" href="style.css" />
	<script src="../media/js/jquery-2.1.4.min.js"></script>
	<script src="../media/js/mui.min.js"></script>
	<script src="../media/js/materialize.min.js"></script>
	<script src="install.js"></script>
	<!--[if lt IE 9]>
	<script src="../media/js/html5shiv.js"></script>
	<script src="../media/js/respond.min.js"></script>
	<![endif]-->
</head>
<body>
<div class="container">
	<div class="mui-panel install">
		<p>Welcome to intra installation !!</p>
		<p>If you're ready to go, click to the install button !!</p>
		<button class="waves-effect btn-flat toggleInstall">
			Install
			<i class="material-icons">send</i>
		</button>
	</div>
	<div class="loader"></div>
	<div class="mui-panel formInstall">
		<div class="row divFormInstall">
			<h2 class="title">Your Admin Profile</h2>
			<div class="input-field input_install">
				<input id="lastname" type="text">
				<label for="lastname">Lastname</label>
			</div>
			<div class="input-field input_install">
				<input id="firstname" type="text">
				<label for="firstname">Firstname</label>
			</div>
			<div class="input-field input_install_full">
				<input id="nickname" type="text">
				<label for="nickname">Nickname</label>
			</div>
			<div class="input-field input_install">
				<input id="password" type="password">
				<label id="labelPassword" for="password">Password<span id="spanLabelPassword"></span></label>
			</div>
			<div class="input-field input_install">
				<input id="confirmPassword" type="password">
				<label for="confirmPassword">Confirm Password<span id="spanLabelConfirmPassword"></span></label>
			</div>
			<div class="input-field input_install_full">
				<input id="email" type="text">
				<label for="email">Email<span id="spanLabelEmail"></span></label>
			</div>
		</div>
		<button class="waves-effect btn-flat nextStepInstall" disabled>Next Step</button>
	</div>
	<div class="mui-panel dbInstall">
		<div class="row">
			<h2 class="title">Database installation</h2>
			<div class="input-field input_install_full">
				<input id="host" type="text" value="localhost">
				<label for="host">Host</label>
			</div>
			<div class="input-field input_install_full">
				<input id="username" type="text" value="root">
				<label for="username">Username</label>
			</div>
			<div class="input-field input_install_full">
				<input id="dbPassword" type="password">
				<label for="dbPassword">Password</label>
			</div>
			<div class="input-field input_install">
				<input id="dbname" type="text" value="intra">
				<label for="dbname">Database Name</label>
			</div>
			<div class="endButton">
				<button class="waves-effect btn-flat" id="createDb">Create database</button>
				<button class="waves-effect btn-flat" id="checkDb">Try connection</button>
				<button class="waves-effect btn-flat" id="finishInstall" disabled>Finish install</button>
			</div>
		</div>
	</div>
</div>
</body>
</html>