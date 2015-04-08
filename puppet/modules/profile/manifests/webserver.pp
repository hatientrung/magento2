class profile::webserver {

	class { "apache":
        default_vhost => false,
        default_ssl_vhost => false,
		logroot => "${logs_dir}",
		mpm_module    => "prefork",
		apache_version => 2.4, # Force because the autodetect is not efficient in our use case
		require => Exec['apt_update']	
	}

	apache::mod { 'rewrite': }
	apache::mod { 'headers': }
	apache::mod { 'ssl': }
	apache::mod { 'php5': }

	$vhosts = hiera('apache::vhosts')
	create_resources(apache::vhost, $vhosts)

	$params = hiera('apache::params', {})
	create_resources(apache::params, $params)

	Exec ['add php55 apt-repo'] -> Exec ['apt_update'] -> Package['php']

	class { 'php':
		config_file => '/etc/php5/apache2/php.ini',      # Default value on Ubuntu/Suse
		template    => 'profile/php/php.ini-apache2.erb'
	}

	php::conf { 'php.ini-cli':
		path     => '/etc/php5/cli/php.ini',
		content => template('profile/php/php.ini-cli.erb'),
		require => Package ['php']
	}

	php::conf {'xdebug':
		path     => '/etc/php5/mods-available/xdebug.ini',
		content => template('profile/php/xdebug.ini.erb'),
		require => Package ['php', 'PhpModule_xdebug']
	}

	php::module { 'cli': }
	php::module { 'common': }
	php::module { 'gd': }
	php::module { 'mysql': }
	php::module { 'curl': }
	php::module { 'intl': }
	php::module { 'mcrypt': }
	php::module { 'tidy': }
	php::module { 'readline': }
	php::module { 'xdebug':}
	php::module { 'apcu': }

	if ($environment == 'development') {
		#sendmail_path = /usr/bin/env catchmail
	}

	## Includes

	include php55
}