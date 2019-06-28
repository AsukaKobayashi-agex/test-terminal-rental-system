#
# Cookbook Name:: jenkins
# Recipe:: default
#
# Copyright 2015, YOUR_COMPANY_NAME
#
# All rights reserved - Do Not Redistribute
#
package 'java-1.8.0-openjdk' do
  action :install
end

# Get source file
cookbook_file '/tmp/' + node['jenkins']['rpm'] do
  source "#{node['jenkins']['rpm']}"
end

package "jenkins" do
  action :install
  source '/tmp/' + node['jenkins']['rpm']
  provider Chef::Provider::Package::Rpm
  not_if "rpm -q jenkins"
end

service "jenkins" do
  action [:enable, :start]
end

service 'iptables' do
    action [:disable, :stop]
end