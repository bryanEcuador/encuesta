CREATE DEFINER=`root`@`localhost` PROCEDURE `spConsultarCategoriasTodos`(
)
begin
	select *from tb_categoria where estado = 1; 
    
end