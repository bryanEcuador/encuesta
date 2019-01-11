delimiter //
CREATE  PROCEDURE `sp_recurso_carrera_servicio`(in fecha date)
begin
select count(id) as cantidad , servicio from tb_recursos_carreras
where extract(year from fecha_creacion) = fecha
group by servicio;
end
// delimiter //