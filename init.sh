#!/bin/bash

git submodule init
git submodule update

cp Vagrantfile.template Vagrantfile
cp puppet/manifests/hieradata/apache.template.yaml puppet/manifests/hieradata/apache.yaml
cp puppet/manifests/hieradata/mysql.template.yaml puppet/manifests/hieradata/mysql.yaml

