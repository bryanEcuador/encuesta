delimiter //
CREATE  PROCEDURE `sp_recurso_calificacion_docente_dominio_asignatura`(in fecha date)
begin
select count(id) as cantidad , dominio_asignatura from tb_calificacion_docente
where extract(year from fecha_creacion) = fecha
group by dominio_asignatura;
end
// delimiter //