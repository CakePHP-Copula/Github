<?php
/**
 * A Github API Method Map
 *
 * Refer to the apis plugin for how to build a method map
 * https://github.com/ProLoser/CakePHP-Api-Datasources
 *
 */
$config['Apis']['Github']['hosts'] = array(
	'oauth' => 'github.com/login/oauth',
	'rest' => 'api.github.com',
);
// http://developer.github.com/v3/oauth/
$config['Apis']['Github']['oauth'] = array(
	'version' => '2.0',
	'authorize' => 'authorize', // Example URI: https://github.com/login/oauth/authorize
	'request' => 'requestToken', //client_id={$this->config['login']}&redirect_uri
	'access' => 'access_token', 
	'login' => 'authenticate', // Like authorize, just auto-redirects
	'logout' => 'invalidateToken', 
);
$config['Apis']['Github']['read'] = array(
	// field
	'repos' => array(	
		'repos/:user/:repo' => array(
			'user',
			'repo',
		),
		// api url
		'users/:user/repos' => array(			
			// required conditions
			'user',
			// optional conditions the api call can take
			'optional' => array(
				'type' // all*, public, private -- *default
			),
		),
		'orgs/:org/repos' => array(			
			// required conditions
			'org',
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
		'user/repos' => array(
			
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
		'repos/:user/:repo/commits' => array(
			'user',
			'repo',
			'optional' => array(
				'sha',
				'path',
			),
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