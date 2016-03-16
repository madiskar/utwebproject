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
							echo "Hinnang: " . $games_item['mainrating'] . ".00";
						} else {
							echo "Hinnang: " . $games_item['average_rating'];
						}
					?>
			</div>
		</div>
	</a>
<?php endforeach; ?>

</div>