delimiter //
CREATE  PROCEDURE `sp_recurso_carrera_talento`(in fecha date)
begin
select count(id) as cantidad , talento from tb_recursos_carreras
where extract(year from fecha_creacion) = fecha
group by talento;
end
// delimiter //