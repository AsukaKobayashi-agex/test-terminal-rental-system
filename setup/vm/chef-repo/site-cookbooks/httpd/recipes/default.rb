#
# Cookbook Name:: httpd
# Recipe:: default
#
# Copyright 2014, YOUR_COMPANY_NAME
#
# All rights reserved - Do Not Redistribute
#
%w{httpd mod_ssl}.each do |pkg|
  package pkg do
    action [:install]
  end
end

cookbook_file ".htaccess" do
  path "/var/www/rental_system/public/.htaccess"
  source ".htaccess"
  owner "vagrant"
  group "vagrant"
  mode 0777
end


cookbook_file "20-rewrite.conf" do
  path "/etc/httpd/conf.modules.d/20-rewrite.conf"
  source "20-rewrite.conf"
  owner "root"
  group "root"
  mode 0755
  notifies :restart, "service[httpd]"
end


cookbook_file "httpd.conf" do
  path "/etc/httpd/conf/httpd.conf"
  source "httpd.conf"
  owner "root"
  group "root"
  mode 0644
  notifies :restart, "service[httpd]"
end


service "httpd" do
  supports [:enable, :start, :restart, :status]
  action [:enable, :start]
end

