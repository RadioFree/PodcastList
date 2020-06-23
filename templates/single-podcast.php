	
<?php /* Template Name: Test-Page */ ?>
 
<?php get_header(); ?>
 
<div id="primary" class="content-area">
    <main id="main" class="site-main" role="main">
        <?php
        // Start the loop.
		//Get the slug from the parameter
		if(isset($_GET['podc'])){
			global $wpdb;
			$slug = $_GET['podc'];
			$table_name = $wpdb->prefix . 'cte';
			$result = $wpdb->get_results($wpdb->prepare ( "SELECT * FROM $table_name WHERE url = '$slug'" ));
			$attributes = array(
					'url'                    => array(
						'type' => 'url',
					),
					'itemsToShow'            => array(
						'type'    => 'integer',
						'default' => 5,
					),
					'showCoverArt'           => array(
						'type'    => 'boolean',
						'default' => true,
					),
					'showEpisodeDescription' => array(
						'type'    => 'boolean',
						'default' => true,
					),
				);
			foreach ( $result as $podcast )
			{
				$attributes['url'] = $podcast->rss;
				$attributes['itemsToShow'] = 5;
				$attributes['showCoverArt'] = true;
				$attributes['showEpisodeDescription'] = true;
				if(function_exists('Automattic\Jetpack\Extensions\Podcast_Player\render_block'))
				{
					echo Automattic\Jetpack\Extensions\Podcast_Player\render_block( $attributes );

					
				}
			}
			
		}else{
			echo "No podcast selected";
		}
        ?>
		
   </main>
 
 
</div><!-- .content-area -->
 
<?php get_footer(); ?>