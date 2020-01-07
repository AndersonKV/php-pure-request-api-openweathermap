<?php 

$data = null;

if(isset($_GET['city'])) {
error_reporting(E_ERROR | E_WARNING | E_PARSE);

	$apiKey = 'c9e521ce9d19eaee59d2bac74f6410a9';

	$getCity = htmlspecialchars($_GET["city"]);
	$googleApi = 'http://api.openweathermap.org/data/2.5/weather?q=' . $getCity .'&APPID=' . $apiKey;

	//foi necessaria por causa Undefined variable

	if(@!file_get_contents($googleApi)) {
		$error = ' ocorreu algum problema :(';
	} else {
		$json = file_get_contents($googleApi);
		$data = json_decode($json,true);
	}

	// echo $data['name'] . '<br>';
	// echo $data['sys']['country']. '<br>';
	// //description
	// echo $data['weather'][0]['description'] . '<br>';
	// //temperature
	// echo $data['main']['temp'];
}   

 

?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Clima tempo</title>
	<link rel="stylesheet" type="text/css" href="css/styles.css">
	<!-- font awesome -->
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.0/css/all.css"> 
</head>
<body>

<nav>
	<h5>CLIMATEMPO</h5>
</nav>

<form method="GET">
	<div class="input-group">
		<input id="city" type="text" name="city" placeholder="digite o nome da cidade..." >

		<div>
			<input type="submit" value=""><i class="fas fa-search"></i>
		</div>
	</div>
</form>

<div class="my-container animation">
 
 
<?php if (isset($_GET['city'])): ?>

	<!-- se der erro, exibi a msg, se não exibi o sucesso -->
	<?php if(!$data): ?>
		<div class="text-red">
			<h1><?php echo $error;  ?></h1>
		</div>
	<?php else: ?> 

		<h5><?php echo $data['name'] ?> - <?php echo $data['sys']['country'] ?></h5>

		<div class="container-weather">
			<div class="text-date">
				<span><?php echo date('d/m/Y')?></span>
				<span> <?php echo $data['weather'][0]['description']?></span>
			</div>
			<div class="icons-weather">
				<span>
					<i class="fas fa-arrow-up"></i>
					<?php echo substr($data['main']['temp_max'], 0, 2)?>ºC
				</span>

				<span>
					<i class="fas fa-arrow-down"></i>
					<?php echo substr($data['main']['temp_min'], 0, 2)?>ºC
				</span>

				<span>
					<i class="fas fa-tint"></i> 
					<?php echo $data['main']['humidity']?>mm
				</span>

				<span>
					<i class="fas fa-umbrella"></i>
					null
				</span>
			</div> 
		</div>
	<?php endif; ?>

  
 
<?php endif; ?>

 
 
</div>
 

</div>

</body>
</html>


 