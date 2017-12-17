<?php
require_once("ReadBlackWhite.php");

$active = false;
if (isset($_POST['send'])) {
	$link = $_POST['link'];
	$a = new ReadBlackWhite($link);
	$active = true;
}else {
	$link = 'test.png';
	$a = new ReadBlackWhite($link);
	$active = true;
}

?>
<!doctype html>
<html lang="ru">
  <head>
    <title>Read Black White</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/css/bootstrap.min.css" integrity="sha384-PsH8R72JQ3SOdhVi3uxftmaW6Vc51MKb0q5P2rRUpPvrszuE4W1povHYgTpBfshb" crossorigin="anonymous">
    <link rel="stylesheet" href="style.css" >
  </head>
  <body>
	
	<div class="wrap">
		<div class="container content">
			<h4>Считывание черных и белых пикселей</h4>
			<form action="" method="POST">
				<div class="form-group">
					<label for="link">Ссылка на картинку (png, jpg)</label>
					<div class="row">
						<div class="col-9">
							<input class="form-control" id="link" name="link" placeholder="Вставьте ссылку на изображение" required>
						</div>
						<div class="col-3">
							<button type="submit" name="send" class="btn btn-primary btn-block">Считать</button>
						</div>
					</div>
				</div>
			</form>
			<?php if ($active) { ?>
				<ul class="list-group">
					<!--<li class="list-group-item">Всего точек: <?=$a->allPoints?></li>-->
					<li class="list-group-item img-item"><img class="image" src="<?=$link?>" /></li>
					<li class="list-group-item">Черных пикселей: <?=$a->black?> (<?=$a->percentBlack?>%)</li>
					<li class="list-group-item">Белых пикселей: <?=$a->white?> (<?=$a->percentWhite?>%)</li>
				</ul>
				<br>
				<div class="myChart">
					<canvas id="myChart"></canvas>
				</div>
				<br>
			<?php } ?>
		</div>
	</div>
	<footer class="footer">&copy; Сейтқали Бекжан 2017</footer>

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.3/umd/popper.min.js" integrity="sha384-vFJXuSJphROIrBnz7yo7oB41mKfc8JzQZiCq4NCceLEaO4IHwicKwpJf9c9IpFgh" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/js/bootstrap.min.js" integrity="sha384-alpBpkh1PFOepccYVYDB4do5UnbKysX5WZXm3XxPqe5iKTfUKjNkCk9SaVuEZflJ" crossorigin="anonymous"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.4.0/Chart.min.js"></script>
	<?php if ($active) { ?>
	<script>
		var ctx = document.getElementById('myChart').getContext('2d');
		var chart = new Chart(ctx, {
			// The type of chart we want to create
			type: 'pie',

			// The data for our dataset
			data: {
				labels: ["Белый", "Черный"],
				datasets: [{
					label: ["Белый", "Черный"],
					backgroundColor: ['#ff6384', '#36a2eb'],
					borderColor: ['#ff6384', '#36a2eb'],
					data: [<?=$a->white?>, <?=$a->black?>],
				}]
			},

			// Configuration options go here
			options: {}
		});
	</script>
	<?php } ?>
  </body>
</html>