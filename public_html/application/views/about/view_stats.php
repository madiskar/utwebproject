<div class="mainContainer">
<div class="headLineItem"><h3> <?php echo $statstuff; ?> </h3></div>
<?php $xml = simplexml_load_file('/webpages/wasdreviewscsut/public_html/public/xml/stats.xml'); ?>

	<div class="statItem">
		<?php echo $gamecount . " - " . $xml->genrecount->total_count; ?>
	</div>	
	<div class="substatItem">
		<?php echo $gamecount1 . " - " . $xml->genrecount->action_count; ?>
	</div>
	<div class="substatItem">
		<?php echo $gamecount2 . " - " . $xml->genrecount->adventure_count; ?>
	</div>
	<div class="substatItem">
		<?php echo $gamecount3 . " - " . $xml->genrecount->casual_count; ?>
	</div>
	<div class="substatItem">
		<?php echo $gamecount4 . " - " . $xml->genrecount->indie_count; ?>
	</div>
	<div class="substatItem">
		<?php echo $gamecount5 . " - " . $xml->genrecount->mmo_count; ?>
	</div>
	<div class="substatItem">
		<?php echo $gamecount6 . " - " . $xml->genrecount->racing_count; ?>
	</div>
	<div class="substatItem">
		<?php echo $gamecount7 . " - " . $xml->genrecount->rpg_count; ?>
	</div>
	<div class="substatItem">
		<?php echo $gamecount8 . " - " . $xml->genrecount->simulation_count; ?>
	</div>
	<div class="substatItem">
		<?php echo $gamecount9 . " - " . $xml->genrecount->sports_count; ?>
	</div>
	<div class="substatItem">
		<?php echo $gamecount10 . " - " . $xml->genrecount->strategy_count; ?>
	</div>
	
		
	<div class="statItem">
		<?php echo $usercount . " - " . $xml->usercount; ?>
	</div>
	<div class="statItem">
		<?php echo $reviewcount . " - " . $xml->reviewcount; ?>
	</div>
	<div class="statItem">
		<?php echo $mostactive . " - " . $xml->mostactive->username . " (" . $xml->mostactive->userreviewcount . " " . $howmany . ")"; ?>
	</div>
	<br>
</div>