<?php
session_start();
function striprif($cedrif){
	$cadena=trim($cedrif);
	$cadena=str_replace("-","",$cadena);
	$cadena=str_replace(".","",$cadena);
	$cadena=str_replace(" ","",$cadena);
	$cadena=strtoupper($cadena);
	$cadena=trim($cedrif);
	return $cadena; 
}

function rmBOM($str=""){
    if(substr($str,0,3) == pack("CCC",0xef,0xbb,0xbf)){
		$str=substr($str,3);
    }
    return $str;
}

function getMenu($idioma){
	if($idioma=="es"){
		?>
		
		<?php
	}
	elseif($idioma=="fr"){
		?>
		
		<?php		
	}
	else{
		?>
		<div id="header_oc">
			<div id="content_header">
				<div class="content_menu1">
		        <ul class="menu_p">
		        <li class="boton_1"><a href="#" target="_self">COLLECTIONS</a>
		       		<ul class="submenu1">
		           		  <li class="filo"></li>
		                  <li><span class="botonsub1" id="ClickCollection"><a href="#">HAUTE COUTURE</a></span>
		                  	<ul id="submenuCollection" class="sumbmenu2">
		                    	<li class="filo"></li>
		                    	<li class="botonsub2"><a href="index.php?idweb=collections&tipocol=fishwoman" target="_self">FISH WOMAN</a></li>
		                        <li class="filo"></li>
		                    	<li class="botonsub2"><a href="index.php?idweb=collections&tipocol=eagleye" target="_self">EAGLE EYE</a></li>
		                    </ul>
		                  </li>
		                  <li class="filo"></li>
		                  <li class="botonsub1"><a href="index.php?idweb=collections&tipocol=preaporter">PRÈ-À-PORTER</a></li>
		            </ul>
		        </li>
		        <li class="bullet"></li>
		        <li class="boton_1"><a href="index.php?idweb=accesories" target="_self">ACCESSORIES</a></li>
		     	</ul>
		     </div>
		     
		     <div class="separador1">
		     </div>
		     <a href="index.php">
		     	<div class="logo"></div>
		     </a> 
		     <div class="separador1">
		     </div>
		     
		     <div class="content_menu2">
		     	<ul class="menu_p">
		        <li class="boton_1"><a href="index.php?idweb=videos&t=dm" target="_self">VIDEOS</a></li>
		        <li class="bullet"></li>
		        <li class="boton_1"><a href="index.php?idweb=blog&t=dm&tiponoticia=press" target="_self">PRESS</a></li>
		        <li class="bullet"></li>
		         <li class="boton_1"><a href="index.php?idweb=bio&t=dm" target="_self">BIOGRAPHY</a></li>
		        </ul>
			</div>
		</div>
	</div>
		<?php
		if($_GET['idweb']=="blog"){
			getLineaHeader();
		}
	}
}

function getDOCTYPE(){
	?>
		<!DOCTYPE hmtl>
	<?php
}

function getTitle($titulo){
	?>
		<title><?php echo($titulo); ?></title>
	<?php
}

function getJquery(){
	?>
    	<script type="text/javascript" src="libs/jquery-1.10.1.min.js"></script>
	<?php
}

function getRedesSoc(){
	?>
		<script type="text/javascript" src="//assets.pinterest.com/js/pinit.js"></script>
	<?php
}

function getFunctionsJqueryMenu(){
	?>
	<script type="text/javascript">
		//Abrir colapsar
		jQuery(document).ready(function(){
		  jQuery("#submenuCollection").hide();
		  //toggle the componenet with class msg_body
		  jQuery("#ClickCollection").click(function(e){
		  	e.preventDefault();
		    jQuery(this).next("#submenuCollection").slideToggle(500);
		  });
		});
	</script>
	<?php
}


function getFunctionsJquery(){
	?>
	<script type="text/javascript">
		$(function() {
		    $('#slideshow').cycle({
		    	fx:      	'fade',
		        pager:      '#nav',
			    slideResize: true,
			    containerResize: false,
			    width: '100%',
			    fit: 1,
		        pagerAnchorBuilder: buildPagerBox
		    });
		    
		    function buildPagerBox(i, el) {
		        // you can return whatever markup you want for the pager
		        return '<a href="#" class="box"></a>';
		    }
		});
		$(function() {
		    $('#fotosdespues').cycle({
		    	fx:      	'fade',
			    slideResize: true,
			    containerResize: false,
			    delay: "60000"
		    });
		});	
		$(function() {
			$("#slideshow").hide();
			$("#nav").hide();
			$("#fotosdespues").show();
			$("#fotosdespues").delay(60150).fadeOut(800);
			$("#slideshow").delay(61000).fadeIn(800);
			$("#nav").delay(60300).fadeIn(800);
		});
	</script>
	<?php
}

function showSlides(){
	?>
		<div id="fotosdespues">
			<object onclick="return false;"><param name="movie" value="https://www.youtube.com/v/WtPiGYsllos?hl=es_MX&amp;version=3&controls=0&autoplay=1&autohide=1&showinfo=0&modestbranding=1"></param><param name="allowFullScreen" value="true"></param><param name="allowscriptaccess" value="always"></param><embed onclick="return false;" src="https://www.youtube.com/v/WtPiGYsllos?hl=es_MX&amp;version=3&controls=0&autoplay=1&autohide=1&showinfo=0&modestbranding=1" type="application/x-shockwave-flash" allowscriptaccess="always" allowfullscreen="true"></embed></object>
		</div>
    	<div id="nav" style="display:none;"></div>
		<div id="slideshow" style="display:none;">
			<img src="img/img_home1.jpg" />
			<img src="img/img_home2.jpg" />
			<img src="img/img_home3.jpg" />
		</div>
	<?php
}

function getAjax(){
	?>
		<script type="text/javascript" src="libs/ajax.js"></script>
		<script type="text/javascript" src="libs/lib.js"></script>
	<?php
}

function getLibsOthers(){
	?>
	    <script src="libs/jquery.cycle.all.js" type="text/javascript"></script>
		<script src="libs/jquery-ui-1.10.3.custom.js"></script>
		<script src="libs/jquery.colorbox.js"></script>
		<script src="libs/vendor.js"></script>
	<?php
}

function getCSS(){
	?>
		<link rel="stylesheet" href="css/ui-lightness/jquery-ui-1.10.3.custom.css" media="screen" />
		<link rel="stylesheet" href="css/vendor.css" type="text/css" media="screen" />
		<link rel="stylesheet" href="css/style.css" type="text/css" media="screen" />
		<link rel="stylesheet" href="css/colorbox.css" type="text/css" media="screen" />
		<link rel="stylesheet" href="css/estilo.css" type="text/css" media="screen" />
		<link rel="stylesheet" href="css/cycle.css" type="text/css" media="screen" />
		<link rel="stylesheet" href="css/header.css" type="text/css" media="screen" />
		<link rel="stylesheet" href="css/content.css" type="text/css" media="screen" />
		<link href="css/pruebas.css" rel="stylesheet" type="text/css">
		<link href="css/blog.css" rel="stylesheet" type="text/css">
	<?php
}


function getCSSBlog(){
	?>
		<link rel="stylesheet" href="css/ui-lightness/jquery-ui-1.10.3.custom.css" media="screen" />
		<link rel="stylesheet" href="css/vendor.css" type="text/css" media="screen" />
		<link rel="stylesheet" href="css/style.css" type="text/css" media="screen" />
		<link rel="stylesheet" href="css/colorbox.css" type="text/css" media="screen" />
		<link rel="stylesheet" href="css/cycle.css" type="text/css" media="screen" />
		<link rel="stylesheet" href="css/header.css" type="text/css" media="screen" />
		<link rel="stylesheet" href="css/content.css" type="text/css" media="screen" />
		<link href="css/pruebas.css" rel="stylesheet" type="text/css">
		<link href="css/blog.css" rel="stylesheet" type="text/css">
	<?php
}

function getPreloaderComplete(){
	?>
		<script src="libs/jpreloader.js"></script>
		<link rel="stylesheet" href="css/jpreloader.css" type="text/css" media="screen" />
	<?php	
	getJpreloader();
}

function getBlogCSS(){
	?>
		<link href="css/blog.css" rel="stylesheet" type="text/css">
	<?php
}

function getLineaHeader(){
	?>
	<div id="header_oc" style="background: none;">
		<div id="content_header" style="background: none;">
			<div class="linea_header">
			</div>
		</div>
	</div>
	<?php
}

function getHeaderHome(){
	getTitle("OSCAR CARVALLO PARIS");
	getAjax();
	getJquery();
	getFunctionsJqueryMenu();
	getFunctionsJquery();
	getLibsOthers();
	getRedesSoc();
	if($_GET['idweb']!='blog'){
		getCSS();
	}
	else{
		getCSSBlog();
	}
}

function getHeaderWrapper(){
	getTitle("OSCAR CARVALLO PARIS");
	getAjax();
	getJquery();
	getFunctionsJqueryMenu();
	//getFunctionsJquery();
	getLibsOthers();
	getRedesSoc();
	if($_GET['idweb']!='blog'){
		getCSS();
	}
	else{
		getCSSBlog();
	}
}

function getfooter_old(){
	?>
	  <div id="footer_oc">
  	<div class="content_menu3">
    	<ul class="menu_p3">
        	<li><span class="boton_3"><a href="#">ARTWORK</a></span></li>
            <li class="bullet2"></li>
            <li><span class="boton_3"><a href="#">CONTACT US</a></span></li>
        </ul>
        <div class="linea"></div>
    </div>
    
    <div style="clear:both;height:0px;"></div>
    
    <div class="content_menu4" style="float:left;margin-left:0px;">
    	<ul class="menu_s">
        	<li><span class="boton_4"><a href="#">FRENCH</a></span></li>
            <li><span class="boton_4"><a href="#">SPANISH</a></span></li>
            <li><span class="boton_4"><a href="#">ENGLISH</a></span></li>
        </ul>
    </div>
  
    
    <div class="content_menu5"  style="float:right;margin-right:0px;">
    	<ul class="menu_s2">
        	<li><span class="boton_4"><a href="#">SIGN UP</a></span></li>
            <li><span class="boton_4"><a href="#">BLOG</a></span></li>
        </ul>
    </div>
	  </div>
	<?php
}

function getfooter(){
	?>
	 <div id="footer2">
	 	<?php
	 		if($_GET['idweb']=="blog"){
				?>
					 <div class="content_relative2" style="background-color:#e8e8e8;">
				<?php	 			
	 		}
			else{
				?>
					 <div class="content_relative2" style="background-color:#fff;">
				<?php
			}
	 	?>
	  	<div class="content_menu3_blog">
	    	<ul class="menu_p6">
	        	<li><span class="boton_3"><a href="#">ARTWORK</a></span></li>
	            <li class="bullet2"></li>
	            <li><span class="boton_3"><a href="#">CONTACT US</a></span></li>
	        </ul>
	    </div>
	   </div>
	    <div style="clear:both;height:0px;"></div>
	    
	    
	    <div class="content_relative1">
	  	<div class="linea"></div>
	    <div class="content_4">
	    	<ul class="menu_s">
	        	<li><span class="boton_4"><a href="#">FRENCH</a></span></li>
	            <li><span class="boton_4"><a href="#">SPANISH</a></span></li>
	            <li><span class="boton_4"><a href="#">ENGLISH</a></span></li>
	        </ul>
	    </div>
	    
	     <div class="social_share2">
	     	<span class="span_social"><a href="#" target="_blank"><img class="social" src="img/tw_.png" width="16" height="16" border="0"></a></span>
	        <span class="span_social"><a href="#" target="_blank"><img class="social" src="img/fb_.png" width="16" height="16" border="0"></a></span>
	        <span class="span_social"><a href="#" target="_blank"><img class="social" src="img/pinterest_.png" width="16" height="16" border="0"></a></span>
	        <span class="span_social"><a href="#" target="_blank"><img class="social" src="img/vimeo_.png" width="16" height="16" border="0"></a></span>
	  	</div>
	    
	    <div class="content_5">
	    	<ul class="menu_s2">
	        	<li><span class="boton_4"><a href="#">SIGN UP</a></span></li>
	            <li><span class="boton_4"><a href="#">BLOG</a></span></li>
	        </ul>
	    </div>
	    
	    </div>  
	   </div>  
	<?php
}

function getJpreloader(){
?>
	<script>
	$(document).ready( function() {
		var timer;	//timer for splash screen
		
		//navigation swap
		$('#navigation a').on('click', function() {
			if( !$(this).hasClass('btn-main') ) {
				$('#navigation a')
				.toggleClass('btn-secondary')
				.toggleClass('btn-main');
				
				var tar = $(this).attr('href');
				$('.holder').fadeOut(500, function() {
					$(tar).fadeIn(500);
				});
			}
			return false;
		});
		$('#set2').hide();
		$('#header').css('top', '-100px');
		$('#footer').css('bottom', '-100px');
		$('#wrapper').hide();
	
		
		//calling jPreLoader
		$('body').jpreLoader({
			showSplash: true,
			splashID: "#jSplash",
			loaderVPos: '70%',
			autoClose: true,
			closeBtnText: "Entrar",
			splashFunction: function() {  
				//passing Splash Screen script to jPreLoader
				$('#jSplash').children('section').not('.selected').hide();
				$('#jSplash').hide().fadeIn(800);
				
				timer = setInterval(function() {
					splashRotator();
				}, 4000);
			}
		}, function() {	//callback function
			clearInterval(timer);
			$('#footer')
			.animate({"bottom":0}, 500);
			$('#header')
			.animate({"top":0}, 800, function() {
				$('#wrapper').fadeIn(1000);
			});
		});
		
		//create splash screen animation
		function splashRotator(){
			var cur = $('#jSplash').children('.selected');
			var next = $(cur).next();
			
			if($(next).length != 0) {
				$(next).addClass('selected');
			} else {
				$('#jSplash').children('section:first-child').addClass('selected');
				next = $('#jSplash').children('section:first-child');
			}
				
			$(cur).removeClass('selected').fadeOut(800, function() {
				$(next).fadeIn(800);
			});
		}
	});
	</script>
	<section id="jSplash">
		<section class="selected" style="margin-top: -200px;">
			<img width="345" alt="" src="img/logo.png">
		</section>
	</section>
<?php
}

?>