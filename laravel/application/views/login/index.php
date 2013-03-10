<!DOCTYPE html>
<html lang="es">
<head>
	<meta charset="utf-8" />
	<meta property="og:url" content="http://micoranime.sytes.net/" />
	<meta property="og:title" content="Portada - Mi Corazón Anime, Mi Mundo Otaku" />
	<meta property="og:image" content="http://micoranime.sytes.net/favicon.png" />
	<meta property="og:site_name" content="Mi Corazón Anime, Mi Mundo Otaku" />
	<meta property="og:description" content="En este blog encontraras todo lo que un otaku como tu o yo necesita, animes, mangas, vocaloid, noticias, soundtracks, Bandas sonoras, Openings, Endings y mucho mas" />
	<meta property="fb:admins" content="100000733623491" />
	<title>Mi Corazón Anime, Mi Mundo Otaku</title>
	<link rel="stylesheet" href="//micoranime.sytes.net/css/micoranime.css">
	<link rel="stylesheet" href="//code.jquery.com/ui/1.10.1/themes/base/jquery-ui.css">
	<link rel="stylesheet" href="//micoranime.sytes.net/bootstrap/css/bootstrap.min.css">
	<script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
	<script src="//ajax.googleapis.com/ajax/libs/jqueryui/1.10.1/jquery-ui.min.js"></script>
	<script src="//micoranime.sytes.net/bootstrap/js/bootstrap.min.js"></script>
	<script>
	$(document).on("ready",function(){
		$("#q").tooltip();
		$("#q").on("keypress",function(k){
			$("#q").autocomplete({
				source:"/search/",
				minLength: 2
			});
		});	
	});
	function login(){
		FB.api('/me',function(r){
			$.get('/connect',{"id":,"hash":'<?=Session::get('hash');?>'}).done(function(d){
				if(typeof d=="object"){
					if(d.code==200){
						window.location.reload();
						console.log(d);
					}else if(d.code==301){
						window.location='/registro'
					}else if(d.code==403){
						alert("Operacion no permitida");
					}else{
						alert("Error de aplicacion\r\nContecte al Administrador del Sitio");
					}
				}else{
					console.log(d);
				}
			})
		});
	}
	function ConnectWithFacebook(){
		FB.getLoginStatus(function(r){
			if(r.status=="connected"){
				login();
			}else if(r.status=="not_autorized"){
				console.log("Status: No Autorizado");
			}else{
				FB.login(function(r){
					if(r.authResponse){
						login();
					}
				});
			}
		});
	}
	</script>
</head>
<body>
 <div id='fb-root'></div>
 <button class="fb_connect" onclick="ConnectWithFacebook()"></button>
    <script src='http://connect.facebook.net/es_LA/all.js'></script>
    <script> 
		FB.init({appId: "431617510250911", status: true, cookie: true, xfbml: true});
    </script>
	<nav class="blmenuprincipal">

		</nav>
		<header>
			<h1 class="blogo">Mi Corazón Anime, Mi Mundo Otaku</h1>
		</header>
	<section class="docroot">
		<section class="bl_posts">
			<form action "" method="post">
				<input type="text" name="usr" />
				<input type="password" name="pwd" />
				<input type="submit" />
			</form>
		</section>
	</section>
	<footer>&copy; Mi Corazón Anime, Mi Mundo Otaku 2012 </footer>
	<script>
		var _gaq = _gaq || [];
		_gaq.push(['_setAccount', 'UA-38958285-1']);
		_gaq.push(['_trackPageview']);
		(function() {
			var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
			ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
			var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
		})();
	</script>
</body>
</html>