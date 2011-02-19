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

	function describe($model) {
	 	return $this->_schema['github_sources'];
	}
	
	function listSources() {
		return array_keys($this->_schema);
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