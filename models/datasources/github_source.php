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
App::import('Vendor', 'Github_HttpClientInterface', array('file' =>'php-github-api'.DS.'HttpClientInterface.php'));
App::import('Vendor', 'Github_HttpClient', array('file' =>'php-github-api'.DS.'HttpClient.php'));
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
	}
	
	function update($model, $fields = array(), $values = array()) {
	}
	
	function delete($model, $id = null) {
	}
	
	function calculate($model, $id = null) {
	}
}