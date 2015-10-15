<script type="text/javascript">
document.getElementsByTagName("li")[4].className="active";
</script>
				<h1>Ведущие</h1>

<?php

$rjs = array();

						$query = 'SELECT rj_name, rj_img, rj_descr FROM `rjs` WHERE rj_descr != "???" ORDER by rj_pos';
						$result = mysql_query($query) or die('query error');

						while ($row = mysql_fetch_array($result, MYSQL_NUM)) {
						    $rjs[count($rjs)] = array("rj_name" => $row[0], "rj_img" => $row[1], "rj_descr" => $row[2]);
						    
						}

						$rjs = array_unique($rjs, SORT_REGULAR);
						
						foreach ($rjs as $key => $rj) {
							echo '<div class="block"><img alt="'.$rj["rj_name"].'" src="images/'.$rj["rj_img"].'.png"><p>'.$rj["rj_descr"].'</p></div>';

						}


					?>