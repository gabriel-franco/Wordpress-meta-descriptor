<?php

	$allposts = get_posts('numberposts=-1&post_type=page&post_status=any');

	foreach( $allposts as $postinfo) {
		delete_post_meta($postinfo->ID, '_gf_meta_descripcion');
	}
?>
