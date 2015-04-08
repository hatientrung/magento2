#!/bin/bash

ln -fs /etc/apache2/mods-available/php5.conf /etc/apache2/mods-enabled/php5.conf
apachectl restart

cd /vagrant/htdocs/magento/setup

php -f index.php install --base_url="http://dev.magento2.local/" --db_host=localhost --db_name=magento --db_user=root --backend_frontname=admin --admin_firstname="admin" --admin_lastname=admin --admin_email=webstei@diglin.com --admin_username=admin --admin_password=admin --language="en_US" --currency="CHF" --timezone="Europe/Berlin" --use_sample_data=1 --cleanup_database

#php index.php install-configuration --db_host=localhost --db_name=magento --db_user=root --backend_frontname=admin
