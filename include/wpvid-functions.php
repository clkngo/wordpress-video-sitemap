<?php
/**
 * @package Internals
 */

if ( !defined( 'WPVID_VERSION' ) ) {
	header( 'HTTP/1.0 403 Forbidden' );
	die;
}

/** 
 * GPL 
 */
function wpvid_youtube_only_data( $video_id ) {

	$api_url = "https://gdata.youtube.com/feeds/api/videos/$video_id?v=2&alt=json";

	$request = wp_remote_get( $api_url );

	if ( is_wp_error( $request ) )
		return array( 'duration' => 0, 'ratings' => 0, 'view_count' => 0  );

	if ( $request['response']['code'] !== 200 )
		return array( 'duration' => 0, 'ratings' => 0, 'view_count' => 0  );

	$data = json_decode( $request['body'] );

	$duration = $data->entry->{'media$group'}->{'media$content'}[0]->duration;

	$view_count = $data->{'entry'}->{'yt$statistics'}->{'viewCount'};

	$ratings = $data->{'entry'}->{'gd$rating'}->{'average'};

	$title = $data->{'entry'}->title->{'$t'};

	$description = $data->{'entry'}->{'media$group'}->{'media$description'}->{'$t'};


	return array(
			'duration' => $duration,
			'ratings' => $ratings,
			'view_count' => $view_count,
			'title' => $title,
			'description' => $description
		);
}


// this sets the data of the sitemap
function wpvid_xml() {
	global $wpseo_sitemaps, $wpdb;

	$videos = array();	// Processed video data
	$ids	= array();	// Used to filter out multiple instances of the same video

	$posts = $wpdb->get_results ( "SELECT id, post_title, post_content, post_date_gmt, post_excerpt, post_author
		FROM $wpdb->posts WHERE post_status = 'publish'
		AND (post_type = 'post' OR post_type = 'page')
		AND ((post_content LIKE '%youtube%') OR (post_content LIKE '%youtu.be%')) ORDER BY post_date DESC" );


	$sm ='<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9"
        xmlns:video="http://www.google.com/schemas/sitemap-video/1.1">';

	if (empty ($posts)) {
		$wpseo_sitemaps->set_sitemap ($sm . '</urlset>');
		return 0;
	}


	foreach ( $posts as $p ) {

		if ( preg_match_all( '/(\/youtu\.be\/|youtube\.com\/watch\?v\=)([a-zA-Z0-9\-_]*)/i', $p->post_content, $matches)) {
/**
 * 		Normal embedded youtube video
 */
			foreach ($matches[2] as $id) {

				$video = array();

				if ( in_array ($id, $ids) ) continue;

				$ids[] = $id;

/**
 * 				Grab the youtube data using the gdata API
 */
				$gdata = wpvid_youtube_only_data($id);

				$video['id']			= $id;
				$video['thumbnail'] 	= "http://i.ytimg.com/vi/$id/hqdefault.jpg";
				$video['player_loc']	= "http://www.youtube.com/v/$id";
				$video['publish_date']	= date (DATE_W3C, strtotime ($p->post_date_gmt));
				$video['permalink'] 	= get_permalink($p->id);

				if ( isset($gdata['title'])) {
					$video['title'] = $gdata['title'];
				}
				if ( isset($gdata['duration']) ) {
					$video['duration'] = $gdata['duration'];
				}
				if ( isset($gdata['description']) ) {
					$video['description'] = $gdata['description'];
				}

				$post_tags = get_the_tags( $p->id );
				if ( ! is_array( $post_tags ) ) {
					$post_tags = array();
				}
				$video['tags'] 			= $post_tags;

				$post_cats = get_the_category( $p->id );
				if ( ! is_array( $post_cats ) ) {
					$post_cats = array();
				}
				$video['cats'] 			= $post_cats;


				$videos[$id] = $video;
			
			}
		}
/**
 * 		Check if the shortcode extends the title and description; use these values if
 * 		the user supplies it.
 */

		if ( preg_match_all( '`\[youtube\=[^>]+\]`', $p->post_content, $matches)) {

			foreach ( $matches[0] as $shortcode ) {

				if (  preg_match( '/(\/youtu\.be\/|youtube\.com\/watch\?v\=)([a-zA-Z0-9\-_]*)/i', $shortcode, $match) ) {

					$id = $match[2];


					if (!isset($videos[$id])) {
						continue;
					}


					if ( preg_match( '`name=["\']([^"\']+)["\']`', $shortcode, $match ) ) {
						$videos[$id]['title'] = $match[1];
					}
					if ( preg_match( '`desc=["\']([^"\']+)["\']`', $shortcode, $match ) ) {
						$videos[$id]['description'] = $match[1];
					}

				}
			
			}
		}

	} // foreach post

	foreach ( $videos as $video ) {
		$sm .= "<url>\n";
		$sm .= "  <loc>" . $video['permalink']. "</loc>\n";
		$sm .= "  <video:video>\n";
		$sm .= "  <video:title>" . htmlspecialchars($video['title']). "</video:title>\n";
		$sm .= "  <video:description>" . htmlspecialchars($video['description']). "</video:description>\n";
		$sm .= "  <video:thumbnail_loc>" . $video['thumbnail']. "</video:thumbnail_loc>\n";
		$sm .= '  <video:player_loc allow_embed="yes" autoplay="ap=1">' . $video['player_loc'] . "</video:player_loc>\n";
		$sm .= "  <video:duration>" . $video['duration']. "</video:duration>\n";

		$sm .= "  <video:publication_date>" . $video['publish_date'] ."</video:publication_date>\n";

		foreach ( $video['tags'] as $tag ) {
			$sm .= "  <video:tag>" . $tag->name . "</video:tag>\n";
			
		}
		foreach ( $video['cats'] as $category ) {
		   $sm .= "  <video:category>" . $category->name . "</video:category>\n";
		}
       
		$sm .= "  </video:video>\n";
		$sm .= "</url>\n";

	}

	$wpseo_sitemaps->set_sitemap ($sm . '</urlset>');

}

/**
 * wpvid_stylesheet checks to see if the sitemap to use is for this
 * user generated sitemap (i.e., wpvid) or the default one.
 */
function wpvid_stylesheet($content) {

	$qv = get_query_var( 'sitemap');
	if ( $qv == 'wpvid') {
		// override with the stylesheet created in wpvid_xsl
		return '<?xml-stylesheet type="text/xsl" href="' . home_url('index.php?xsl=wpvid') . '"?>';
	}
	else {
		// Don't override
		return $content;
	}
}

/**
 * This returns the stylesheet for video sitemaps. Currently it returns Yoast's stylesheet
 * 
 */
function wpvid_xsl() {
// TODO: Header control (since 1.4.13)

	header( 'HTTP/1.1 200 OK', true, 200 );
	// Prevent the search engines from indexing the XML Sitemap.
	header( 'X-Robots-Tag: noindex, follow', true );
	header( 'Content-Type: text/xml' );

	// Make the browser cache this file properly.
	$expires = 60 * 60 * 24 * 365;
	header( 'Pragma: public' );
	header( 'Cache-Control: maxage=' . $expires );
	header( 'Expires: ' . gmdate( 'D, d M Y H:i:s', time() + $expires ) . ' GMT' );

	$fp = @fopen(WPSEO_PATH . '/css/xml-video-sitemap.xsl',"r");
	if ($fp) {
		while(!feof($fp)) {
			$xls = @fread($fp, 8192);
			echo $xls;
		}
		fclose($fp);
	}

}

/**
 * wpvid_sitemap_index
 * 		Adds an entry into sitemap_index.xml when the apply filter for "wpseo_sitemap_index"
 * 		is called to insert user sitemaps.
 */

function wpvid_sitemap_index() {

	$date = date (DATE_W3C, time());
	return 	'<sitemap>' . "\n" .
				'<loc>' . home_url( $base . 'wpvid-sitemap.xml' ) . '</loc>' . "\n" .
				'<lastmod>' . htmlspecialchars( $date ) . '</lastmod>' . "\n" .
			'</sitemap>' . "\n";
}




/**
 * Initialize sitemaps. Add sitemap rewrite rules and query var
 */
function wpvid_sitemap_init() {

	global $wpseo_sitemaps;		// see wordpress-seo/inc/class-sitemaps.php

//	Check to see if Yoast's SEO plugin is enabled and loaded

	if (!empty($wpseo_sitemaps)) {
		// Install sitemap into root map
		
		add_filter( 'wpseo_sitemap_index', 'wpvid_sitemap_index' );

		// registers index.php?sitemap=wpvid
		// perfoms callback to xml_myvid when outputing wpvid-sitemap.xml
		// this is where the xml is generated for the video sitemap

		$wpseo_sitemaps->register_sitemap( 'wpvid', 'wpvid_xml', 'wpvid' );

		// Use Yoast's video stylesheet instead of the default

		add_filter( 'wpseo_stylesheet_url', 'wpvid_stylesheet') ;

		// WTF doesn't this work?
		// register index.php?xsl=mxvid
		$wpseo_sitemaps->register_xsl ('wpvid', 'wpvid_xsl', 'wpvid');
	}
}
add_action( 'init', 'wpvid_sitemap_init', 1 );

