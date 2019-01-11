delimiter //
CREATE  PROCEDURE `sp_recurso_carrera_infraestructura`(in fecha date)
begin
select count(id) as cantidad , infraestructura from tb_recursos_carreras
where extract(year from fecha_creacion) = fecha
group by infraestructura;
end
// delimiter //