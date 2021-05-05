#!/bin/bash

php ../vendor/bin/openapi --format json --bootstrap ./swagger-variables.php --output ../public/swagger/swagger.json ../src/Controller