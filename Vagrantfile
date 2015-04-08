# -*- mode: ruby -*-
# vi: set ft=ruby :

# Vagrantfile API/syntax version. Don't touch unless you know what you're doing!
VAGRANTFILE_API_VERSION = "2"
virtualbox_ip = "192.168.30.15";
hostname = 'dev.magento2.local';

pref_interface = ['en0: Wi-Fi (AirPort)']
vm_interfaces = %x( VBoxManage list bridgedifs | grep ^Name ).gsub(/Name:\s+/, '').split("\n")
pref_interface = pref_interface.map {|n| n if vm_interfaces.include?(n)}.compact
$network_interface = pref_interface[0]

Vagrant.configure(VAGRANTFILE_API_VERSION) do |config|
  # All Vagrant configuration is done here. The most common configuration
  # options are documented and commented below. For a complete reference,
  # please see the online documentation at vagrantup.com.

  # Every Vagrant virtual environment requires a box to build off of.
  #config.vm.box = "base"
#  config.vm.box = "ubuntu-12.04-x64-puppet"
#  config.vm.box = "ubuntu-14.04-amd64-puppet"

  # The url from where the 'config.vm.box' box will be fetched if it
  # doesn't already exist on the user's system.
  # config.vm.box_url = "http://domain.com/path/to/above.box"
#  config.vm.box_url = "http://puppet-vagrant-boxes.puppetlabs.com/ubuntu-server-12042-x64-vbox4210.box"
#  config.vm.box_url = "https://oss-binaries.phusionpassenger.com/vagrant/boxes/latest/ubuntu-14.04-amd64-vbox.box"

  # Create a forwarded port mapping which allows access to a specific port
  # within the machine from a port on the host machine. In the example below,
  # accessing "localhost:8080" will access port 80 on the guest machine.
  config.vm.network :forwarded_port, guest: 80, host: 8080, auto_correct: true
  config.vm.network :forwarded_port, guest: 2222, host: 22, auto_correct: true
  #config.vm.network :forwarded_port, guest: 1080, host: 1080, auto_correct: true

  # Create a private network, which allows host-only access to the machine
  # using a specific IP.
#  config.vm.network :private_network, ip: virtualbox_ip
  config.hostmanager.enabled = true
  config.hostmanager.manage_host = true
  config.hostmanager.ignore_private_ip = false
  config.hostmanager.include_offline = true
  config.vm.hostname = hostname

  # Create a public network, which generally matched to bridged network.
  # Bridged networks make the machine appear as another physical device on
  # your network.
  config.vm.network :public_network, :bridge => $network_interface

  # If true, then any SSH connections made will enable agent forwarding.
  # Default value: false
  config.ssh.forward_agent = true

  # Share an additional folder to the guest VM. The first argument is
  # the path on the host to the actual folder. The second argument is
  # the path on the guest to mount the folder. And the optional third
  # argument is a set of non-required options.
  # config.vm.synced_folder "../data", "/vagrant_data"
#    config.vm.synced_folder "./htdocs", "/var/www", :nfs => true,
#									mount_options: ["nolock", "async"],
#									bsd__nfs_options: ["alldirs","async","nolock"]
#  config.vm.synced_folder "./htdocs", "/var/www", type: "rsync", rsync__auto: true, rsync__exclude: ".git/"

  # Provider-specific configuration so you can fine-tune various
  # backing providers for Vagrant. These expose provider-specific options.
  # Example for VirtualBox:
  #
  # config.vm.provider :virtualbox do |vb|
  #   # Don't boot with headless mode
  #   vb.gui = true
  #
  #   # Use VBoxManage to customize the VM. For example to change memory:
  #   vb.customize ["modifyvm", :id, "--memory", "1024"]
  # end
  #
  # View the documentation for the provider you're using for more
  # information on available options.
  # VMWare Fusion customization
  config.vm.provider :vmware_fusion do |vmware, override|
    # Which box?
    override.vm.box = "ubuntu-trusty-fusion"
    override.vm.box_url = "https://oss-binaries.phusionpassenger.com/vagrant/boxes/latest/ubuntu-14.04-amd64-vmwarefusion.box"
    # Customize VM
    vmware.vmx["memsize"] = "2048"
    vmware.vmx["numvcpus"] = "2"
	# Network
	vmware.vmx["ethernet1.present"] = "TRUE"
	vmware.vmx["ethernet1.connectionType"] = "hostonly"
	vmware.vmx["ethernet1.virtualDev"] = "e1000"
	vmware.vmx["ethernet1.wakeOnPcktRcv"] = "FALSE"
	vmware.vmx["ethernet1.addressType"] = "generated"
  end
  
	# Virtualbox customization
	config.vm.provider :virtualbox do |virtualbox, override|
		# Which box?
		override.vm.box = "ubuntu-trusty"
		override.vm.box_url = "https://oss-binaries.phusionpassenger.com/vagrant/boxes/latest/ubuntu-14.04-amd64-vbox.box"
		# Customize VM
		virtualbox.customize ["modifyvm", :id, "--memory", "2048", "--cpus", "2", "--pae", "on", "--hwvirtex", "on", "--ioapic", "on"]
		# Network
		override.vm.network :private_network, ip: virtualbox_ip
	end

  # Enable provisioning with Puppet stand alone.  Puppet manifests
  # are contained in a directory path relative to this Vagrantfile.
  # You will need to create the manifests directory and a manifest in
  # the file base.pp in the manifests_path directory.
  #
  # An example Puppet manifest to provision the message of the day:
  #
  # # group { "puppet":
  # #   ensure => "present",
  # # }
  # #
  # # File { owner => 0, group => 0, mode => 0644 }
  # #
  # # file { '/etc/motd':
  # #   content => "Welcome to your Vagrant-built virtual machine!
  # #               Managed by Puppet.\n"
  # # }
  #
  # config.vm.provision :puppet do |puppet|
  #   puppet.manifests_path = "manifests"
  #   puppet.manifest_file  = "site.pp"
  # end
  config.vm.provision :shell, :inline => 'apt-get update'
  
	# "Provision" with hostmanager
	config.vm.provision :hostmanager
  
  config.vm.provision :puppet do |puppet|
    puppet.manifests_path   = "puppet/manifests"
    puppet.module_path      = "puppet/modules"
    puppet.manifest_file    = "init.pp"
    puppet.options          = "--hiera_config=/vagrant/puppet/hiera.yaml --verbose --debug"
#    puppet.options 			= "--verbose --debug"

    # Factors
    puppet.facter = {
        "vagrant"           => "1",
        "logs_dir"          => "/vagrant/logs",
        "hostname"          => hostname,
        "db_root_password"  => "mysql",
        "db_user"           => "root",
        "db_password"       => "",
        "db_name"           => "magento",
        "document_root"     => "/vagrant/htdocs"
    }
  end
end

# Local file
begin
load 'LocalVagrantfile.rb'
rescue LoadError
# ignore
end