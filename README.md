# CakePHP Github Api Plugin

## Installation

1. Clone or download to `Plugin/Github`

2. Add your configuration to `database.php` and set it to the model

<pre><code>
:: database.php ::
var $github = array(
	'datasource' => 'Github.Github',
	// These are only required for authenticated requests (write-access)
	'login' => '--Your API Key--',
	'password' => '--Your API Secret--',
	'scope' => 'user,public_repo,repo,gist' // Optional comma-separated list. Read up here: http://developer.github.com/v3/oauth/#scopes
);

:: my_model.php ::
var $useDbConfig = 'github';

</code></pre>

## Commands

There are a variety of options available to you, however some combinations are required (for example 'wiki' requires 'owner' and 'repo')
You can get an idea what's available to you by reading the [Codaset API Documentation](http://api.codaset.com/docs)


### Read: `find('all', $params)`

Conditions:

* owner
* repo

Fields: pass only one of these at a time as a string

* General
	* repos
* User specific (owner required)
	* repos
	* followers
	* followings
	* friends
	* bookmarks
* Repo specific (owner and repo conditions required)
	* issues
		
**Example:**
```
$data = $this->Model->find('all', array(
	'conditions' => array(
		'owner' => 'cakephp', 
		'repo' => 'cakephp'
	),
	'fields' => 'commits',
));
```
		
### Update: `save()`
Bold items are required

**Unfollow a user**

Fields:

* follow => owner

### Create
Bold items are required

**Create Repo**

Fields:

* **type** => repo
* **owner** => The owner of the repo owner.
* **title** => Title of the new repo.
* description => Description of the repo.
* state => The state of the repo. Possible values are 'public' (default), 'semi-private' or 'private'.
* fork => A publicly accessible URL of an external Git repository that will be cloned to create this repo. Example: git://external-domain.com/repository.git

**Follow a user**

Fields:

* **type** => follow
* **follow** => owner
	
### Delete `delete()`
Bold items are required