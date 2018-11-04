NAME="$(docker ps | grep -e php_php_1 | cut -d " " -f1)"
docker exec -it $NAME /bin/bash
