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
	 * @param string $apiName
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
		$api = Inflector::classify($queryData['fields']);
		$data = false;
		if (!empty($queryData['conditions']['owner']) && $api == 'User') {
			$data = $this->api($api)->search($queryData['conditions']['owner']);
		} elseif (!empty($queryData['conditions']['owner']) && $api == 'Issue') {
			$data = $this->api($api)->getUserRepos($queryData['conditions']['owner']);
		} elseif (!empty($queryData['conditions']['owner']) && $api == 'User') {
			$data = $this->api($api)->getUserRepos($queryData['conditions']['owner']);
		} elseif (!empty($queryData['conditions']['owner']) && $api == 'Repo') {
			$data = $this->api($api)->getUserRepos($queryData['conditions']['owner']);
		}
		return $data;
	}
	
	function update($model, $fields = array(), $values = array()) {
	}
	
	function delete($model, $id = null) {
	}
	
	function calculate($model, $id = null) {
	}
}