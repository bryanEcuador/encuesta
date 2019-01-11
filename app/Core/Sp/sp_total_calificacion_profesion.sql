delimiter //
CREATE  PROCEDURE `sp_total_calificacion_profesion`(in fecha date)
begin
select count(id) as cantidad from tb_calificacion_profesion
where extract(year from fecha_creacion) = fecha;
end
// delimiter //