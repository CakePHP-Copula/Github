# CakePHP Github Api Plugin

Not sure how I'm gonna go about building this. For now I'm creating a datasource wrapper for:
https://github.com/ornicar/php-github-api

## Installation

1. Clone or download to `plugins/github`

2. Add the vendors

- If you're using git, run `git submodule update --init` from within the plugin
- If manual install, download the [php-github-api](https://github.com/ornicar/php-github-api) to the `plugins/github/vendors` folder.

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

4. Query Away! Still deciding on the api for this...