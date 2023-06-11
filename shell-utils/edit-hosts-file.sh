#!/usr/bin/env bash

echo -e "${TAB}Editing hosts file (may need sudo or administrator password)"

hosts="127.0.0.1 propel-me.site aero.propel-me.site airpeace.propel-me.site arik.propel-me.site dana.propel-me.site rano.propel-me.site valuejet.propel-me.site maxair.propel-me.site"

if [[ $(uname) = *"NT-10"* ]]; then
	sucess "${TAB}Please add the following line to C:\Windows\System32\drivers\etc\hosts:"
	sucess ${TAB}${hosts}
else
	echo ${hosts} | sudo tee -a /etc/hosts
	success "${TAB}Hosts file (/etc/hosts) has been updated."
fi

exit 0
