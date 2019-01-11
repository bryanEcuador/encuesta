delimiter //
CREATE  PROCEDURE `sp_recomendacion_instituto`(in fecha date)
begin
select count(id) as cantidad , recomendaria_institucion from tb_preferencia_estudio
where extract(year from fecha_creacion) = fecha
group by recomendaria_institucion;
end
// delimiter //

