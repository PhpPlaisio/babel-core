#!/bin/bash -e -x

mysql -v -uroot -h127.0.0.1      < test/ddl/0010_create_database.sql
mysql -v -uroot -h127.0.0.1      < test/ddl/0020_create_user.sql
mysql -v -uroot -h127.0.0.1 test < lib/ddl/0100_create_tables.sql
mysql -v -uroot -h127.0.0.1 test < test/ddl/0300_abc_babel_text_group.sql
mysql -v -uroot -h127.0.0.1 test < test/ddl/0300_abc_babel_word_group.sql
mysql -v -uroot -h127.0.0.1 test < test/ddl/0310_abc_babel_text.sql
mysql -v -uroot -h127.0.0.1 test < test/ddl/0310_abc_babel_word.sql
mysql -v -uroot -h127.0.0.1 test < test/ddl/0320_abc_babel_language.sql
mysql -v -uroot -h127.0.0.1 test < test/ddl/0330_abc_babel_text_text.sql
mysql -v -uroot -h127.0.0.1 test < test/ddl/0330_abc_babel_word_text.sql

./bin/stratum stratum test/etc/stratum.ini
./bin/phpunit

