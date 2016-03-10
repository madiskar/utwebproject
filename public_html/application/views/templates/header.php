<!DOCTYPE html> 
<html lang="et">
        <head>
        		<meta charset="utf-8"/>
                <title>WASDreviews | <?php echo $title; ?></title>
                <link rel="stylesheet" type="text/css" href="<?php echo $base_url; ?>public/css/style.css">
        </head>
        <body>
        <div class="navigationBar">
			<a href="<?php echo $base_url; ?>index.php">AVALEHT</a> | SIRVI MÃ„NGE |
			<a href="<?php echo $base_url; ?>index.php/register_controller">REGISTREERIMINE</a> 
			<?php if($this->session->userdata('username') == FALSE) { ?>
				| <a href="<?php echo $base_url; ?>index.php/login">MELDI SISSE</a>
			<?php }
			else {?>
				| <a href="<?php echo $base_url; ?>index.php/login/logout">LOGI VÄLJA</a>
			<?php }?>
			<div class="clearFloat"></div>
		</div>