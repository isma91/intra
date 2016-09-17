/*jslint browser: true, node : true*/
/*jslint devel : true*/
/*global $, document, this*/
$(document).ready(function(){
	var passwordGood, confirmPasswordGood, emailGood, nextStepInstallCliqued, nextStepInstallCliquedCount, checkDbHost, checkDbUsername, checkDbPassword, checkDbName;
	passwordGood = false;
	confirmPasswordGood = false;
	emailGood = false;
	nextStepInstallCliqued = false;
	nextStepInstallCliquedCount = 0;
	$("button.toggleInstall").click(function(){
		$("div.formInstall").fadeToggle("slow");
		$("button.toggleInstall").remove();
	});
	$("button.nextStepInstall").click(function(){
		nextStepInstallCliquedCount = nextStepInstallCliquedCount + 1;
		nextStepInstallCliqued = true;
		if (nextStepInstallCliqued === true) {
			if (nextStepInstallCliquedCount % 2 === 0) {
				$("button.nextStepInstall").html("Hide Admin Profile");
			} else {
				$("button.nextStepInstall").html("Display Admin Profile");
			}
		}
		$("div.divFormInstall").fadeToggle("slow");
		$("div.dbInstall").fadeIn("slow");
	});
	$("input#password").bind("change paste keyup", function() {
		var score, password;
		score = 0;
		password = $(this).val();
		if (password.length > 4) {
			score = score + 1;
		}
		if (password.length > 4 && (password.match(/[a-z]/)) && (password.match(/[A-Z]/))) {
			score = score + 1;
		}
		if (password.length > 4 && password.match(/\d+/)) {
			score = score + 1;
		}
		if (password.length > 4 && password.match(/.[!,@,#,$,%,^,&,*,?,_,~,-,(,)]/) ) {
			score = score + 1;
		}
		switch (score) {
			case 0:
			passwordGood = false;
			$("span#spanLabelPassword").html(" at least 5 characters").css("color", "#808080");
			$(this).css({"border-color":"#808080"});
			break;
			case 1:
			passwordGood = true;
			$("span#spanLabelPassword").html(" weak").css("color", "#FF0000");
			$(this).css({"border-color":"#FF0000"});
			break;
			case 2:
			passwordGood = true;
			$("span#spanLabelPassword").html(" weak").css("color", "#FF0000");
			$(this).css({"border-color":"#FF0000"});
			break;
			case 3:
			passwordGood = true;
			$("span#spanLabelPassword").html(" medium").css("color", "#FFA500");
			$(this).css({"border-color":"#FFA500"});
			break;
			case 4:
			passwordGood = true;
			$("span#spanLabelPassword").html(" strong").css("color", "#007B00");
			$(this).css({"border-color":"#007B00"});
			break;
		}
	});
	$("input#confirmPassword").bind('change paste keyup', function() {
		if ($(this).val() !== $("input#password").val()) {
			confirmPasswordGood = false;
			$(this).css({"border-color":"#FF0000"});
			$("span#spanLabelConfirmPassword").html(" not the same password").css("color", "#FF0000");
		} else {
			confirmPasswordGood = true;
			$(this).css({"border-color":"#007B00"});
			$("span#spanLabelConfirmPassword").html(" same password").css("color", "#007B00");
		}
	});
	$("input#email").bind('change paste keyup', function() {
		var regexEmail;
		regexEmail = /^[A-Z0-9._%+-]+@([A-Z0-9-]+\.)+[A-Z]{2,4}$/i;
    	if (regexEmail.test($(this).val())) {
    		emailGood = true;
			$(this).css({"border-color":"#007B00"});
			$("span#spanLabelEmail").html(" valid email").css("color", "#007B00");
		} else {
			emailGood = false;
			$(this).css({"border-color":"#FF0000"});
			$("span#spanLabelEmail").html(" not an email").css("color", "#FF0000");
		}
	});
	$("button#createDb").click(function () {
		var host, username, dbPassword, dbName;
		host = $("input#host").val();
		username = $("input#username").val();
		dbPassword = $("input#dbPassword").val();
		dbName = $("input#dbName").val();
		$.post( "dbInstall.php", {host: host, username: username, password: dbPassword, dbname: dbName}, function (data) {
			var dataError;
			dataError = false;
			if (data.substr(0, 5) === "Error") {
				$("div#event").css("display", "none");
				$("div#event").html('<div class="alert alert-danger event-danger">' + data + '</div>');
				$("div#event").fadeIn('slow');
			} else {
				$("div#event").css("display", "none");
				$("div#event").html('<div class="alert alert-success event-success">' + data + '</div>');
				$("div#event").fadeIn('slow');
			}
		});
	});
	$("button#checkDatabase").click(function() {
		checkDbHost = $("input#host").val();
		checkDbUsername = $("input#username").val();
		checkDbPassword = $("input#dbPassword").val();
		checkDbName = $("input#dbName").val();
		$.post( "dbTest.php", {host:  checkDbHost, username: checkDbUsername, password: checkDbPassword, dbname: checkDbName}, function (data) {
			if (data.substr(0, 5) === "Error") {
				$("div#event").css("display", "none");
				$("div#event").html('<div class="alert alert-danger event-danger">' + data + '</div>');
				$("div#event").fadeIn('slow');
				$("button#finish_install").attr('disabled', "true");
			} else {
				$("div#event").css("display", "none");
				$("div#event").html('<div class="alert alert-success event-success">' + data + '</div>');
				$("div#event").fadeIn('slow');
				$("button#finish_install").removeAttr('disabled');
			}
		});
	});
	$("input").bind('change paste keyup', function() {
		if ($("input#last_name").val().length > 0 && $("input#first_name").val().length > 0 && $("input#pseudo").val().length > 0 && passwordGood === true && confirmPasswordGood === true && emailGood === true) {
			$("button.nextStepInstall").removeAttr('disabled');
		} else {
			$("button.nextStepInstall").attr('disabled', "true");
		}
		if ($("input#host").val() !== checkDbHost || $("input#username").val() !== checkDbUsername || $("input#dbPassword").val() !== checkDbPassword || $("input#dbName").val() !== checkDbName) {
			$("button#finish_install").attr('disabled', "true");
		}
	});
	$("button#finish_install").click(function() {
		$.post( "create_config.php", {host:  checkDbHost, username: checkDbUsername, password: checkDbPassword, dbname: checkDbName}, function (data) {
			if (data !== 0) {
				$("div#event").html('<div class="alert alert-success event-success">Config file created !!</div>');
				$("div#event").fadeIn('slow');
			} else {
				$("div#event").html('<div class="alert alert-danger event-danger">Error when creating the config file !!</div>');
				$("div#event").fadeIn('slow');
			}
		});
		$.post( "install_import_db.php", {host:  $("input#host").val(), username: $("input#username").val(), password: $("input#dbPassword").val(), dbname: $("input#dbName").val(), blogger_name: $("input#pseudo").val(), blogger_firstname: $("input#first_name").val(), blogger_lastname: $("input#last_name").val(), blogger_email: $("input#email").val(), blogger_password: $("input#password").val()}, function (data) {
			$("div.form_install").css("display", "none");
			$("div.db_install").css("display", "none");
			$("div.loader").css("display", "inline");
			$("div.install").html("Completing the Installation...");
			if (data === "true") {
				$("div#event").css("display", "none");
				$("div.loader").css("display", "none");
				$("div#event").html('<div class="alert alert-success event-success">Your intra is ready to go !!</div>');
				$("div#event").fadeIn('slow');
				$("div.install").html("Done !!");
				document.location.href = './../';
			} else {
				$("div.loader").css("display", "none");
				$("div#event").css("display", "none");
				$("div#event").html('<div class="alert alert-danger event-danger">All tables have not been created in the database !! Try Again</div>');
				$("div#event").fadeIn('slow');
				$("div.install").html("Restart the installation and check if the 'install' folder is in the root of the project");
			}
		});
	});
});