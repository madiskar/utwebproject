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
<ul>
  <li><a href="<?php echo $base_url; ?>index.php"><?php echo $nav_home; ?></a></li>
  <li><a href="<?php echo $base_url; ?>index.php/browse"><?php echo $nav_game_search; ?></a></li>
  <li class="dropdown">
		<?php if($this->session->userdata('username') == FALSE) { ?>
		  	<div class="nav-non-link">
				<img class="fitImage" alt="LOGI SISSE" src="<?php echo $base_url; ?>public/images/login.png">
					<div class="dropdown-content">
						<a href="<?php echo $base_url; ?>index.php/login"><?php echo $nav_login; ?></a>
						<a href="<?php echo $base_url; ?>index.php/register_controller">
							<?php echo $nav_register; ?>
						</a>
					</div>
			</div>
		<?php } else {?>
			<a href="<?php echo $base_url; ?>index.php/login/logout">
				<img class="fitImage" alt="LOGI VÄLJA" src="<?php echo $base_url; ?>public/images/logout.png">
			</a>
		<?php }?>
	</li>
  <li class="right">
  	<?php echo form_open('games/search')?>
  		<label class="largeLabel" for "searchQuery"><?php echo $nav_search; ?></label>
  		<input class="searchForm" type="text" id="searchQuery" name="searchQuery" size="25" placeholder="<?php echo $nav_search; ?>"/>

  	</form>
  </li>
  <li class="dropdown">
		  	<div class="nav-non-link">
				<?php echo $nav_language; ?>
					<div class="dropdown-content" id="lang-dropdown">
						<a href="<?php echo $base_url; ?>index.php/language/est">EESTI</a>
						<a href="<?php echo $base_url; ?>index.php/language/eng">ENGLISH</a>
					</div>
		  	</div>
	</li>
  <li class="right">
  	<?php if($this->session->userdata('is_admin') == TRUE) { ?>
		<a href="<?php echo $base_url; ?>index.php/management">
			<?php echo $admin_usermanagement; ?>
		</a>
	<?php } ?>
   </li>
  <li class="right">
  	<?php if($this->session->userdata('is_admin') == TRUE) { ?>
		<a href="<?php echo $base_url; ?>index.php/games/add">
			<?php echo $admin_addgames; ?>
		</a>
		<?php } ?>
	</li>
</ul>