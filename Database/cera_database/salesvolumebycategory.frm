TYPE=VIEW
query=select `c`.`name` AS `CategoryName`,`cs`.`name` AS `SubCategoryName`,sum(`s`.`quantity`) AS `SaleVolume` from (((`cera_database`.`sellingorders_details` `s` left join `cera_database`.`product` `p` on(`s`.`productid` = `p`.`id`)) left join `cera_database`.`category_sub` `cs` on(`p`.`subcategoryid` = `cs`.`id`)) left join `cera_database`.`category` `c` on(`cs`.`categoryid` = `c`.`id`)) where `s`.`productid` is not null group by `c`.`name`,`cs`.`name`
md5=27aab95801965e709a635dd46687a065
updatable=0
algorithm=0
definer_user=root
definer_host=localhost
suid=2
with_check_option=0
timestamp=0001710349147179661
create-version=2
source=SELECT 
client_cs_name=utf8mb4
connection_cl_name=utf8mb4_unicode_ci
view_body_utf8=select `c`.`name` AS `CategoryName`,`cs`.`name` AS `SubCategoryName`,sum(`s`.`quantity`) AS `SaleVolume` from (((`cera_database`.`sellingorders_details` `s` left join `cera_database`.`product` `p` on(`s`.`productid` = `p`.`id`)) left join `cera_database`.`category_sub` `cs` on(`p`.`subcategoryid` = `cs`.`id`)) left join `cera_database`.`category` `c` on(`cs`.`categoryid` = `c`.`id`)) where `s`.`productid` is not null group by `c`.`name`,`cs`.`name`
mariadb-version=100432