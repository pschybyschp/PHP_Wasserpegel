<!DOCTYPE html>
<html lang="en-us">
<head>   
	<meta charset="utf-8">   
	<meta http-equiv="X-UA-Compatible" content="IE=edge">   
	<meta name="viewport" content="width=device-width, initial-scale=1">   
	<!-- Die 3 Meta-Tags oben *müssen* zuerst im head stehen; jeglicher sonstiger head-Inhalt muss *nach* diesen Tags kommen -->   
	<meta name="keywords" lang="en-us" content="Water gauge, Inland waterway, Transport logistics, Baltic sea, North sea, elbe">   
	<meta name="description" lang="en-us" content="Check water gauge level for all seas, rivers and canals in Germany">   
	<meta name="author" content="PP">   
	<title>Logistikjunge - Wasserpegel/Watergauge</title>   <!-- Bootstrap-CSS -->   
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">   
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>   
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>   
    <script>
			// shows all matched elements
		$(document).ready(function(){
			$("#btn_show").click(function(){
				texts = $('.text-block');
				texts.show(); 
			});	
		// hides all matched elements
			$("#btn_hide").click(function(){
				//$("#live_data").hide();
				texts = $('.text-block');
				texts.hide(); 
			});
		});
    </script>
</head>   
<body>			
	<div class="container-fluid cont_top">	
	<div class="row-fluid">
		</br>
 <!--<div class="table-responsive container">-->
	<div class="panel panel-default">
			<div class="panel-heading">
				<div lang="en" class="en_content">Search for locations of water gauge record stations in Germany by water, river or canal</div>
				<div lang="de" style="display: none;"class="de_content">Suche nach Wasserstands-Messstationen in Deutschland nach Seen, Flüssen und Kanälen</div>
			</div>
					<table class="table table-hover ">
						<tr>
							<td><div lang="en" class="en_content">Water/River/Canal: </div><div lang="de" style="display: none;"class="de_content">See/Fluss/Kanal: </div></td>
							<td>
								<form id="search-form" class="input-group" action="WSV_pegel_results.php" method="get">
									<select id="search-query" type="text" class="form-control"  name="waters">
										<option label="ALL"></option>
										<optgroup label="Water/See">
											<option>Nordsee</option>
											<option>Ostsee</option>
										</optgroup>	
										<optgroup label="River/Fluss">
											<option>Donau</option>
											<option>Elbe</option>
											<option>Ems</option>
											<option>Este</option>
											<option>Fulda</option>
											<option>Hunte</option>
											<option>Ilmenau</option>
											<option>Jade</option>
											<option>Main</option>
											<option>Mosel</option>
											<option>Neckar</option>
											<option>Oder</option>
											<option>Rhein</option>
											<option>Saale</option>
											<option>Weser</option>
										</optgroup>	
										<optgroup label="Canal/Kanal">
											<option>Berlin-Spandauer-Schifffahrtskanal</option>
											<option>Dortmund-Ems-Kanal</option>
											<option>Elbe-Havel-Kanal</option>
											<option>Elbeseitenkanal</option>
											<option label="Elbe-Lübeck-Kanal" value ="ELK"></option>
											<option>Havelkanal</option>
											<option label="Havel-Oder-Wasserstraße" value ="HOW"></option>
											<option label="Küstenkanal" value ="küstenkanal"></option>
											<option>Landwehrkanal</option>
											<option>Main-Donau-Kanal</option>
											<option label="Mittellandkanal" value ="MLK"></option>
											<option value ="NSK">Neuhauser Speisekanal</option>
											<option label="Nordostseekanal" value ="Nord-Ostsee-Kanal"></option>
											<option label="Oranienburger Kanal" value ="ORK"></option>
											<option label="Obere-Havel-Wasserstraße" value ="OHW"></option>
											<option label="Pareyer Verbindungskanal" value ="PVK"></option>
											<option>Rhein-Herne-Kanal</option>
											
										</optgroup>
								</select>									
								<span class="input-group-btn">
									<button class="btn btn-primary" type="submit">
										<div lang="en" class="en_content">Search</div>
										<div lang="de" style="display: none;"class="de_content">Suche</div>
									</button>
								</span>
								</form>
							</td>
						</tr>
						<tr>
							<td>
								<div lang="en" class="en_content">Show/Hide</br> Live-Data:</div>
								<div lang="de" style="display: none;"class="de_content">Zeigen/Verbergen</br> Live-Daten:</div>
							</td>
							<td>
								<button id='btn_show' type='button' class='btn btn-primary btn-sm'><span class='glyphicon glyphicon-plus'><button id='btn_hide' type='button' class='btn btn-primary btn-sm'>
								<span class='glyphicon glyphicon-minus'></span></button>
							</td>
						</tr>
						<tr bgcolor=#F5F5F5>
							<td>
								<div lang="en" class="en_content">Results: </div>
								<div lang="de" style="display: none;"class="de_content">Ergebnisse: </div>
							</td>
							<td>
								<?php
									error_reporting(0);
									$url = 'https://www.pegelonline.wsv.de/webservices/rest-api/v2/stations.json?includeTimeseries=true&includeCurrentMeasurement=true';
									$curl = curl_init();
									//$headers = array(
									//	'Accept: application/json',
									//	'Content-Type: application/json',
									//);
									curl_setopt($curl, CURLOPT_URL, $url);
									//curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
									curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
									curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false);
									curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
									$response = curl_exec($curl);

									$code = curl_getinfo($curl, CURLINFO_HTTP_CODE);
									
									curl_close($curl);

									if ($code == 200) {
										$response = json_decode($response, true);
										//print_r($response);
									//echo $response;
									} else {
										echo 'error ' . $code;
									};
									$Anzahl = count($response);
									echo 'Total-Number of record stations ' .$Anzahl;											
									$my_file = 'wsv.json';
									$handle = fopen($my_file, 'w') or die('Cannot open file:  '.$my_file);

									fwrite($handle, json_encode($response));

									$string = file_get_contents("wsv.json");
									
									$jsonRS = json_decode ($string,true);
									//echo json_encode($jsonRS);



									//$my_fila = 'wsv.json';
									$timestamp = filemtime($my_file);								
									echo '. Timestamp of Datasource ' .date("Y-m-d H:i:s",$timestamp).'</td></tr></table>' ;

									echo "  <div class='table-responsive'> <table  class='table table-hover' >
									
									<tr style='background-color:#C0C0C0'>
										<td colspan=1 >Record station<td><td colspan=2>Source distance</td>
										<td colspan=2>Coordinates</td>
									</tr>
									<tr style='background-color:#C0C0C0'>
										<td>Shortname</td><td>Longname</td>
										<td>km</td>
										<td>Agency</td>
										<td>Latitude</td>
										<td>Longitude</td>
									</tr>
									";

									for($i = 0; $i < $Anzahl; $i++) {
											echo "<tr><td>".stripslashes($jsonRS[$i]['shortname'])."</td>";
											echo "<td>".stripslashes($jsonRS[$i]['longname'])."</td>";
											echo "<td>".stripslashes($jsonRS[$i]['km'])."</td>";
											echo "<td>".stripslashes($jsonRS[$i]['agency'])."</td>";
											echo "<td>".stripslashes($jsonRS[$i]['latitude'])."</td>";
											echo "<td>".stripslashes($jsonRS[$i]['longitude'])."</td></tr>";

											$timeseries = $jsonRS[$i]["timeseries"]; //currentMeasurement is a JSON-Array
												foreach ($timeseries as $msm) {
													$Watergauge = $msm["currentMeasurement"]; //currentMeasurement is a JSON-Object
														echo "<tr class='text-block'  style='display:none'>
															<td bgcolor=#F5F5F5></td><td colspan='2' bgcolor='grey'><b>".stripslashes($msm["longname"]).": </b>".stripslashes($Watergauge["value"])." ".stripslashes($msm["unit"])."", "</td>
															<td bgcolor='grey'><b>Live-Data-Timestamp:</b></td>
															<td colspan='2' bgcolor='grey'>".substr(stripslashes($Watergauge["timestamp"]),0,16)."</td>
															</tr>";
																			}								  
																	}								
												
													echo "</table></div>";
								?>
	</div>
	</div>	
	</div>	
	<footer>
	</footer> 		
</body>
</html>