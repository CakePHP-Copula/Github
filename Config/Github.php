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
				'type' // all, owner, member. Default: public
			),
		),
		'orgs/:org/repos' => array(			
			// required conditions
			'org',
			// optional conditions the api call can take
			'optional' => array(
				'repo' // all, public, member. Default: all
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
			'optional' => array(
				'type', // all, owner, public, private, member. Default: all
			),
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
		'issues' => array(
			'owner',
			'repo',
			'state',
		),
	),
	'comments' => array(
		'issues/comments' => array(
			'owner',
			'repo',
			'number', // id of issue
		)
	),
	'comment' => array( // singular for reading single comment
		'issues/comments' => array(
			'owner',
			'repo',
			'number', // id of comment
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
		'user/repos' => array(
			'name',
			'optional' => array(
				'description',
				'homepage',
				'private',
				'has_issues', // boolean
				'has_wiki', // boolean
				'has_downloads', // boolean
				'team_id', // number
			),
		),
	),
	'issues' => array(
		'repos/:user/:repo/issues' => array(
			'user',
			'repo',
			'title',
			'optional' => array(
				'body',
				'assignee', // string
				'milestone', // number
				'labels', // array of strings
			),
		)
	),
	'comments' => array(
		'repos/:user/:repo/issues/:id/comments' => array(
			'user',
			'repo',
			'id',
			'body', // content of comment
		),
	),
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
	),
	'issues' => array(
		'repos/:user/:repo/issues/:id' => array(
			'user',
			'repo',
			'id', // issue id
			'optional' => array(
				'title',
				'body',
				'assignee',
				'state',
				'milestone', // number
				'labels', // array of strings
			),
		),
	),
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