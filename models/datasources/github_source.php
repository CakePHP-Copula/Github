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
App::import('Core', array('Xml', 'HttpSocket'));
App::import('Vendor', 'Github_Autoloader', array('file' =>'Github'.DS.'Autoloader.php'));
Github_Autoloader::autoload('Github_ApiInterface');
Github_Autoloader::autoload('Github_Api');
Github_Autoloader::autoload('Github_HttpClientInterface');
Github_Autoloader::autoload('Github_HttpClient');
Github_Autoloader::autoload('Github_HttpClient_Curl');
Github_Autoloader::autoload('Github_Client');
Github_Autoloader::autoload('Github_Api_User');
Github_Autoloader::autoload('Github_Api_Organization');
Github_Autoloader::autoload('Github_Api_Issue');
Github_Autoloader::autoload('Github_Api_Object');
Github_Autoloader::autoload('Github_Api_Repo');
Github_Autoloader::autoload('Github_Api_Commit');

class GithubSource extends DataSource {

	/**
	 * Array containing the names of components this component uses. Component names
	 * should not contain the "Component" portion of the classname.
	 *
	 * @var array
	 * @access public
	 */
	var $config = array();
	
	var $_schema = array(
		'github_sources' => array(
			'id' => array(
				'type' => 'integer',
				'null' => true,
				'key' => 'primary',
				'length' => 11,
			),
			'text' => array(
				'type' => 'string',
				'null' => true,
				'key' => 'primary',
				'length' => 140
			),
			'status' => array(
				'type' => 'string',
				'null' => true,
				'key' => 'primary',
				'length' => 140
			),
		)
	);
	
	function __construct($config) {
		extract($config);
		$auth = "$login:$password";
		$this->connection = new HttpSocket(
			"http://github.com/"
		);
		parent::__construct($config);
	}

	function describe($model) {
	 	return $this->_schema['github_sources'];
	}
	
	function listSources() {
		return array();
	}
	
	function create($model, $fields = array(), $values = array()) {
	}
	
	function read($model, $queryData = array()) {
		$github = new Github_Client();
		$myRepos = $github->getRepoApi()->getUserRepos('ornicar');
		return $myRepos;
		$uri = '';

		if (!empty($queryData['conditions']['username']))
		$uri .= '/' . $queryData['conditions']['username'];
		
		if (!empty($queryData['conditions']['project']))
		$uri .= '/' . $queryData['conditions']['project'];
		
		if (!empty($queryData['fields']))
		$uri .= '/' . $queryData['fields'];
		
		return $this->request($uri);
	}
	
	function update($model, $fields = array(), $values = array()) {
	}
	
	function delete($model, $id = null) {
	}
	
	function calculate($model, $id = null) {
	}
}