<?php
App::import('Core', 'Xml');
class GithubBehavior extends ModelBehavior {

	var $socket = null;
	var $base_uri = null;

	function setup(&$Model, $settings) {
		$this->base_uri = "http://github.com/api/v2/xml";
	}

	function __findUserShow(&$Model, $username = null) {
		if (!$username) return false;

		return $this->cached_xml_get("/user/show/{$username}");
	}

	function __findUserShowFollowing($username = null) {
		if (!$username) return false;

		return $this->cached_xml_get("/user/show/{$username}/following");
	}

	function __findUserWatched($username = null) {
		if (!$username) return false;

		return $this->cached_xml_get("/repos/watched/{$username}");
	}

	function __findUserEmail($username = null) {
		if (!$username) return false;

		return $this->cached_xml_get("/user/email/{$username}");
	}

	function __findIssuesSearch($params = array()) {
		foreach (array('username', 'repo', 'term') as $param) {
			if (empty($params[$param])) return false;
		}
		$params['state'] = (empty($params['state'])) ? 'open' : $params['state'];

		$request = "/issues/search/{$params['username']}/{$params['repo']}/{$params['state']}/{$params['term']}";
		return $this->cached_xml_get($request);
	}

	function __findIssuesList($params = array()) {
		if (empty($params['username']) || empty($params['repo'])) return false;
		$params['state'] = (empty($params['state'])) ? 'open' : $params['state'];

		return $this->cached_xml_get("/issues/list/{$params['username']}/{$params['repo']}/{$params['state']}");
	}

	function __findIssuesShow($params = array()) {
		foreach (array('username', 'repo', 'number') as $param) {
			if (empty($params[$param])) return false;
		}
		$params['state'] = (empty($params['state'])) ? 'open' : $params['state'];

		return $this->cached_xml_get("/issues/show/{$params['username']}/{$params['repo']}/{$params['number']}");
	}

	function __findIssuesComments($params = array()) {
		foreach (array('username', 'repo', 'number') as $param) {
			if (empty($params[$param])) return false;
		}
		$params['state'] = (empty($params['state'])) ? 'open' : $params['state'];

		return $this->cached_xml_get("/issues/comments/{$params['username']}/{$params['repo']}/{$params['number']}");
	}

	function __findIssuesLabels($params = array()) {
		if (empty($params['username']) || empty($params['repo'])) return false;
		$params['state'] = (empty($params['state'])) ? 'open' : $params['state'];

		return $this->cached_xml_get("/issues/labels/{$params['username']}/{$params['repo']}");
	}

	function __findReposWatched($username = null) {
		if (!$username) return false;

		return $this->cached_xml_get("/repos/watched/{$username}");
	}

	function __findReposSearch($query = null) {
		if (!$query) return false;

		return $this->cached_xml_get("/repos/search/", str_replace(' ', '+', $query));
	}

	function __findReposShowSingle($params = array()) {
		if (empty($params['username']) || empty($params['repo'])) return false;

		return $this->cached_xml_get("/repos/show/{$params['username']}/{$params['repo']}");
	}
	
	

	/**
	 * Find repos of the user
	 *
	 * @param string $username 
	 * @param string $repo 
	 * @param string $extra (collaborators|contributors)
	 * @return void
	 * @author Dean Sofer
	 */
	function findRepos(&$Model, $username, $repo = null, $extra = null) {
		$uri = "/repos/show/{$username}";
		if (!empty($repo))
			$uri .= "/{$repo}";
		if (!empty($extra))
			$uri .= "/{$extra}";
		$return = $this->cached_xml_get($uri);
		foreach ($return['Repository'] as $name => $value) {
			if (is_array($value)) {
				$return['Repository'][$name] = (!empty($value['value'])) ? $value['value'] : null;
			}
		}
		return $return;
	}

	function findReposShow(&$Model, $username = null) {
		if (!$username) return false;
		$return = $this->cached_xml_get("/repos/show/{$username}");
		foreach ($return['Repositories']['Repository'] as $i => $fields) {
			foreach ($fields as $name => $value) {
				if (is_array($value)) {
					$return['Repositories']['Repository'][$i][$name] = (!empty($value['value'])) ? $value['value'] : null;
				}
			}
		}
		return $return;
	}

	function __findReposShowCollaborators($params = array()) {
		if (empty($params['username']) || empty($params['repo'])) return false;

		return $this->cached_xml_get("/repos/show/{$params['username']}/{$params['repo']}/collaborators");
	}


	function __findReposShowContributors($params = array()) {
		if (empty($params['username']) || empty($params['repo'])) return false;

		return $this->cached_xml_get("/repos/show/{$params['username']}/{$params['repo']}/contributors");
	}

	function __findReposShowNetwork($params = array()) {
		if (empty($params['username']) || empty($params['repo'])) return false;

		return $this->cached_xml_get("/repos/show/{$params['username']}/{$params['repo']}/network");
	}

	function __findReposShowLanguages($params = array()) {
		if (empty($params['username']) || empty($params['repo'])) return false;

		return $this->cached_xml_get("/repos/show/{$params['username']}/{$params['repo']}/languages");
	}

	function __findReposShowTags($params = array()) {
		if (empty($params['username']) || empty($params['repo'])) return false;

		return $this->cached_xml_get("/repos/show/{$params['username']}/{$params['repo']}/tags");
	}

	function findCommitsList(&$Model, $params = array()) {
		if (empty($params['username']) || empty($params['repo'])) return false;
		$params['branch'] = (empty($params['branch'])) ? 'master' : $params['branch'];

		return $this->cached_xml_get("/commits/list/{$params['username']}/{$params['repo']}/{$params['branch']}");
	}

	function __findCommitsShowPath($params = array()) {
		foreach (array('username', 'repo', 'path') as $param) {
			if (empty($params[$param])) return false;
		}
		$params['branch'] = (empty($params['branch'])) ? 'master' : $params['branch'];

		$request = "/commits/list/{$params['username']}/{$params['repo']}/{$params['branch']}/{$params['path']}";
		return $this->cached_xml_get($request);
	}

	function __findCommitsShowSha($params = array()) {
		foreach (array('username', 'repo', 'sha') as $param) {
			if (empty($params[$param])) return false;
		}

		return $this->cached_xml_get("/commits/show/{$params['username']}/{$params['repo']}/{$params['sha']}");
	}

	function __findTreeShow($params = array()) {
		foreach (array('username', 'repo', 'sha') as $param) {
			if (empty($params[$param])) return false;
		}

		return $this->cached_xml_get("/tree/show/{$params['username']}/{$params['repo']}/{$params['sha']}");
	}

	function __findBlobShowPath($params = array()) {
		foreach (array('username', 'repo', 'sha', 'path') as $param) {
			if (empty($params[$param])) return false;
		}

		$request = "/blob/show/{$params['username']}/{$params['repo']}/{$params['sha']}/{$params['path']}";
		return $this->cached_xml_get($request);
	}

	function __findBlobShowAll($params = array()) {
		foreach (array('username', 'repo', 'sha') as $param) {
			if (empty($params[$param])) return false;
		}

		return $this->cached_xml_get("/blob/all/{$params['username']}/{$params['repo']}/{$params['sha']}");
	}

	function __findBlobShow($params = array()) {
		foreach (array('username', 'repo', 'sha') as $param) {
			if (empty($params[$param])) return false;
		}

		return $this->cached_xml_get("/blob/show/{$params['username']}/{$params['repo']}/{$params['sha']}");
	}

	function __findNewPackages($username = null) {
		if (!$username) return false;
		ClassRegistry::init('Maintainer');
		$Maintainer = &new Maintainer;
		$existingUser = $Maintainer->find('view', $username);
		$repoList = $this->find('repos_show', $username);

		$repos = $Maintainer->Package->find('list', array(
			'conditions' => array(
				'Package.maintainer_id' => $existingUser['Maintainer']['id'])));
		if (isset($repoList['Repositories']['Repository']['description'])) {
			if (in_array($repoList['Repositories']['Repository']['name'], $repos)) return false;
			if ($repoList['Repositories']['Repository']['fork']['value'] == 'true') return false;
			return array('0' => $repoList['Repositories']['Repository']);
		} else {
		    if (!isset($repoList['Repositories']['Repository'])) return false;
			foreach ($repoList['Repositories']['Repository'] as $key => $package) {
				if (in_array($package['name'], $repos) || ($package['fork']['value'] == 'true')) {
					unset($repoList['Repositories']['Repository'][$key]);
				}
			}
			return $repoList['Repositories']['Repository'];
		}
	}

	function __findUnlisted($username = 'josegonzalez') {
		$following = $this->find('users_show_following', 'josegonzalez');
		ClassRegistry::init('Maintainer');
		$maintainer = &new Maintainer;
		$maintainers = $maintainer->find('list', array('fields' => array('username')));
		$maintainers = array_values($maintainers);
		foreach ($following['Users']['User'] as $key => &$user) {
			if (in_array($user, $maintainers)) {
				unset($following['Users']['User'][$key]);
			}
		}
		return $following['Users']['User'];
	}

	function http_socket() {
		if (!$this->socket) {
			App::import('Core', 'HttpSocket');
			$this->socket = new HttpSocket();
		}
	}

	function cached_xml_get($request, $var = null) {
		$md5_request = md5(serialize(array($this->base_uri . $request, $var)));
		$response = array();

		Cache::set(array('duration' => '+2 days'));
		if (($response = Cache::read("Github.{$md5_request}")) === false) {
			sleep(1);
			$this->http_socket();
			$xml_response = new Xml($this->socket->get($this->base_uri . $request . $var));
			$response = Set::reverse($xml_response);
			if (!empty($response['Html'])) return false;
			if (!empty($response['Error'])) return $response;
			Cache::set(array('duration' => '+2 days'));
			Cache::write("Github.{$md5_request}", $response);
		}
		return $response;
	}

	function savePackage($username, $name) {
		App::import('Lib', 'NewPackageJob');
		return $this->enqueue(new NewPackageJob($username, $name));
	}

	function saveUser($username = null) {
		if (!$username) return false;

		App::import('Lib', 'NewMaintainerJob');
		return $this->enqueue(new NewMaintainerJob($username, $name));
	}

	function __findRelatedRepositories($maintainers = array()) {
		if (!$maintainers) return false;

		$Package = ClassRegistry::init('Package');

		foreach ($maintainers as $i => $maintainer) {
			$repos = $this->find('repos_show', $maintainer['Maintainer']['username']);
			if (!empty($repos['Repositories']['Repository'])) {
				$packages = $Package->find('listformaintainer', $maintainer['Maintainer']['id']);
				if (!empty($repos['Repositories']['Repository']['name'])) {
					$repos['Repositories']['Repository'] = array($repos['Repositories']['Repository']);
				}
				foreach ($repos['Repositories']['Repository'] as $j => $repo) {
					if (in_array($repo['name'], $packages) || $repo['fork']['value'] == 'true') {
						unset($repos['Repositories']['Repository'][$j]);
					}
				}
				$maintainers[$i]['Repositories'] = $repos['Repositories']['Repository'];
			} else {
				$maintainers[$i]['Repositories'] = array();
			}
		}

		return $maintainers;
	}
	
}