SET @newid=0;
UPDATE `wp_postmeta_university` SET `meta_id` = (@newid:=@newid+1) ORDER BY `meta_id`

ALTER TABLE `wp_postmeta_university` auto_increment = 9452;