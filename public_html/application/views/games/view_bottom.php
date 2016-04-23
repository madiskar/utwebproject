				<br>

					<div id="reviewPlaceHolder">
					</div>
					
					<br>
								</div>
			</div>
			<br>
		</div>

		<?php $jsfilepath = "".$base_url."public/js/load_reviews_".$this->session->userdata('language').".js"; 
			if($jsfilepath == "".$base_url."public/js/load_reviews_.js") {
				$jsfilepath = "".$base_url."public/js/load_reviews_estonian.js";
			}
		?>
		<script defer src="<?php echo $jsfilepath; ?>" data-gameid="<?php echo $games_item['id']; ?>"></script>
