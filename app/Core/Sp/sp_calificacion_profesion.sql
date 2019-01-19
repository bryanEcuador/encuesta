delimiter //
CREATE  PROCEDURE 'sp_calificacion_profesion'(in fecha date)
begin
select count(id) as cantidad , calificacion from tb_calificacion_profesion
where extract(year from fecha_creacion) = fecha
group by calificacion;
end
// delimiter //