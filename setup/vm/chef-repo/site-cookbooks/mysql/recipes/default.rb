#
# Cookbook Name:: mysql
# Recipe:: default
#
# Copyright 2014, YOUR_COMPANY_NAME
#
# All rights reserved - Do Not Redistribute
#

# 元々入っているmariadb-libsを削除
bash "remove mariadb-libs" do
  code <<-EOC
    sudo yum remove mariadb-libs
    touch /tmp/remove_mariadb-libs
  EOC
  not_if { ::File.exists?("/tmp/remove_mariadb-libs") }
end


cookbook_file "mariadb.repo" do
  path "/etc/yum.repos.d/mariadb.repo"
  source "mariadb.repo"
  owner "root"
  group "root"
  mode 0644
end


%w{MariaDB-devel MariaDB-client MariaDB-server}.each do |pkg|
  package pkg do
    action [ :install, :upgrade ]
  end
end


# mysqld 再起動
service "mysqld" do
  supports status: true, restart: true, reload: true
  action   [ :enable, :start ]
end


%W{expect}.each do |pkg|
  package pkg do
    action [:install]
  end
end


cookbook_file "/tmp/my_secure_installation.sh" do
  source "my_secure_installation.sh"
  mode 0755
end

# todo: 2回目以降、実行されない条件を変更
bash "mysql_secure_installation" do
  code <<-EOC
    sh /tmp/my_secure_installation.sh > /tmp/my_secure_installation.log 2>&1
    touch /tmp/complete_mysql_secure_installation
  EOC
  not_if { ::File.exists?("/tmp/complete_mysql_secure_installation") }
end


cookbook_file "server.cnf" do
  path "/etc/my.cnf.d/server.cnf"
  source "server.cnf"
  owner "root"
  group "root"
  mode 0644
  notifies :restart, "service[mysqld]"
end

