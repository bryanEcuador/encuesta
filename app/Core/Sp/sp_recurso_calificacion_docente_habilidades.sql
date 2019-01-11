
delimiter //
CREATE  PROCEDURE `sp_recurso_calificacion_docente_habilidades`(in fecha date)
begin
select count(id) as cantidad , habilidades from tb_calificacion_docente
where extract(year from fecha_creacion) = fecha
group by habilidades;
end
// delimiter //

