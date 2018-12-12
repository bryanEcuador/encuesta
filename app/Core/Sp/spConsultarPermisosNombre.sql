CREATE DEFINER=`root`@`localhost` PROCEDURE `spConsultarPermisosNombre`(
	IN `nombre` varchar(20)
)
begin 
select * from permissions where name like concat('%',nombre,'%');
end