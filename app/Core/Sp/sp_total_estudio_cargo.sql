delimiter //
CREATE  PROCEDURE `sp_total_estudio_cargo`(in fecha date)
begin
select count(id) as cantidad from tb_nivel_estudio_cargo_trabajo
where extract(year from fecha_creacion) = fecha;
end
// delimiter //