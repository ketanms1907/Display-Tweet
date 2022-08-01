<?php 
/*Start Display tweets on homepage*/
add_shortcode( 'show_tweets', 'show_tweets_fun' );
function show_tweets_fun(){
	get_template_part('inc/TweetPHP');
	//get_template_part('inc/instagram');
	if( class_exists('TweetPHP')): 
		$TweetPHP = new TweetPHP(array(
		  'consumer_key'              => '',
		  'consumer_secret'           => '',
		  'access_token'              => '',
		  'access_token_secret'       => '',
		  'twitter_screen_name'       => '',
		  'tweets_to_display' => 15,
		  'tweets_to_retrieve' => 15,
		  'ignore_replies'        => true, // Ignore @replies
          'ignore_retweets'       => true, // Ignore retweets
		));
		
		$twitt_array = $TweetPHP->get_tweet_array();
		ob_start();
		$j = 0;
		$i = 0;
		foreach( $twitt_array as $twitt ){ //print_r( $twitt );
			if( $j < 10 ):
			?>       
			 <div class="twitter-feed-section">
	     		 <div class="twitter-icon"><i class="fa fa-twitter fa-3x"></i></div>
	                <div class="tweeter-feed">
	                	<h2><?php echo $TweetPHP->autolink($twitt['text']); ?></h2>
	                 </div>
	    		</div>
		<?php $j++;
			endif;
		}
		return ob_get_clean();
	endif;
}



<?php echo do_shortcode( '[show_tweets]' ); ?>
