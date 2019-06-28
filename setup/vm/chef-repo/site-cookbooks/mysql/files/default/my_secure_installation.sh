#!/usr/bin/bash

if [ ! -e /tmp/complete_mysql_secure_installation ]; then
expect -c " 
   spawn sudo mysql_secure_installation 
   expect \"Enter current password for root \" 
   send -- \"\n\" 
   expect \"Set root password?\" 
   send -- \"Y\n\" 
   expect \"New password:\" 
   send -- \"Passw0rd\n\" 
   expect \"Re-enter new password:\" 
   send -- \"Passw0rd\n\" 
   expect \"Remove anonymous users?\" 
   send -- \"Y\n\" 
   expect \"Disallow root login remotely?\" 
   send -- \"n\n\" 
   expect \"Remove test database and access to it?\" 
   send -- \"Y\n\" 
   expect \"Reload privilege tables now?\" 
   send -- \"Y\n\" 
   expect \"xxxxxxxxxxxxxxxxxxx\" 
"
fi
