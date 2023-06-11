BOLD=$(tput bold)
RED=$(tput setaf 1)
GREEN=$(tput setaf 2)
YELLOW=$(tput setaf 3)
BLUE=$(tput setaf 4)
GREY=$(tput setaf 7)
RESET=$(tput sgr0)
TAB="  "

function error()
{
	echo -e "${RED}ERROR: ${1}${RESET}"
	exit 1
}

function success()
{
	echo -e "${GREEN}${1}${RESET}"
}

function info()
{
	echo -e "${BLUE}${1}${RESET}"
}

function process_info()
{
    echo -e "${BOLD}⠿⠿⠿⠿ ${1}${RESET}"
}
