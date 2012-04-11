# CakePHP Github Api Plugin

## Installation

This plugin depends on the [ApisDatasource](https://github.com/ProLoser/CakePHP-Api-Datasources). Refer to the instructions found there.

## Commands (unfinished)

To see what is available to you, it is best if you refer to the 
[map file](https://github.com/ProLoser/CakePHP-Github/blob/master/Config/Github.php) for an up-to-date list, in addition 
to the original [API Documentation](http://developer.github.com/). There are a variety of options available to you, 
however some combinations are required (for example 'issues' requires 'owner' and 'repo').

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