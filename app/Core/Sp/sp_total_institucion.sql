delimiter //
create procedure total_institucion(in fecha date) 
begin
select count(id) as cantidad from tb_informacion_profesional where extract(year from fecha_creacion) = fecha;
end
// delimiter //


