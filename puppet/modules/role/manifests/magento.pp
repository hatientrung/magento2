class role::magento inherits role {
  
  	include profile::java
	
	include server
	include git

	include tools::modman
	include tools::composer
	include tools::magerun
	#include tools::installer
	#include tools::casperjs  
}