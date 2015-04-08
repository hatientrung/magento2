Vagrant.configure(VAGRANTFILE_API_VERSION) do |config|
	config.vm.provision :shell, :path => "scripts/provision.sh"
end