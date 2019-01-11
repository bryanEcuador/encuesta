delimiter //
CREATE DEFINER=`root`@`localhost` PROCEDURE `total_relacion_carrera_profesion`(in fecha date)
begin
select count(id) as cantidad from tb_relacion_carrera_profesion where extract(year from fecha_creacion) = fecha;
end
// delimiter //