#!/bin/bash

source bin/set_vars.sh
docker-compose exec ${API_NAME} composer "$@"
source bin/unset_vars.sh
