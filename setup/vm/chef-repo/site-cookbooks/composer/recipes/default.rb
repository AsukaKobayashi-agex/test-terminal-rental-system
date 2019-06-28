#
# Cookbook Name:: laravel
# Recipe:: default
#
# Copyright 2014, YOUR_COMPANY_NAME
#
# All rights reserved - Do Not Redistribute
#
%w{zip unzip}.each do |pkg|
  package pkg do
    action :install
  end
end

cookbook_file "composer-setup.php" do
  path "/tmp/composer-setup.php"
  source "installer"
end

bash "install composer" do
  code <<-EOC
    cd /tmp
    sudo php composer-setup.php
    mv composer.phar /usr/local/bin/composer
  EOC
  not_if { ::File.exists?("/usr/local/bin/composer") }
end
