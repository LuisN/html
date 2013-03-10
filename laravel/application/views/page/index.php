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
	<link rel="stylesheet" href="//code.jquery.com/ui/1.10.1/themes/base/jquery-ui.css">
	<link rel="stylesheet" href="//micoranime.sytes.net/bootstrap/css/bootstrap.min.css">
	<link rel="stylesheet" href="//micoranime.sytes.net/css/micoranime.css">
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
	function login(a){
		FB.api('/me',function(r){
			
			$.get('/connect',{"id":r.id,'e':r.email,"accessToken":a}).done(function(d){
				var d = eval('(' + d + ')');
				if(typeof d=="object"){
					if(d.code==200){
						console.log(d);
						window.location.reload();
					}else if(d.code==301){
						window.location='/register'
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
			console.log(r);
			if(r.status=="connected"){
				login(r.authResponse.accessToken);
			}else if(r.status=="not_authorized"){
				console.log("Status: No Autorizado");
			}else{
				FB.login(function(r){
					if(r.authResponse){
						login(r.authResponse.accessToken);
					}
				},{scope: 'email'});
			}
		});
	}
	function LogOut(){
		window.location="/logout";
	}
	</script>
</head>
<body>
 <div id='fb-root'></div>
 
    <script src='http://connect.facebook.net/es_LA/all.js'></script>
    <script> 
		FB.init({appId: "431617510250911", status: true, cookie: true, xfbml: true});
    </script>
	<nav class="blmenuprincipal">
		
		<? 
		if(Session::has('user')){ 
		$user=Session::get('user'); 
		echo "Bienvenido: {$user['user']['nickname']}";
		if(empty($user['accessToken'])){?>
			<button class="fb_connect" onclick="ConnectWithFacebook()"></button>
		<?}else{?>
			<script>
				FB.api('/me?fields=picture&access_token=<?=$user['accessToken'];?>',function(d){
					$('#picture_profile').attr("src",d.picture.data.url);
				});
			</script>
			<img src="" id="picture_profile" width="32" height="32" />
		<?}?>
			<button onclick="LogOut();">Salir</button>
		<?}else{?>
			<button class="fb_connect" onclick="ConnectWithFacebook()"></button>
		<?}	?>
	</nav>
	<header>
		<h1 class="blogo">Mi Corazón Anime, Mi Mundo Otaku</h1>
	</header>
	<section class="docroot">
		<section class="blposts">
			<?
			$p=$post->to_array();
			$shared=json_encode(array("link"=>$p['permlink'],"picture"=>$p['img'],"name"=>"{$p['title']} - Mi Corazón Anime Mi Mundo Otaku","caption"=>$p['title'],"description"=>$p['description']));
			?>
			<section class="blpost limit">
				<article>
					<img height="172" width="200" src="<?=$p['img'];?>" class="imgpost" />
					<h3 class="blpostitle"><a href="<?=$p['permlink'];?>"><?=$p['title'];?></a></h3>
					<p><?=$p['content'];?></p>
				</article>
				<aside>
					<a href="#like" class="like_button" title="Me gusta">(Like)</a>
					<a href="#favo" class="fav_button" title="Añadir a favoritos">Añadir a favoritos</a>
					<div class="pluginButton pluginButtonSmall pluginConnectButtonDisconnected" title="">
						<div>
							<button type="submit" class="like_fb_button" data-shared='<?=$shared;?>'>
								<i class="pluginButtonIcon img sp_like sx_like_fav"></i>
								Me gusta
							</button>
						</div>
					</div>
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
	<footer>&copy; Mi Corazón Anime, Mi Mundo Otaku 2012 Powered by EnlineaLab with Laravel </footer>
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