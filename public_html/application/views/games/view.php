		<div class="mainContainer">
			
			<div class="reviewPageContainer">
				<div class="reviewPageTitle">
					<?php echo $games_item['title']; ?>
				</div>
				<div class="reviewPageLargeScreenshotContainer">
					<img alt="Ekraanipilt" src="screenshots/dxhr1.jpg" class="reviewPageLargeScreenshot">
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
					<hr>
					<h2>Oma arvustuse jätmiseks logi sisse</h2>
					<hr>
					<?php foreach ($reviews as $review_item): ?>
						<h2>Arvustus kasutaja <?php echo $review_item['username']; ?> poolt:</h2>
							<p><?php echo $review_item['review'];?></p>
                        <h2> Lõpphinnang: <?php echo $review_item['rating']?></h2>
						<hr>
					<?php endforeach; ?>
					<br>
				</div>
			</div>
			<br>
		</div>

