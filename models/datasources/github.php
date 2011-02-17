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
	
	var $_schema = array(
		'tweets' => array(
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
		$auth = "{$config['login']:{$config['password']}";
		$this->connection = new HttpSocket(
			"http://{}@twitter.com/"
		);}
		parent::__construct($config);
	}

	function describe($model) {
	 	return $this->_schema['tweets'];
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
}