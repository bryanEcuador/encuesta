delimiter //
CREATE  PROCEDURE `sp_recurso_calificacion_docente_actualizacion_conocimiento`(in fecha date)
begin
select count(id) as cantidad , actualizacion_conocimiento from tb_calificacion_docente
where extract(year from fecha_creacion) = fecha
group by actualizacion_conocimiento;
end
// delimiter //