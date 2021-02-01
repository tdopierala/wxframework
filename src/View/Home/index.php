<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>wxframework : Home</title>
</head>
<body>
	<h1>Hallo <?= $name ?></h1>
	<p>
		<ul>
		<?php foreach ($colours as $color) { ?>
			<li><?= $color ?></li>
		<?php } ?>
		</ul>
	</p>
</body>
</html>