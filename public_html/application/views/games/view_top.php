		<div class="mainContainer">
			
			<div class="reviewPageContainer">
				<div class="reviewPageTitle">
					<?php echo $games_item['title']; ?>
					<?php if($this->session->userdata('is_admin') == TRUE) { ?>
						<a id="deleteForReal" href="<?php echo site_url('games/remove_game/'.$games_item['id']); ?>">
							<?php echo $admin_remove_game; ?>
						</a>
						<a id="deleteButton" href="#void" onclick="showDelete();">
							X
						</a>
					<?php } ?>
				</div>
				<div class="reviewPageLargeScreenshotContainer">
					<img alt="Ekraanipilt" id="reviewPageGameImage" src="<?php
						$pieces = explode(" ", $games_item['scrsht_extensions']);
						echo $base_url.'public/images/'.$games_item['slug'].'/screenshot1'.$pieces[0];
					?>" class="reviewPageLargeScreenshot">
				</div>
				<div class="reviewPageDescription">
					<?php echo $games_item['description']; ?>
					<hr>
					<?php
						$pieces = explode(" ", $games_item['scrsht_extensions']);
						$i = 1;
						foreach ($pieces as $piece){
							echo '<a href="#void" onclick="changeLargeImage(\''.$base_url.'public/images/'.$games_item['slug'].'/screenshot'.$i.''.$piece.'\');">';
							echo '<img alt="Ekraanipilt" src="'.$base_url.'public/images/'.$games_item['slug'].'/screenshot'.$i.''.$piece.'" class="reviewPageSmallScreenshot">';
							echo '</a>';
							$i += 1;
						}
					?>
				</div>
				
				<div class="reviewMain">
					<br>
					<hr>
					<h2><?php echo $game_admin_review?></h2>
					

					<p><?php echo $games_item['mainrev']; ?></p>
					<h2><?php echo $game_final_rating . " " . $games_item['mainrating']; ?>/10</h2><br>