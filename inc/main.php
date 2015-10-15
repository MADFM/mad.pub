<script type="text/javascript">
document.getElementsByTagName("li")[0].className="active";
if (location.href != "http://mad.pub/" ){ location.href="http://mad.pub/"; }
</script>


				<div class="right">
					<script src="js/jquery.playlist.js"></script>
                <script>$(document).ready(function() {
                    $('#audio').playlistParser();
                });</script>
					<div id="player">
						<div id="play" onclick="document.getElementById('audio').play(); this.style.display='none'; document.getElementById('pause').style.display='block';"></div>
						<div id="pause" onclick="document.getElementById('audio').pause(); this.style.display='none'; document.getElementById('play').style.display='block';"></div>
						<div id="cont">
						</div>
						<audio id="audio">
							<source src="http://mad.pub:8000/live">
						</audio>
					</div>

<?php 

$s = json_decode(file_get_contents("http://mad.pub:8000/info.xsl"), true);
if ($s['/live']['name'] != "") {

	$rj = $s['/live']['name'];
	$query = sprintf("SELECT * FROM rjs WHERE rj_name='%s'", mysql_real_escape_string($rj));
	$result = mysql_query($query) or die('query error');
	$result = mysql_fetch_array($result);

	$rj_img = $result['rj_img'];
	mysql_free_result($result);


	echo '<img class="rj-pic" width="180" height="192" src="images/'.$rj_img.'.png">';

} else {


	echo '<img class="rj-pic" width="180" height="192" src="images/rj.png">';

}


					?></div>
</div>
<div id="cbvk">
<div id="vk_comments" style="margin: 0 auto;"></div><script type="text/javascript">
VK.Widgets.Comments("vk_comments", {limit: 10, width: "600", attach: "*"});
</script>