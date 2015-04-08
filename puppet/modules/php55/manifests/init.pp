class php55
{
	#PHP 5.5 setup 

	package {"python-software-properties":ensure => present}
	package {"software-properties-common": ensure => present}

	#https://launchpad.net/~ondrej/+archive/php5
	exec 
	{ 
		'add php55 apt-repo':
			command => '/usr/bin/add-apt-repository ppa:ondrej/php5 -y',
			require => [Package['python-software-properties'], Package['software-properties-common']],
	}
}
