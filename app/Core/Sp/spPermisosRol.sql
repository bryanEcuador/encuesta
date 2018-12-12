CREATE DEFINER=`root`@`localhost` PROCEDURE `spPermisosRol`(in _rol_id int)
begin 
	select pr.id, p.name from permission_role pr
				join permissions p  on
				pr.permission_id = p.id
	where role_id = _rol_id;
end