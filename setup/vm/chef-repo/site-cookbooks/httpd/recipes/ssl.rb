#
# Cookbook Name:: httpd
# Recipe:: ssl
#
# Copyright 2014, YOUR_COMPANY_NAME
#
# All rights reserved - Do Not Redistribute
#
%w{openssl mod_ssl}.each do |pkg|
  package pkg do
    action [:install]
  end
end

bash "generate server.crt" do
  cwd '/etc/pki/tls'
  code <<-EOC
    openssl md5 /var/log/messages > key`date +%Y`.rand
    openssl genrsa \
              -rand key`date +%Y`.rand \
              -des3 \
              -passout pass:bprpro \
              -out private/localhost.key 2048
    openssl req \
              -batch \
              -new \
              -key private/localhost.key \
              -out localhost.csr \
              -passin pass:bprpro \
              -subj '/C=JP/ST=Kyoto/L=Kyoto-shi/O=self/OU=self/CN=LocalHost'
    openssl x509 \
              -days 3650 \
              -req \
              -signkey server.key \
              -passin pass:bprpro \
              < localhost.csr \
              > certs/localhost.crt
  EOC
  creates '/etc/pki/tls/certs/localhost.crt'
end

bash "unlock localhost.key" do
  cwd '/etc/pki/tls/private'
  code <<-EOC
    cp -p localhost.key localhost.key.org
    openssl rsa \
              -in localhost.key.org \
              -out localhost.key \
              -passin pass:bprpro
  EOC
  creates '/etc/pki/tls/private/localhost.key.org'
end

