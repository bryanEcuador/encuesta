delimiter //
CREATE  PROCEDURE `sp_total_recursos_carrera`(in fecha date)
begin
select count(id) as cantidad from tb_recursos_carreras
where extract(year from fecha_creacion) = fecha;
end
// delimiter //