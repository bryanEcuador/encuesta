DELIMITER $$
CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_calificacion_docente_actualizacion_conocimientos`(in fecha smallint)
begin
select count(cd.id) as cantidad , cd.actualizacion_conocimiento from tb_calificacion_docente cd
inner join tb_encuesta enc on cd.id = enc.calificacion_docente_id
where extract(year from cd.fecha_creacion) = fecha
and enc.estado = 1
group by cd.dominio_asignatura;
end$$
DELIMITER ;