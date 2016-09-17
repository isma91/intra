<?php
if (file_exists('./../config.php')) {
	header('Location: ./../');
}
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="description" content="Create your intra !!" />
	<title>intra intallation</title>
	<link media="all" type="text/css" rel="stylesheet" href="../media/css/google_material_icons.css" />
	<link media="all" type="text/css" rel="stylesheet" href="../media/css/mui.min.css" />
	<link media="all" type="text/css" rel="stylesheet" href="../media/css/materialize.min.css" />
	<link media="all" type="text/css" rel="stylesheet" href="style.css" />
	<script src="../media/js/jquery-2.1.4.min.js"></script>
	<script src="../media/js/mui.min.js"></script>
	<script src="../media/js/materialize.min.js"></script>
	<script src="install.js"></script>
</head>
<body>
<div class="container">
	<div id="event"></div>
	<div class="mui-panel install">
		<p>Welcome to intra installation !!</p>
		<p>If you're ready to go, click to the install button !!</p>
		<button class="waves-effect btn-flat toggleInstall">
			Install
			<i class="material-icons">send</i>
		</button>
	</div>
	<div class="loader"></div>
	<div class="mui-panel">
		<div class="row divFormInstall">
			<h2 class="title">Your Admin Profile</h2>
			<div class="input-field input_install">
				<input id="last_name" type="text">
				<label>Lastname</label>
			</div>
			<div class="input-field input_install">
				<input id="first_name" type="text">
				<label>Firstname</label>
			</div>
			<div class="input-field input_install_full">
				<input id="pseudo" type="text">
				<label>Nickname</label>
			</div>
			<div class="input-field input_install">
				<input id="password" type="password">
				<label id="labelPassword">Password<span id="spanLabelPassword"></span></label>
			</div>
			<div class="input-field input_install">
				<input id="confirmPassword" type="password">
				<label>Confirm Password<span id="spanLabelConfirmPassword"></span></label>
			</div>
			<div class="input-field input_install_full">
				<input id="email" type="text">
				<label>Email<span id="spanLabelEmail"></span></label>
			</div>
		</div>
		<button class="waves-effect btn-flat nextStepInstall" disabled>
			Next Step
		</button>
	</div>
	<div class="mui-panel dbInstall">
		<div class="row">
			<h2>Database installation</h2>
			<div class="input-field input_install_full">
				<input id="host" type="text" value="localhost">
				<label>Host</label>
			</div>
			<div class="input-field input_install_full">
				<input id="username" type="text" value="root">
				<label>Username</label>
			</div>
			<div class="input-field input_install_full">
				<input id="dbPassword" type="password">
				<label>Password</label>
			</div>
			<div class="input-field input_install">
				<input id="dbname" type="text" value="intra">
				<label>Database Name</label>
			</div>
			<div class="endButton">
				<button class="waves-effect btn-flat" id="createDb">
					Create database
				</button>
				<button class="waves-effect btn-flat" id="checkDb">
					Try connection
				</button>
				<button class="waves-effect btn-flat" id="finishInstall" disabled>
					Finish install
				</button>
			</div>
		</div>
	</div>
</div>
</body>
</html>