		<div class="mainContainer">
			
			<div class="reviewPageContainer">
				<div class="reviewPageTitle">
					<?php echo $games_item['title']; ?>
				</div>
				<div class="reviewPageLargeScreenshotContainer">
					<img alt="Ekraanipilt" src="<?php echo $base_url; ?>public/images/TEMP_screenshot.png" class="reviewPageLargeScreenshot">
				</div>
				<div class="reviewPageDescription">
					<?php echo $games_item['description']; ?>
					<hr>
					muud skriinshotid siia
				</div>
				
				<div class="reviewMain">
					<br>
					<hr>
					<h2>Meie Arvustus</h2>
					

					<p><?php echo $games_item['mainrev']; ?></p>
					<h2>Lõpphinnang: <?php echo $games_item['mainrating']; ?>/10</h2>