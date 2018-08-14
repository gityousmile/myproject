#!/bin/bash
mysql -uroot -p123456 -S /dev/shm/mysql.sock <<EOF
use terminal;
select * from videolist;
EOF > test.txt 
