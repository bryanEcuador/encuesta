CREATE DEFINER=`root`@`localhost` PROCEDURE `spConsultarPermisostodos`()
begin 
select * from permissions;
end