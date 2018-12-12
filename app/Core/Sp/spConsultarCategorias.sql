CREATE DEFINER=`root`@`localhost` PROCEDURE `spConsultarCategorias`( in _nombre varchar(20) 
)
begin
	select *from tb_categoria where estado = 1 and nombre like concat('%',_nombre,'%'); 
    
end