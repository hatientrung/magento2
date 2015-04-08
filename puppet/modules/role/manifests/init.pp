class role {

	Exec {
	    path => [
	        '/usr/local/bin',
	        '/opt/local/bin',
	        '/usr/bin',
	        '/usr/sbin',
	        '/bin',
	        '/sbin'
	    ],
	    logoutput => false,
	}

	class { 'apt':
	  always_apt_update => true,
	}

  	include profile::webserver
	include profile::database
	include profile::java
	include profile::mail

}