class server () {

    # Few packages
    $packages = ["curl", "tidy"]
    package { $packages:
        ensure  => latest,
        require => Exec['apt_update'],
    }

    # ScreenRC
    file { ".screenrc":
        ensure  => file,
        path    => '/root/.screenrc',
        source  => 'puppet:///modules/server/.screenrc',
    }
    file { ".screenrc for vagrant":
        ensure  => file,
        path    => '/home/vagrant/.screenrc',
        source  => 'puppet:///modules/server/.screenrc',
    }

}
