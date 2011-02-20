<?php
/**
 * Github DataSource
 * 
 * [Short Description]
 *
 * @package default
 * @author Dean Sofer
 * @version $Id$
 * @copyright 
 **/
class GithubSource extends DataSource {

	/**
	 * Array containing the names of components this component uses. Component names
	 * should not contain the "Component" portion of the classname.
	 *
	 * @var array
	 * @access public
	 */
	var $config = array();
	
	/**
	 * Reference to github vendor api
	 *
	 * @var string
	 */
	var $github;
	
	// TODO: Relocate to a dedicated schema file
	var $_schema = array(
		'repositories' => array(
			'type' => array(
				'type' => 'integer',
				'null' => true,
				'key' => 'primary',
				'length' => 11,
			),
			'language' => array(
				'type' => 'string',
				'null' => true,
				'key' => 'primary',
				'length' => 140
			),
			'has_downloads' => array(
				'type' => 'string',
				'null' => true,
				'key' => 'primary',
				'length' => 140
			),
			'url' => array(
				'type' => 'string',
				'null' => true,
				'key' => 'primary',
				'length' => 140
			),
			'homepage' => array(
				'type' => 'string',
				'null' => true,
				'key' => 'primary',
				'length' => 140
			),
			'pushed_at' => array(
				'type' => 'string',
				'null' => true,
				'key' => 'primary',
				'length' => 140
			),
			'created_at' => array(
				'type' => 'string',
				'null' => true,
				'key' => 'primary',
				'length' => 140
			),
			'fork' => array(
				'type' => 'string',
				'null' => true,
				'key' => 'primary',
				'length' => 140
			),
			'has_wiki' => array(
				'type' => 'string',
				'null' => true,
				'key' => 'primary',
				'length' => 140
			),
			'score' => array(
				'type' => 'string',
				'null' => true,
				'key' => 'primary',
				'length' => 140
			),
			'size' => array(
				'type' => 'string',
				'null' => true,
				'key' => 'primary',
				'length' => 140
			),
			'private' => array(
				'type' => 'string',
				'null' => true,
				'key' => 'primary',
				'length' => 140
			),
			'name' => array(
				'type' => 'string',
				'null' => true,
				'key' => 'primary',
				'length' => 140
			),
			'watchers' => array(
				'type' => 'string',
				'null' => true,
				'key' => 'primary',
				'length' => 140
			),
			'owner' => array(
				'type' => 'string',
				'null' => true,
				'key' => 'primary',
				'length' => 140
			),
			'open_issues' => array(
				'type' => 'string',
				'null' => true,
				'key' => 'primary',
				'length' => 140
			),
			'description' => array(
				'type' => 'string',
				'null' => true,
				'key' => 'primary',
				'length' => 140
			),
			'forks' => array(
				'type' => 'string',
				'null' => true,
				'key' => 'primary',
				'length' => 140
			),
			'has_issues' => array(
				'type' => 'string',
				'null' => true,
				'key' => 'primary',
				'length' => 140
			),
		)
	);
	
	function __construct($config) {
		App::import('Vendor', 'Github_Autoloader', array('file' =>'Github'.DS.'Autoloader.php'));
		Github_Autoloader::register();
		$this->github = new Github_Client();
		parent::__construct($config);
	}
	
	/**
	 * Returns a GithubApiObject based on the name of the api necessary
	 *
	 * @param string $apiNamegit
	 * @return GithubApiObject
	 * @author Dean Sofer
	 */
	function api($apiName) {
		if (empty($apiName))
			return false;
		return $this->github->{"get{$apiName}Api"}();
	}

	function describe($model) {
	 	return $this->_schema['repositories'];
	}
	
	function listSources() {
		return array_keys($this->_schema);
	}
	
	function create($model, $fields = array(), $values = array()) {
	}
	
	/**
	 * Uses standard find conditions. Use find('all', $params). Since you cannot pull specific fields,
	 * we will instead use 'fields' to specify what table to pull from.
	 *
	 * Example:
	 *	$params = array(
	 *		'conditions' => array('owner' => 'proloser'), 
	 *		'fields' => 'repos') // 'Repo' is also acceptable
	 *	);
	 *
	 * @param string $model 
	 * @param string $queryData 
	 * @return void
	 * @author Dean Sofer
	 */
	function read($model, $queryData = array()) {
		//debug(array($model, $queryData));
		$api = Inflector::classify($queryData['fields']);
		$data = false;
		switch ($api) {
			case 'User':
				if (!empty($queryData['conditions']['owner'])) {
					$data = $this->api($api)->show($queryData['conditions']['owner']);
				}
				break;
			case 'Issue':
			
				break;
			case 'Repo':
				if (!empty($queryData['conditions']['owner'])) {
					$data = $this->api($api)->getUserRepos($queryData['conditions']['owner']);
				} elseif (!empty($queryData['conditions']['search'])) {
					$data = $this->api($api)->search($queryData['conditions']['search']);	
				}
				break;
			case 'Commit':
				if (!empty($queryData['conditions']['file']) && !empty($queryData['conditions']['branch'])) {
					$data = $this->api($api)->getFileCommits($queryData['conditions']['owner'], $queryData['conditions']['repo'], $queryData['conditions']['owner'], $queryData['conditions']['owner']);
				} elseif (!empty($queryData['conditions']['commit']) && !empty($queryData['conditions']['branch'])) {
					$data = $this->api($api)->getCommit($queryData['conditions']['owner'], $queryData['conditions']['repo'], $queryData['conditions']['owner']);
				} elseif (!empty($queryData['conditions']['branch'])) {
					$data = $this->api($api)->getBranchCommits($queryData['conditions']['owner'], $queryData['conditions']['repo'], $queryData['conditions']['branch']);
				}
				break;
			
		}
		return $data;
	}
	
	function update($model, $fields = array(), $values = array()) {
	}
	
	function delete($model, $id = null) {
	}
	
	function calculate($model, $id = null) {
	}
	
	/**
	 * Redirect the user to this address
	 *
	 * @param string $returnUri The postback location to call DS->getToken() from
	 * @return string $redirectUri
	 * @author Dean Sofer
	 */
	function tokenUrl($returnUri) {
		 return "https://github.com/login/oauth/authorize?client_id={$this->config['login']}&redirect_uri={$returnUri}";
	}
	
	/**
	 * Posts back to github after the user returns from tokenUrl() to retrieve the token
	 *
	 * @param string $returnUri 
	 * @param string $code 
	 * @return void
	 * @author Dean Sofer
	 */
	function getToken($returnUri = null, $code = null) {
		App::import('Core', 'HttpSocket');
		$socket = new HttpSocket();
		
		if (empty($returnUri) && isset($_GET['redirect_uri']))
			$returnUri = $_GET['redirect_uri'];
		if (empty($code) && isset($_GET['code']))
			$code = $_GET['code'];
		
		$response = $socket->post('https://github.com/login/oauth/access_token', array(
			'client_id' => $this->config['login'],
			'redirect_uri' => $returnUri,
			'client_secret' => $this->config['password'],
			'code' => $code,
		));
		
		return $response['access_token'];
	}
	
	/**
	 *  Authenticate with github using a username and password or token
	 *
	 * @param string $username 
	 * @param string $secret 
	 * @param string $method 
	 * @return void
	 * @author Dean Sofer
	 */
	function authenticate($username = null, $secret = null, $method = null) {
		if (!$username)
			$username = $this->config['login'];
		if (!$secret && isset($this->config['password']))
			$secret = $this->config['password'];
		if (!$secret && isset($_GET))
			$secret = $this->config['password'];
		return $this->github->authenticate($username, $secret, $method);
	}
	
	function deAuthenticate() {
		return $this->github->deAuthenticate();
	}
}