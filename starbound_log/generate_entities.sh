#!/bin/sh

./doctrine_tool.php orm:convert-mapping --force --namespace="StarboundLog\\Model\\Entities\\" --from-database annotation .
./doctrine_tool.php orm:generate-entities --update-entities=1 .
