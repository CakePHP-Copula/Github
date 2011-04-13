<?php
$config['Apis']['Github']['read'] = array(
	// field
	'repos' => array(		
		// api url
		'repos/show' => array(			
			// required conditions
			'owner',
			// optional conditions the api call can take
			'optional' => array(),
		),
	),
	'followers' => array(),
	'followings' => array(),
	'friends' => array(),
	'bookmarks' => array(),
	'issues' => array(),
);

$config['Apis']['Github']['create'] = array(
);

$config['Apis']['Github']['update'] = array(
);

$config['Apis']['Github']['delete'] = array(
);