delimiter //
CREATE  PROCEDURE `sp_total_recomendacion_instituto`(in fecha date)
begin
select count(id) as cantidad from tb_preferencia_estudio
where extract(year from fecha_creacion) = fecha;
end
// delimiter //

