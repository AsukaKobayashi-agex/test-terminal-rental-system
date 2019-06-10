#
# Cookbook Name:: php
# Recipe:: default
#
# Copyright 2014, YOUR_COMPANY_NAME
#
# All rights reserved - Do Not Redistribute
#
%w(
  php
  php-mbstring
  php-pdo
  php-mysqlnd
  php-pear
  php-devel
  php-opcache
).each do |package|
  bash 'install #{package}' do
      code <<-EOS
          yum -y --enablerepo=remi-php72 install #{package}
      EOS
  end
end

bash "install xdebug" do
  code <<-EOC
    sudo pecl install -a xdebug
  EOC
  not_if { ::File.exists?("/usr/lib64/php/modules/xdebug.so") }
end

cookbook_file "/etc/php.ini" do
  source "php.ini"
end

cookbook_file "/etc/php.d/10-opcache.ini" do
  source "10-opcache.ini"
end
