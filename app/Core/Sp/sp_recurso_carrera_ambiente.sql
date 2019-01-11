delimiter //
CREATE  PROCEDURE `sp_recurso_carrera_ambiente`(in fecha date)
begin
select count(id) as cantidad , ambiente from tb_recursos_carreras
where extract(year from fecha_creacion) = fecha
group by ambiente;
end
// delimiter //