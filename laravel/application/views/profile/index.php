<? 
	$u=Session::get('user');
	$p=Social::where('uid','=',$u['user']['uid'])->get();
	$t=$p[0]->to_array();
	var_dump($t,$u);
	echo "http://www.facebook.com/{$t['fbid']}/posts/{$t['post_id']}";
	echo "https://graph.facebook.com/{$t['fbid']}_{$t['post_id']}?access_token={$u['accessToken']}";
?>
 <script src='http://connect.facebook.net/es_LA/all.js'></script>
 <script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
    <script> 
		FB.init({appId: "431617510250911", status: true, cookie: true, xfbml: true});
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
		FB.api('/<?echo"{$t['fbid']}_{$t['post_id']}?access_token={$u['accessToken']}";?>',function(r){
			console.log(r);
			if(r.errors){
				FB.getLoginStatus(function(r){
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
			}else{
				$("#name").html(r.name);
				$("#caption").html(r.caption);
				$("#description").html(r.description);
				$("#picture").attr('src',r.picture);
			}
		});
    </script>
	<div>
		<div id="caption"></div>
		<div id="description"></div>
		<div id="name"></div>
		<img id="picture" />
	</div>