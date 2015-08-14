<!DOCTYPE html>
<html lang="es-ES">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Speek</title>
	<link rel="shortcut icon" type="image/ico" href="favicon.ico">
	<!-- Bootstrap CSS -->
	<!-- <link href="https://netdna.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css" rel="stylesheet"> -->
	<link href="assets/bootstrap/css/theme.min.css" rel="stylesheet">

	<!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
	<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
	<!--[if lt IE 9]>
		<script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
		<script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
	<![endif]-->
</head>
<style>
.spaced{
	margin: 20px 0;
	padding: 30px 10px;
	border: 1px solid #ccc;
}
.btn{
	outline: none !important;
}
</style>
<body>
<h1 class="text-center">Speek</h1>
<div class="container">
	<p class="spaced" id="inputText" contenteditable></p>
	<p class="text-center">
		<button type="button"class="btn btn-primary" id="speek">Speek</button>
		<button type="reset"class="btn btn-danger" id="reset">Reset</button>
	</p>
</div>

<!-- jQuery -->
<script src="https://code.jquery.com/jquery.js"></script>
<!-- Bootstrap JavaScript -->
<script src="https://netdna.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/annyang/1.6.0/annyang.min.js"></script>
<script src="assets/js/typed.min.js"></script>
<script src="assets/js/app.js"></script>
<script>
$(function() {

var texthelp = "Para iniciar a escribir, solo diga escribir y a continuación el texto que desea digitar, Haga click en reset, luego inicie a hablar al micrófono.";

$("#inputText").typed({
    strings: [texthelp],
    typeSpeed: 30,
    contentType: 'html',
    cursorChar: "",
});

var read = function(term){
	var voices = [];
	voices = window.speechSynthesis.getVoices();
	var u = new SpeechSynthesisUtterance();
	u.text = term;
	u.localService = false;
	u.lang = 'es-ES';
	u.pitch = 1;
	u.rate = 1.2;
	u.voiceURI = 'Google Español';
	u.volume = 1;
	speechSynthesis.speak(u);
}

read(texthelp);

var write = function(term){
	$("#inputText").append(term + "&nbsp;");
}

$("#speek").on( "click", function(){
	read($("#inputText").html());
});

$("#reset").on( "click", function(){
	$("#inputText").html(" ").focus();
});

var commands = {
	'*search': write
};

annyang.debug();
annyang.addCommands(commands);
annyang.setLanguage("es-ES");
annyang.start();

});
</script>
</body>
</html>