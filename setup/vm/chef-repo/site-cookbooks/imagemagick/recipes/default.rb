#
# Cookbook Name:: imagemagick
# Recipe:: default
#
# Copyright 2015, YOUR_COMPANY_NAME
#
# All rights reserved - Do Not Redistribute
#
%w[
  ImageMagick
  ImageMagick-devel
].each do |pkg|
  package "#{pkg}" do
    action :install
  end
end

execute "install imagick" do
  command <<-EOH
		sudo pecl install imagick
EOH
  action :run
  not_if { File.exists?("/usr/lib64/php/modules/imagick.so") }
  notifies :restart, "service[httpd]"
end
