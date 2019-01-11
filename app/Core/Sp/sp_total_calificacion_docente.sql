delimiter //
CREATE  PROCEDURE `sp_total_calificacion_docente`(in fecha date)
begin
select count(id) as cantidad from tb_calificacion_docente
where extract(year from fecha_creacion) = fecha;
end
// delimiter //