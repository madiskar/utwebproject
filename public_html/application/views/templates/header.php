<!DOCTYPE html> 
<html lang="et">
        <head><meta charset="utf-8"/>
        		
                <title>WASDreviews | <?php echo $title; ?></title>
                
                <link href='https://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css'>
                <link rel="stylesheet" type="text/css" href="<?php echo $base_url; ?>public/css/style.css">
                
               	<script defer src="<?php echo $base_url; ?>public/js/script.js" type="text/javascript"></script>                
	        <script defer type="text/javascript" src="//ajax.googleapis.com/ajax/libs/jquery/1.6.2/jquery.min.js"></script>
		<script defer src="<?php echo $base_url; ?>public/js/jqueryFallback.js"></script>           	
	        <script defer src="<?php echo $base_url; ?>public/js/connection.js" type="text/javascript"></script>
	        <script defer src="<?php echo $base_url; ?>public/js/connectionChecker.js" type="text/javascript"></script>
             
        </head>
        <body>
<ul>
  <li><a href="<?php echo $base_url; ?>index.php" <?php if($active_tab==1) echo 'id="activeTab"'; ?>><?php echo $nav_home; ?></a></li>
  <li><a href="<?php echo $base_url; ?>index.php/browse" <?php if($active_tab==2) echo 'id="activeTab"'; ?>><?php echo $nav_game_search; ?></a></li>
    <li><a href="<?php echo $base_url; ?>index.php/about" <?php if($active_tab==3) echo 'id="activeTab"'; ?>><?php echo $nav_about; ?></a></li>
  <li class="dropdown" <?php if($active_tab==6) echo 'id="activeTab"'; ?>>
		<?php if($this->session->userdata('username') == FALSE) { ?>
		  	<div class="nav-non-link">
				<img class="fitImage" alt="LOGI SISSE" src="<?php echo $base_url; ?>public/images/login.png">
					<div class="dropdown-content" id="login-dropdown">
						<a href="<?php echo $base_url; ?>index.php/login"><?php echo $nav_login; ?></a>
						<a href="<?php echo $base_url; ?>index.php/register_controller">
							<?php echo $nav_register; ?>
						</a>
					</div>
			</div>
		<?php } else {?>
			<a href="<?php echo $base_url; ?>index.php/login/logout">
				<img class="fitImage" alt="LOGI V�LJA" src="<?php echo $base_url; ?>public/images/logout.png">
			</a>
		<?php }?>
	</li>
  <li class="right">
  	<?php echo form_open('games/search')?>
  		<label class="largeLabel" for="searchQuery">&nbsp;</label>
  		<input class="searchForm" type="text" id="searchQuery" name="searchQuery" size="25" placeholder="<?php echo $nav_search; ?>"/>

  	</form>
  </li>
  <li class="dropdown">
		  	<a href="#" class="dropbtn"><?php echo $nav_language; ?></a>
					<div class="dropdown-content">
						<a href="<?php echo $base_url; ?>index.php/language/est">EESTI</a>
						<a href="<?php echo $base_url; ?>index.php/language/eng">ENGLISH</a>
					</div>
		  	
	</li>
  <li class="right" <?php if($active_tab==5) echo 'id="activeTab"'; ?>>
  	<?php if($this->session->userdata('is_admin') == TRUE) { ?>
		<a href="<?php echo $base_url; ?>index.php/management">
			<?php echo $admin_usermanagement; ?>
		</a>
	<?php } ?>
   </li>
  <li class="right" <?php if($active_tab==4) echo 'id="activeTab"'; ?>>
  	<?php if($this->session->userdata('is_admin') == TRUE) { ?>
		<a href="<?php echo $base_url; ?>index.php/games/add">
			<?php echo $admin_addgames; ?>
		</a>
		<?php } ?>
	</li>
</ul>