class profile::database {

	apt::source {"mariadb":
	    location => "http://ftp.nluug.nl/db/mariadb/repo/5.5/ubuntu",
	    repos => "main",
	    release => $lsbdistcodename,
	    key_server => 'keyserver.ubuntu.com',
	    key => '0xcbcb082a1bb943db'
	} ->
	class {'mysql::server': } ->
	class {'mysql::client': }

	class {'mysql::bindings':
		php_enable => true,
		java_enable => true
	}
}