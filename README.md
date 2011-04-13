# CakePHP Github Api Plugin
**v0.0.3**

Not sure how I'm gonna go about building this. For now I'm creating a datasource wrapper for:
https://github.com/ornicar/php-github-api

## Installation

1. Clone or download to `plugins/github`

2. Add the [php-github-api](https://github.com/ornicar/php-github-api) vendor to the `vendors/Github` folder. (using the apis autoloader)

3. Add your configuration to `database.php` and set it to the model

<pre><code>
:: database.php ::
var $github = array(
	'datasource' => 'Github.Github',
	// These are only required for authenticated requests (write-access)
	'login' => '--Your API Key--',
	'password' => '--Your API Secret--',
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
<pre><code>$data = $this->Model->find('all', array(
	'conditions' => array(
		'owner' => 'cakephp', 
		'repo' => 'cakephp'
	),
	'fields' => 'commits',
));</code></pre>
		
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