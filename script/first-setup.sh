#!/bin/bash

# mysql prepare
sudo cp /vagrant/script/add.cnf /etc/mysql/conf.d/add.cnf
echo "restarting mysql..."
sudo systemctl restart mysql
echo "done."

# prepare
echo "prepare insert csv file..."
gzip -dc /vagrant/script/insert.csv.gz > /tmp/insert.csv
echo "done."
echo "create database..."
mysqladmin -uroot create pdo_test > /dev/null 2>&1 || :
echo "done."
echo "create table..."
mysql -uroot pdo_test < /vagrant/script/create_dummy.sql
echo "done."
echo "truncate table..."
mysql -uroot pdo_test -e 'TRUNCATE dummy;'
echo "done."
echo "insert data..."
mysql -uroot pdo_test -e 'LOAD DATA LOCAL INFILE "/tmp/insert.csv"
    INTO TABLE dummy
    FIELDS TERMINATED BY ","
        LINES TERMINATED BY "\n"
    IGNORE 1 LINES (@id, @name, @comment)
    SET id = @id, name = @name, comment = @comment, created = NOW(), updated = NOW();'
echo "done."
rm -rf /tmp/insert.csv

echo "set symbolic link to index.php..."
sudo ln -sf /vagrant/src/*.php /var/www/html/
sudo rm -rf /var/www/html/index.html > /dev/null 2>&1 || :
echo "done."
