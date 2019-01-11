
delimiter //
CREATE  PROCEDURE `sp_recurso_calificacion_docente_evaluacion`(in fecha date)
begin
select count(id) as cantidad , evaluacion from tb_calificacion_docente
where extract(year from fecha_creacion) = fecha
group by evaluacion;
end
// delimiter //

