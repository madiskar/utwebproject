<div class="mainContainer">
<?php $xml = simplexml_load_file('/webpages/wasdreviewscsut/public_html/public/xml/stats.xml'); ?>

	<div class="statItem">
		<?php echo $gamecount . " - " . $xml->gamecount; ?>
	</div>
	<div class="statItem">
		<?php echo $usercount . " - " . $xml->usercount; ?>
	</div>
	<div class="statItem">
		<?php echo $reviewcount . " - " . $xml->reviewcount; ?>
	</div>
</div>