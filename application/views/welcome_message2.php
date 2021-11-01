<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?><!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">

	<title>Antrian2</title>

	<style type="text/css">
		button
		{
			padding: 20px 15px 20px 15px;
		}
	</style>
</head>
<body>
<form class="form-horizontal" action="<?php echo $form; ?>" method="post" id="form1">
<input type="hidden" name="no" value="<?php echo $no; ?>"/>
<button ><img src="<?php echo base_url().'print.jpg'?>" alt="PRINT" width="400 "></button>
</form>

</body>
</html>