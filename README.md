### Vagrant / Puppet Installation Package

Start a VM with Ubuntu 12.04 LTS and provision with different services via Puppet:
- Git
- Java
- Mailcatcher
- MySQL
- PHP
- Sendmail
- Magento tools: modman, installer, magerun, casperjs


### Installation

```
git clone https://bitbucket.org/diglin/vagrant-puppet.git myproject
git submodule init
git submodule update
```

or 

```
git clone https://bitbucket.org/diglin/vagrant-puppet.git myproject
cd myproject/
./init.sh
```


### Configuration

Edit the files:

`cp Vagrantfile.template Vagrantfile`

`cp puppet/manifests/hieradata/apache.template.yaml puppet/manifests/hieradata/apache.yaml`

`cp puppet/manifests/hieradata/mysql.template.yaml puppet/manifests/hieradata/mysql.yaml`
