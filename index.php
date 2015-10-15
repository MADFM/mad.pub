<?php


error_reporting(0);
header('Content-type: text/html; charset=UTF-8');

include './inc/config.inc.php';

?>

<!DOCTYPE html>
<html>

<head>
	<title>MADFM - MADTV | MAD.fm | Радио</title> 
<meta name="description" content="Лучшее радио рунета формата mad. Нас знают как madfm, mad.pub, madtv, mad.fm и др. Качественные эфиры и интервью"> 
<meta name="keywords" content="mad, maddyson, maddysonfm, радио, сумасшедшее радио, crazy radio, mad radio, radio online, madtv, madfm, mad.fm"> 
<meta name="author" content="MAD.fm"> 
<meta http-equiv="content-language" content="ru"/> 
<meta charset="utf-8">
	<link rel="stylesheet" href="style/style.css">
	<script src="js/jquery.min.js"></script>
	<script type="text/javascript" src="//vk.com/js/api/openapi.js?105"></script>
<script type="text/javascript">
VK.init({apiId: 4848095, onlyWidgets: true});
</script>
	<script src="js/jquery-ui.min.js"></script>
	<script>
		$('document').ready(function () {
			function refreshSwatch() {
    			document.getElementById('audio').volume = $('#cont').slider('value') / 100; 
  			}
			$('#cont').slider({
				orientation: "horizontal",
				range: "min",
				max: 100,
				value: 50,
				slide: refreshSwatch,
				change: refreshSwatch
			});
		});
	</script>

	<script type="text/javascript">
					var data2 = <?php
$s = file_get_contents("http://mad.pub:8000/info.xsl");
echo(($s));
?>;

function append_2nd(data2) {
	if (data2['/live'].name=="") {

		try {
			 document.getElementsByClassName("block")[2].innerHTML=data2['/play'].listeners;
			 document.getElementsByClassName("block")[0].innerHTML=data2['/play'].title
			} catch(e) {
				document.getElementsByClassName("block")[2].innerHTML=data2['/live'].listeners;
				document.getElementsByClassName("block")[0].innerHTML=data2['/live'].title
			}
							   

							  } else{
							    
							  	try {
			 document.getElementsByClassName("block")[2].innerHTML=data2['/live'].listeners;
			 document.getElementsByClassName("block")[0].innerHTML=data2['/live'].title
			} catch(e) {
				document.getElementsByClassName("block")[2].innerHTML=data2['/play'].listeners;
				document.getElementsByClassName("block")[0].innerHTML=data2['/play'].title
			}

							  };
}

setTimeout('append_2nd(data2);', 500)




					</script>
					<script type="text/javascript">
							var data;
							var socket = new WebSocket("ws://mad.pub:8081");

							function append(msg) {
							  data=JSON.parse(msg); 
							  if (data['/live'].name=="") {
							    document.getElementsByClassName("block")[2].innerText=data['/play'].listeners;
							    document.getElementsByClassName("block")[0].innerHTML=data2['/play'].title

							 //   document.getElementsByClassName("rj-pic")[0].src="./images/rj.png"

							  } else{
							    document.getElementsByClassName("block")[2].innerText=data['/live'].listeners;
							    document.getElementsByClassName("block")[0].innerHTML=data2['/live'].title
							 //   document.getElementsByClassName("rj-pic")[0].src="./images/"+data['/live'].name+".png"
							  };

							}

							socket.onmessage = function(event) {

							  var incomingMessage = event.data;
							  append(incomingMessage);

							};

//	setInterval(function() { socket.send(0); }, 2000);
						</script>

</head>


<body>
	<header>
		<a id="logo" href="#"></a>
		<nav>
			<ul>
				<li><a href="./">Радио</a></li>
				<li><a href="./?page=rasp">Расписания</a></li>
				<li><a target="_blank" href="https://vk.com/audios-67171409">Записи эфиров</a></li>
				<li><a href="./?page=">Подкасты</a></li>
				<li><a href="./?page=ved">Ведущие</a></li>
				<li><a target="_blank" href="http://www.youtube.com/channel/UCBsTxwFBCjPFOqGArQeofAA">Наш канал</a></li>
				<li><a href="./?page=stream">Стримы</a></li>
				<li><a href="./?page=faq">FAQ</a></li>
				<li><a href="./?page=cont">Контакты</a></li>
			</ul>
		</nav>
	</header><main></main>
	<content>
		<div class="container">
			<div id="lb">
				<div class="header" style="font-size: 48px;">Плейлист</div> 
<div class="block"> 
	<div class="module">
		<span class="center">АК47 - Бойся 228, если пудришь носик</span>
	</div> 
</div>
				<div class="header" style="font-size: 24px;">Следующий в эфире</div>
				<div class="block">
					<div class="module"><span class="left">
						<?php 

						date_default_timezone_set('Europe/Moscow');

						$next_rj_time = split(":", date("l H:i", strtotime("+60 minutes")))[0];
						//echo $next_rj_time;
						$query = "SELECT * FROM rjs WHERE rj_time LIKE '%".$next_rj_time."%'";
						//echo $query;
						$result = mysql_query($query) or die('query error');
						$result = mysql_fetch_array($result);

						if ($result != False) {
							
							$result_date = $result['rj_time']." - ".$result['rj_name'];
							$result_date = split(" - ", $result_date);
							echo $result_date[1]." ".$result_date[2].'</span> <span class="right"><a target="_blank" href="https://vk.com/maddysonfm">АНОНС</a></span>';
							mysql_free_result($result);

							

						} else {
							echo "Нет эфиров в ближайшее время!";
							mysql_free_result($result);
						}
						
						?>

					</div>
				</div>
				<div class="header">Количество слушателей</div>
				
						
				<div class="block">
					228
					
				</div>
				<div class="header" style="font-size: 26px;">Послушайте также</div>
				<div class="block">
					<?php

						$query = 'SELECT * FROM `rjs` WHERE rj_descr != "???" ORDER by RAND() LIMIT 1,1';
						$result = mysql_query($query) or die('query error');
						$result = mysql_fetch_array($result);

						echo '<img width="175" height="175" src="images/'.$result['rj_img'].'.png">';
						mysql_free_result($result);

					?>

				</div>
				<div class="header anote">Глобальные события</div>
				<div class="block">
					<?php

						$query = 'SELECT * FROM `events` ORDER by id LIMIT 1,1';
						$result = mysql_query($query) or die('query error');
						$result = mysql_fetch_array($result);

						echo $result['summary'];
						echo '<br><a class="bottom_link" href="'.$result['link'].'">Пост с подробностями</a>';
						mysql_free_result($result);
					?>
				</div>
			</div>
			<div id="cb">
				


<?php

switch (@$_GET['page']) {
	case 'main':
		include './inc/main.php';
		break;

	case 'faq':
		include './inc/faq.php';
		break;

	case 'cont':
		include './inc/cont.php';
		break;

	case 'ved':
		include './inc/ved.php';
		break;

	case 'rasp':
		include './inc/rasp.php';
		break;
	
	case 'stream':
		include './inc/stream.php';
		break;

	default:
		include './inc/main.php';
		break;
}



?>



			</div>
			<div id="rb">
				<div class="block">
					<a target="_blank" href="http://mad.pub/donat.php"><img src="images/donate.png"></a>
				</div>
				<div class="header" style="font-size: 32px;">TOP DONATORS</div>
				<div class="block">
					<?php
						
						$result = mysql_query("SELECT donator_name, donator_sum FROM donators ORDER BY donator_sum DESC");

						while ($row = mysql_fetch_array($result, MYSQL_NUM)) {
						    printf('<span class="left">%s</span> <span class="right">%s</span><br>', $row[0], $row[1]);
						}

						mysql_free_result($result);

					?>
				</div>
				<div class="header" style="font-size: 30px;">Мы в соц. сетях</div>
				<div class="block">
					<a target="_blank" href="https://vk.com/maddysonfm"><img class="left" src="images/vk.png"></a>
					<a target="_blank" href="https://www.youtube.com/channel/UCBsTxwFBCjPFOqGArQeofAA"><img class="right" src="images/you.png"></a>
				</div>
			</div>
		</div>
	</content>
	
<script>
setInterval(function() { 
var check = ($('#cb').innerHeight() + $('#cbvk').innerHeight()) - $('#rb').innerHeight(); 
if (check > 0) { 
$('#rb').css('margin-bottom', (check + 20)); 
} 
}, 200);
</script>
</body>


</html>
