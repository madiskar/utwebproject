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
