TYPE=VIEW
query=select year(`cera_database`.`sellingorders`.`createdat`) AS `sellingyear`,date_format(`cera_database`.`sellingorders`.`createdat`,\'%b\') AS `sellingmonth`,count(`cera_database`.`sellingorders`.`id`) AS `ordercount` from `cera_database`.`sellingorders` where `cera_database`.`sellingorders`.`status` = 1 group by year(`cera_database`.`sellingorders`.`createdat`),date_format(`cera_database`.`sellingorders`.`createdat`,\'%b\')
md5=653762fd26dd48e2ab7dfb4d51f01064
updatable=0
algorithm=0
definer_user=root
definer_host=localhost
suid=1
with_check_option=0
timestamp=0001709880985871743
create-version=2
source=SELECT\n    YEAR(\n        `cera_database`.`sellingorders`.`createdat`\n    ) AS `sellingyear`,\n    DATE_FORMAT(\n        `cera_database`.`sellingorders`.`createdat`,\n        \'%b\'\n    ) AS `sellingmonth`,\n    COUNT(`cera_database`.`sellingorders`.`id`) AS `ordercount`\nFROM\n    `cera_database`.`sellingorders`\nWHERE\n    `cera_database`.`sellingorders`.`status` = 1\nGROUP BY sellingyear,sellingmonth
client_cs_name=utf8mb4
connection_cl_name=utf8mb4_unicode_ci
view_body_utf8=select year(`cera_database`.`sellingorders`.`createdat`) AS `sellingyear`,date_format(`cera_database`.`sellingorders`.`createdat`,\'%b\') AS `sellingmonth`,count(`cera_database`.`sellingorders`.`id`) AS `ordercount` from `cera_database`.`sellingorders` where `cera_database`.`sellingorders`.`status` = 1 group by year(`cera_database`.`sellingorders`.`createdat`),date_format(`cera_database`.`sellingorders`.`createdat`,\'%b\')
mariadb-version=100432
