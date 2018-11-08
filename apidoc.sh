#!/bin/bash
#"/usr/bin/php" "/var/www/3rd/apigen.phar" "generate" "--source" "/var/www/github/helpers/src" "--destination" "/var/www/github/helpers/_/ApiDoc" "--title" "helpers" "--charset" "UTF-8" "--access-levels" "public" "--access-levels" "protected" "--php" "--tree"

/var/www/github/helpers/bin/phpdoc -t ./_/ApiDoc/ -d src/Helpers/ --template new-black
