#
# Cookbook Name:: remi
# Recipe:: default
#
# Copyright 2014, YOUR_COMPANY_NAME
#
# All rights reserved - Do Not Redistribute
#

# EPEL
remote_file "#{Chef::Config[:file_cache_path]}/epel-release-7-11.noarch.rpm" do
  source "http://dl.fedoraproject.org/pub/epel/7/x86_64/Packages/e/epel-release-7-11.noarch.rpm"
  action :create
end
rpm_package "epel-release-7-11.noarch" do
  source "#{Chef::Config[:file_cache_path]}/epel-release-7-11.noarch.rpm"
  action :install
end

# REMI
remote_file "#{Chef::Config[:file_cache_path]}/remi-release-7.rpm" do
  source "http://rpms.famillecollet.com/enterprise/remi-release-7.rpm"
  action :create
end
rpm_package "remi-release-7" do
  source "#{Chef::Config[:file_cache_path]}/remi-release-7.rpm"
  action :install
end
