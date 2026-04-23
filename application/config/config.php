<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
|--------------------------------------------------------------------------
| Base Site URL
|--------------------------------------------------------------------------
| Auto-detected from SCRIPT_NAME. For odd reverse-proxy setups, set in Apache:
|   SetEnv CI_BASE_URL http://localhost/rose_hotel
| (no trailing slash required)
*/
if ( ! empty($_SERVER['CI_BASE_URL']))
{
	$config['base_url'] = rtrim($_SERVER['CI_BASE_URL'], '/').'/';
}
else
{
	$protocol = ( ! empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off') ? 'https' : 'http';
	$host = isset($_SERVER['HTTP_HOST']) ? $_SERVER['HTTP_HOST'] : 'localhost';
	$script = isset($_SERVER['SCRIPT_NAME']) ? $_SERVER['SCRIPT_NAME'] : '/index.php';
	$config['base_url'] = $protocol.'://'.$host.str_replace(basename($script), '', $script);
}

/*
|--------------------------------------------------------------------------
| Index File
|--------------------------------------------------------------------------
| Remove index.php for SEO-friendly URLs if you are using .htaccess
*/
$config['index_page'] = ''; // ✅ Better for clean URLs (requires .htaccess rewrite)

/*
|--------------------------------------------------------------------------
| URI PROTOCOL
|--------------------------------------------------------------------------
*/
$config['uri_protocol']	= 'REQUEST_URI';

/*
|--------------------------------------------------------------------------
| URL suffix
|--------------------------------------------------------------------------
*/
$config['url_suffix'] = '';

/*
|--------------------------------------------------------------------------
| Default Language & Charset
|--------------------------------------------------------------------------
*/
$config['language']	= 'english';
$config['charset'] = 'UTF-8';

/*
|--------------------------------------------------------------------------
| Hooks
|--------------------------------------------------------------------------
*/
$config['enable_hooks'] = FALSE;

/*
|--------------------------------------------------------------------------
| Class Extension Prefix
|--------------------------------------------------------------------------
*/
$config['subclass_prefix'] = 'MY_';

/*
|--------------------------------------------------------------------------
| Composer Autoload
|--------------------------------------------------------------------------
*/
$config['composer_autoload'] = FALSE;

/*
|--------------------------------------------------------------------------
| Allowed URL Characters
|--------------------------------------------------------------------------
*/
$config['permitted_uri_chars'] = 'a-z 0-9~%.:_\-';

/*
|--------------------------------------------------------------------------
| Query Strings
|--------------------------------------------------------------------------
*/
$config['enable_query_strings'] = FALSE;
$config['controller_trigger'] = 'c';
$config['function_trigger'] = 'm';
$config['directory_trigger'] = 'd';
$config['allow_get_array'] = TRUE;

/*
|--------------------------------------------------------------------------
| Logging
|--------------------------------------------------------------------------
*/
$config['log_threshold'] = 0;
$config['log_path'] = '';
$config['log_file_extension'] = '';
$config['log_file_permissions'] = 0644;
$config['log_date_format'] = 'Y-m-d H:i:s';

/*
|--------------------------------------------------------------------------
| Error Views & Cache
|--------------------------------------------------------------------------
*/
$config['error_views_path'] = '';
$config['cache_path'] = '';
$config['cache_query_string'] = FALSE;

/*
|--------------------------------------------------------------------------
| Encryption Key
|--------------------------------------------------------------------------
*/
$config['encryption_key'] = 'fdfdfdf';

/*
|--------------------------------------------------------------------------
| Session Configuration (FIXED)
|--------------------------------------------------------------------------
| ✅ FIXED: Using a custom writable directory for sessions
*/
$config['sess_driver'] = 'files';
$config['sess_cookie_name'] = 'ci_session';
$config['sess_expiration'] = 7200;
$config['sess_save_path'] = FCPATH . 'application/cache/sessions'; // ✅ custom folder
$config['sess_match_ip'] = FALSE;
$config['sess_time_to_update'] = 300;
$config['sess_regenerate_destroy'] = FALSE;

/*
|--------------------------------------------------------------------------
| Cookie Settings
|--------------------------------------------------------------------------
*/
$config['cookie_prefix']	= '';
$config['cookie_domain']	= '';
$config['cookie_path']		= '/';
$config['cookie_secure']	= isset($_SERVER['HTTPS']); // ✅ secure cookies if HTTPS
$config['cookie_httponly'] 	= TRUE;

/*
|--------------------------------------------------------------------------
| XSS & CSRF
|--------------------------------------------------------------------------
*/
$config['standardize_newlines'] = FALSE;
$config['global_xss_filtering'] = FALSE;
$config['csrf_protection'] = FALSE;
$config['csrf_token_name'] = 'csrf_test_name';
$config['csrf_cookie_name'] = 'csrf_cookie_name';
$config['csrf_expire'] = 7200;
$config['csrf_regenerate'] = TRUE;
$config['csrf_exclude_uris'] = array();

/*
|--------------------------------------------------------------------------
| Output Compression
|--------------------------------------------------------------------------
*/
$config['compress_output'] = FALSE;

/*
|--------------------------------------------------------------------------
| Time Reference
|--------------------------------------------------------------------------
*/
$config['time_reference'] = 'local';

/*
|--------------------------------------------------------------------------
| PHP Short Tags
|--------------------------------------------------------------------------
*/
$config['rewrite_short_tags'] = FALSE;

/*
|--------------------------------------------------------------------------
| Proxy IPs
|--------------------------------------------------------------------------
*/
$config['proxy_ips'] = '';
