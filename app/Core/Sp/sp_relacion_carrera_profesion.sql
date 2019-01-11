delimiter //
CREATE  PROCEDURE `sp_relacion_carrera_profesion`(in fecha date)
begin
select count(id) as cantidad , relacion from tb_relacion_carrera_profesion
where extract(year from fecha_creacion) = fecha
 group by relacion ;
end
// delimiter //