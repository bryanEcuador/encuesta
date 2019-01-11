delimiter //
CREATE  PROCEDURE `sp_relacion_estudio_cargo`(in fecha date)
begin
select count(id) as cantidad , descripcion from tb_nivel_estudio_cargo_trabajo
-- where extract(year from fecha_creacion) = fecha
 group by descripcion ;
end
// delimiter //