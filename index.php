<?
	session_start();
	$_SESSION['hash']=md5(uniqid(true));
	$_SESSION['user']=array("uid"=>1,"nickname"=>"Iku","username"=>"Ikuto","birthday","bio","fbid");
	require_once("inc/adodb.inc.php");
	$ADODB_FETCH_MODE = ADODB_FETCH_ASSOC;
	require_once("inc/connection.php");
	require_once("inc/DataCore.inc.php");
	$DataCore = new DataCore($config);
	$DataCore->getSearch("Accel World");
?>
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
	<link rel="stylesheet" href="http://code.jquery.com/ui/1.10.1/themes/base/jquery-ui.css">
	<link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
	<style>
		*{
			margin: 0;
			padding: 0;
		}		
		body{
			background-image: linear-gradient(bottom, rgb(207,242,245) 40%, rgb(255,170,43) 66%, rgb(250,140,5) 85%);
			background-image: -o-linear-gradient(bottom, rgb(207,242,245) 40%, rgb(255,170,43) 66%, rgb(250,140,5) 85%);
			background-image: -moz-linear-gradient(bottom, rgb(207,242,2451) 40%, rgb(255,170,43) 66%, rgb(250,140,5) 85%);
			background-image: -webkit-linear-gradient(bottom, rgb(207,242,245) 40%, rgb(255,170,43) 66%, rgb(250,140,5) 85%);
			background-image: -ms-linear-gradient(bottom, rgb(207,242,245) 40%, rgb(255,170,43) 66%, rgb(250,140,5) 85%);
			background-image: -webkit-gradient(linear,left bottom,left top,color-stop(0.4, rgb(207,242,245)),color-stop(0.66, rgb(255,170,43)),color-stop(0.85, rgb(250,140,5)));
			filter: progid:DXImageTransform.Microsoft.gradient(startColorStr='#F08C05', EndColorStr='#cff2ff');
			color:#3b5998;
			font-family: 'lucida grande',tahoma,verdana,arial,sans-serif;
		}
		.blpost,footer{
			background-color:#FFF;
			width:auto;
			border:1px #C50 solid;
			-webkit-border-radius:5px;
			-moz-border-radius:5px;
			-o-border-radius:5px;
			border-radius:5px;
			margin: 5px;
			padding:5px;
			box-shadow: 3px 3px 2px #888;
			display:table;
		}
		.blposts{
			display:table-cell;
		}
		.blogo{
			padding:5px;
		}
		.blpostitle{
			font-size:40px;
			vertical-align:top;
			margin:0;
			display:inline-block;
		}
		.imgpost{
			border:1px #F70 solid;
			padding:2px;
		}
		.right{
			margin-left:70%;
		}
		.like_button, .fav_button{
			color:#888;
			font-weight:bold;
			font-size:11px;
			font-family: 'lucida grande',tahoma,verdana,arial,sans-serif;
		}
		.like_button:hover, .fav_button:hover{
			color:#0B6121;
		}
		.limit{
			width:96%;
		}
		.docroot{
			margin: 0 25px;
			display:table;
		}
		p{
			display:inline-block !important;
			word-wrap:break-word;
			vertical-align: top;
			padding:0 5px 5px 5px;
			margin:0;
		}
		#menucategoria{
			width:200px;
		}
		.sidebar{
			display:table-cell;
			vertical-align:top;
		}
		option:focus{
			background-color:#000;
		}
		.pluginButton {
			background: #eceef5;
			-webkit-border-radius: 3px;
			border: 1px solid #cad4e7;
			cursor: pointer;
			padding: 2px 6px 4px;
			white-space: nowrap;
			color: #3b5998;
			display:inline-block;
		}
		.pluginButton:hover {
			border-color: #9dacce;
		}
		.pluginButtonSmall {
			padding: 0 5px 2px 5px;
			width:58px;
			height:16px;
		}
		.pluginButton button {
			background: transparent;
			border: 0;
			margin: -1px;
			padding: 0;
			font: inherit;
			color: inherit;
			cursor: pointer;
			font-size:11px;
		}
		.sp_like {
			background-image: url(https://fbstatic-a.akamaihd.net/rsrc.php/v2/yI/x/1dQf_ATK831.png);
			background-repeat: no-repeat;
			display: inline-block;
			height: 14px;
			width: 14px;
		}
		.hr{
			border:1px inset #C70;
			background-color:#C50;
			margin: 5px 0 5px 0;
		}
		.fb_connect{
			background:url(facebook-connect-button-21.png) no-repeat top;
			width:194px;
			height:25px;
			border:none;
		}
	</style>
	<script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
	<script src="//ajax.googleapis.com/ajax/libs/jqueryui/1.10.1/jquery-ui.min.js"></script>
	<script src="bootstrap/js/bootstrap.min.js"></script>
	
	

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
			$.get('connect.php?hash=<?=$_SESSION['hash']?>',{"id":r.id}).done(function(d){
				if(typeof d=="object"){
					if(d.code==200){
						//window.location.reload();
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
		<section class="blposts">
			<section class="blpost limit">
				<article>
					<img height="172" width="200" src="http://ip80.sytes.net/blog/imgcache/Accel_World-200x172.jpg" class="imgpost" />
					<h3 class="blpostitle">Accel Wolrd</h3>
					<p>En el año 2046, Neuro-sincronización, un sistema de tecnología que permite a los humanos manipular sus cinco sentidos en un entorno de realidad aumentada, se ha generalizado de modo que la gente puede acceder a Internet y tambien entrar en mundos virtuales. Haruyuki "Haru" Arita es un chico bajito, gordo, que debido a la intimidación constante, tiene baja autoestima. Para escapar del tormento de la vida real, se registra en la red de la escuela del mundo virtual donde se juega a un juego llamado "Squash" él solo; obteniendo la puntuación más alta.
Un día Haru atrae la atención de la vicepresidenta del Consejo de Estudiantes Kuroyukihime que le ofrece "Brain Burst", un programa secreto que permite a una persona hacer que el tiempo se detenga en su entorno por "acelerar" sus ondas cerebrales en el mundo real. Desafortunadamente, hay un límite de cuántas veces una persona puede acelerarse debido a los Burst Points que se consumen en cada aceleración y la manera principal para conseguir más puntos es luchar y derrotar a otros usuarios de Brain Burst llamados Burst Linkers, en un mundo de realidad virtual masivo en línea del programa (MMORPG). Sin embargo, si un usuario pierde, algunos de sus puntos se perderán, si gana, el usuario gana más puntos. Si un usuario pierde todos sus puntos, el programa se desinstala y bloquea todos los intentos de re-instalación, por lo que elimina de forma permanente la capacidad del usuario para acelerarse.
Kuroyukihime quiere la ayuda de Haru, porque desea llegar a nivel 10 y conocer a el creador del Brain Burst; para conocer su verdadero propósito. Pero para hacer eso, tiene que derrotar a otros seis usuarios de nivel 9. Aquellos que alcanzaron el nivel 9 se denominan "Los siete reyes de Color Puro", los líderes de las seis legiones más poderosas del mundo Accel World. Haru se compromete a ayudar a Kuroyukihime no sólo para pagarle por su generosidad, también para superar sus debilidades.
Un dato interesante a tomar en cuenta es que esto sucede unos 20 años después de Sword Art Online, al ser del mismo mangaka, y por tener como referencia la mención del NerveGear, utilizado durante dicha serie como casco de entrada a una realidad virtual. Es en el capitulo 22 en donde se ve a Haruyuki investigando sobre como derrotar a un enemigo y como realiza las entradas a esa realidad sin tener encima ningún dispositivo para activar el Burst Brain.</p>
				</article>
				<aside>
					<a href="#like" class="like_button" title="Me gusta">(Like)</a>
					<a href="#favo" class="fav_button" title="Añadir a favoritos">Añadir a favoritos</a>
					<div class="pluginButton pluginButtonSmall pluginConnectButtonDisconnected" title="">
						<div>
							<button type="submit" class="like_fb_button" data-shared='{"link":"http:\/\/enlinea.sytes.net\/post\/accel_world","picture":"http:\/\/ip80.sytes.net\/blog\/imgcache\/Accel_World-200x172.jpg","name":"Accel World - Mi Coraz\u00f3n Anime Mi Mundo Otaku","caption":"Hidan no Aria","description":"En el año 2046, Neuro-sincronizacion, un sistema de tecnologia que permite a los humanos manipular sus cinco sentidos en un entorno de realidad aumentada, se ha generalizado de modo que la gente puede acceder a Internet y tambien entrar en mundos virtuales."}'>
								<i class="pluginButtonIcon img sp_like sx_like_fav"></i>
								Me gusta
							</button>
						</div>
					</div>
				</aside>
			</section>
			<section class="blpost limit">
				<article>
					<img height="172" width="200" src="http://ip80.sytes.net/blog/imgcache/Aria_The_Scarlet_Ammo-200x172.jpg" class="imgpost" />
					<h3 class="blpostitle">Hidan No Aria</h3>
					<p>La historia toma lugar en Tokyo Butei High School, una escuela especial en donde detectives armados llamados Butei son entrenados en el uso de sus armas y habilidades, Kinji Tooyama es un estudiante de segundo año que tiene una habilidad especial, pero la mantiene en secreto y se muestra como alguien normal ya que quiere una vida pacífica. Un día, de camino a la escuela, mientras viaja en su bicicleta con una bomba, se encuentra con H. Aria Kanzaki, la más poderosa Butei de Rango S del la seccional de Asalto de la escuela.
					SU vida dara un giro y comenzara una batalla contra un asesion de Buteis que intentara matarlo, miestras poco a poco descubre los hechos tras la muerte de sue hermano</p>
				</article>
				<aside>
					<a href="#like" class="like_button" title="Me gusta">(Like)</a>
					<a href="#favo" class="fav_button" title="Añadir a favoritos">Añadir a favoritos</a>
					<div class="pluginButton pluginButtonSmall pluginConnectButtonDisconnected" title=""><div><button type="submit" class="like_fb_button" data-shared='{"link":"http:\/\/enlinea.sytes.net\/post\/hidan_no_aria","picture":"http:\/\/ip80.sytes.net\/blog\/imgcache\/Aria_The_Scarlet_Ammo-77x90.jpg","name":"Hidan no Aria - Mi Coraz\u00f3n Anime Mi Mundo Otaku","caption":"Hidan no Aria","description":"La historia toma lugar en Tokyo Butei High School, una escuela especial en donde detectives armados llamados Butei son entrenados en el uso de sus armas y habilidades, Kinji Tooyama es un estudiante de segundo a\u00f1o que tiene una habilidad especial, pero la mantiene en secreto y se muestra como alguien normal ya que quiere una vida pac\u00edfica. Un d\u00eda, de camino a la escuela, mientras viaja en su bicicleta con una bomba, se encuentra con H. Aria Kanzaki, la m\u00e1s poderosa Butei de Rango S del la seccional de Asalto de la escuela."}'><i class="pluginButtonIcon img sp_like sx_like_fav"></i>Me gusta</button></div></div>
				</aside>
			</section>
		</section>
		<aside class="sidebar">
			Buscar
			<input type="text" size="40" name="q" title="Escribe tu consulta y presiona Enter" id="q" placeholder="Buscame" autocomplete="off" />
			Categorias
			<select>
				<option value="yuri">Yuri</option>
				<option value="yaoi">Yaoi</option>
			</select>
			<div class="hr"></div>
			<div class="fb-like-box" data-href="https://www.facebook.com/MiCorazonAnimeMiMundoOtaku" data-width="auto" data-show-faces="true" data-stream="false" data-header="true"></div>
		</aside>
	</section>
	<footer>&copy; Mi Corazón Anime, Mi Mundo Otaku 2012 </footer>
	<script>
		$(".like_fb_button").on("click",function(e){
			var origin = {
				method: 'feed',
				redirect_uri: 'http://micoranime.sytes.net/facebook.html',
				link: 'http://micoranime.sytes.net/',
				picture: 'http://micoranime.sytes.net/favicon.png',
				name: 'Portada - Mi Corazón Anime, Mi Mundo Otaku',
				caption: 'Portada - Mi Corazón Anime, Mi Mundo Otaku',
				description: 'En este blog encontraras todo lo que un otaku como tu o yo necesita, animes, mangas, vocaloid, noticias, soundtracks, Bandas sonoras, Openings, Endings y mucho mas'
			};
			FB.ui($.extend(origin,$(this).data("shared")));
		});
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