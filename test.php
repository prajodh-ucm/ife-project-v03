<!DOCYTYPE html>
<html>
	<head>
		<meta chaset="UTF-8">
		<title>Test</title>
	</head>
	<body>
		<?php
			$number = 21;
			$formatedNumber = sprintf('%05d',$number);
			echo $formatedNumber;
		?>
	</body>
</html>