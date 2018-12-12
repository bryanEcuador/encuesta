CREATE DEFINER=`root`@`localhost` PROCEDURE `spPermisosRolFaltantes`(in _rol_id int)
begin 
	select id,name , slug from permissions
where id not in ( (select pr.permission_id from permission_role pr where pr.role_id = _rol_id ) );
end