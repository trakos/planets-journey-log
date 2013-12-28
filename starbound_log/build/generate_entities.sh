#!/bin/sh

./doctrine_tool.php trk:from-database --force --extend="StarboundLog\\Library\\AbstractEntity" --namespace="StarboundLog\\Model\\Entities\\" --repository-namespace="StarboundLog\\Model\\Repositories\\" .
./doctrine_tool.php orm:generate-entities --update-entities=1 .
./doctrine_tool.php trk:generate-repositories .

