<!DOCTYPE html> 
<html lang="et">
        <head>
        		<meta charset="utf-8"/>
                <title>WASDreviews | <?php echo $title; ?></title>
                <link rel="stylesheet" type="text/css" href="<?php echo $base_url; ?>public/css/style.css">
                
                <script src="<?php echo $base_url; ?>public/js/jquery.js" type="text/javascript"></script>
                <script src="<?php echo $base_url; ?>public/js/script.js" type="text/javascript"></script>
        </head>
        <body>
        <div class="navigationBar">
			<a href="<?php echo $base_url; ?>index.php">AVALEHT</a> | SIRVI MÃ„NGE |
			<a href="<?php echo $base_url; ?>index.php/games/add">LISA MÄNG</a> | 
			<a href="<?php echo $base_url; ?>index.php/register_controller">REGISTREERIMINE</a> 
			<?php if($this->session->userdata('username') == FALSE) { ?>
				| <a href="<?php echo $base_url; ?>index.php/login">MELDI SISSE</a>
			<?php }
			else {?>
				| <a href="<?php echo $base_url; ?>index.php/login/logout">LOGI VÄLJA</a>
			<?php }?>
			<?php if($this->session->userdata('is_admin') == TRUE) { ?>
				| <a href="<?php echo $base_url; ?>index.php/management">HALDA KASUTAJAID</a>
			<?php } ?>
			<div class="clearFloat"></div>
		</div>