delimiter //
CREATE  PROCEDURE `sp_recurso_calificacion_docente_metodologia`(in fecha date)
begin
select count(id) as cantidad , metodologia from tb_calificacion_docente
where extract(year from fecha_creacion) = fecha
group by metodologia;
end
// delimiter //