  <script>
  function vote(id, value) { // function vote with 2 arguments: article ID and value (+1 or -1) depending if you clicked on the arrow up or down
	var dataFields = {'id': id, 'value': value}; // We pass the 2 arguments
	$.ajax({ // Ajax
		type: "POST",
		url: "questions/test",
		data: dataFields,
		timeout: 3000,
		success: function(dataBack){
			$('#number' + id).html(dataBack); // div "number" with the new number
			$('#arrow_up' + id).html('<div class="arrow_up_voted"></div>'); // We replace the clickable "arrow up" by the not clickable one
			$('#arrow_down' + id).html('<div class="arrow_down_voted"></div>'); // We replace the clickable "arrow down" by the not clickable one
			$('#message' + id).html('<div id="alertFadeOut' + id + '" style="color: green">Thank you for voting</div>'); // Diplay message with a fadeout
			$('#alertFadeOut' + id).fadeOut(1000, function () {
				$('#alertFadeOut' + id).text('');
			});
			},
		error: function() {
			$('#number' + id).text('Problem!');
		}
	});
}
</script>
	<style>
	.arrow_up a { display: block; background: url("/voting/arrow-up.png") no-repeat; width: 26px; height: 13px }
	.arrow_up a:hover { background-position: 0 -13px; width: 26px; height: 13px }
	.arrow_up_voted { display: block; background: url("/voting/arrow-up-voted.png") no-repeat; width: 26px; height: 13px }
	.arrow_down a { display: block; background: url("/voting/arrow-down.png") no-repeat; width: 26px; height: 13px }
	.arrow_down a:hover { background-position: 0 -13px; width: 26px; height: 13px }
	.arrow_down_voted { display: block; background: url("/voting/arrow-down-voted.png") no-repeat; width: 26px; height: 13px }
	
	.number { font-size: 18px; color: #818185; padding: 7px 0 7px 0; }
	.voting_table { margin-right: 20px; }
	</style>

 
<div class="container">
	<div class="row">
		<div class="col-md-12">
		<?php
		foreach($questions as $question) { // Loop - for each article...
			$cookie_name = 'tcVotingSystem'.$question->id; // Set up the cookie name
			
			echo '<div class="panel panel-default">';
				echo '<div class="panel-heading">Question '.$question->id.'</div>'; // Article name + id
				echo '<div class="panel-body">';
				echo '<table class="voting_table pull-left">';
					echo '<tr>';
						echo '<td align="center">';
							if( isset($_COOKIE[$cookie_name]) ) { // If the cookie exists (means if we have already voted for this article)
								echo '<div class="arrow_up_voted"></div>'; // We display a simple "arrow up", not clickable
							} else {
							?>
							<!-- else we display the clickable "arrow up". We call a function and pass the arguments article ID and the value +1 -->
							<div class="arrow_up" id="arrow_up<?php echo $question->id; ?>"><a href="#" id="arrowUp" onclick="vote(<?php echo $question->id; ?>, '+1'); return false;"></a></div>
							<?php
							}
						echo '</td>';
					echo '</tr>';
					echo '<tr>';
						echo '<td align="center">';
							echo '<div class="number" id="number'.$question->id.'">'.$question->vote.'</div>'; // We display the number of click
						echo '</td>';
					echo '</tr>';
					echo '<tr>';
						echo '<td align="center">';
							if( isset($_COOKIE[$cookie_name]) ) { // Same for the "arrow down": if the cookie exists (means if we have already voted for this article)
								echo '<div class="arrow_down_voted"></div>'; // We display a simple "arrow down", not clickable
							} else {
							?>
							<!-- else we display the clickable "arrow down". We call a function and pass the arguments article ID and the value -1 -->
							<div class="arrow_down" id="arrow_down<?php echo $question->id; ?>"><a href="#" id="arrowDown" onclick="vote(<?php echo $question->id; ?>, '-1'); return false;"></a></div>
							<?php
							}
						echo '</td>';
					echo '</tr>';
				echo '</table>';
				echo '<span id="message'.$question->id.'"></span>'; // Display message "Thank you for voting"
				echo 'Up branch to easily missed by do. Admiration considered acceptance too led one melancholy expression. Are will took form the nor true. Winding enjoyed minuter her letters evident use eat colonel. He attacks observe mr cottage inquiry am examine gravity. Are dear but near left was. Year kept on over so as this of. She steepest doubtful betrayed formerly him. Active one called uneasy our seeing see cousin tastes its. Ye am it formed indeed agreed relied piqued.';
				echo '</div>';
			echo '</div>';
		}
		?>
		</div>
	</div>
</div>