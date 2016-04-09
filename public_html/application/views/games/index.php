<div class="mainContainer">
<br>
<?php foreach ($games as $games_item): ?>
	<a href="<?php echo site_url('games/'.$games_item['slug']); ?>">
		<div class="gameContainer">
			<img class="gameImage" alt="<?php echo $games_item['title']; ?> ekraanipilt" src="<?php echo $base_url; ?>public/images/<?php echo $games_item['slug'].'/'.$games_item['thmb_extension']; ?>">
			<div class="gameTitle">
				<?php echo $games_item['title']; ?>
			</div>
			<br>
			<div class="gameDescription">
				<?php echo $games_item['description']; ?>
			</div>
			<br>
            <div class="gameRating">
			        <?php
						if ($games_item['average_rating'] == null){
							echo $game_rating . ": " . $games_item['mainrating'] . ".00";
						} else {
							echo $game_rating . ": " . $games_item['average_rating'];
						}
					?>
			</div>
		</div>
	</a>
<?php endforeach; ?>

<?php $jsfilepath = "".$base_url."public/js/get_new_game_".$this->session->userdata('language').".js"; 
			if($jsfilepath == "".$base_url."public/js/get_new_game_.js") {
				$jsfilepath = "".$base_url."public/js/get_new_game_estonian.js";
			}
		?>
<script src="<?php echo $jsfilepath; ?>" type="text/javascript"></script>
</div>