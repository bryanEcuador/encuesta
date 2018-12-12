CREATE DEFINER=`root`@`localhost` PROCEDURE `spUsuariosShow`(
	IN `_id` int
)
begin

select u.name as name, u.email as email , u.created_at as fecha_creacion , u.updated_at as fecha_actualizacion , ru.role_id as rol
from users u 
join role_user ru
on   ru.user_id = u.id
 where u.id= _id;
end