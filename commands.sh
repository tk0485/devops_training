#!/bin/bash

docker network create --subnet=173.18.0.0/16 bookNetwork

docker build . -t test && docker container run -d -p 30001:80 -e MYSQL_ROOT_PASSWORD=rootpassword -e MYSQL_USER=rootuser -e MYSQL_PASSWORD=password -e MYSQL_DATABASE=test_db --name sql --net bookNetwork --ip 173.18.0.2 mysql:5.7 && docker run -d -p 80:83 --name bookInsert --ip bookNetwork --ip 173.18.0.1 test
