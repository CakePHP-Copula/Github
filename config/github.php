<?php
$config['Apis']['Github']['read'] = array(
	// field
	'repos' => array(		
		// api url
		'repos/show' => array(			
			// required conditions
			'owner',
			// optional conditions the api call can take
			'optional' => array(
				'repo'
			),
		),
		'repos/search' => array(
			'seach',
			'optional' => array(
				'start_page',
				'language',
			)
		),
	),
	'followers' => array(),
	'followings' => array(),
	'friends' => array(),
	'bookmarks' => array(),
	'issues' => array(
		'issues/search' => array(
			'owner',
			'repo',
			'state',
			'search',
		),
		'issues/show' => array(
			'owner',
			'repo',
			'number',
		),
		'issues/list' => array(
			'owner',
			'repo',
			'state',
		),
	),
	'comments' => array(
		'issues/comments' => array(
			'owner',
			'repo',
			'number',
		)
	),
	'commits' => array(
		'commits/list' => array(
			'owner',
			'repo',
			'branch',
		),
	),
);

$config['Apis']['Github']['create'] = array(
	'repos' => array(
		'repos/fork' => array(
			'owner',
			'repo',
		),
		'repos/create' => array(
			'name',
			'optional' => array(
				'description',
				'homepage',
				'public',
			),
		),
	),
	'issues' => array(
		'issues/open' => array(
			'user',
			'repo',
			'title',
			'body',
		)
	)
);

$config['Apis']['Github']['update'] = array(
	'repos' => array(
		'repos/set/private' => array(
			'private',
			'owner',
			'repo',
		),
		'repos/set/public' => array(
			'public',
			'owner',
			'repo',
		),
	)
);

$config['Apis']['Github']['delete'] = array(
	'repos' => array(
		'repos/delete' => array(
			'owner',
			'repo',
			'optional' => array(
				'delete_token',
			),
		),
	),
);