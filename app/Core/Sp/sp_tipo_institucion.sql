delimiter //
create procedure sp_tipo_institucion(in fecha date) 
begin
select ins.descpcion , count(pro.id) as total from tb_informacion_profesional pro
inner join tb_tipo_institucion ins on pro.tipo_institucion_id = ins.id
where extract(year from pro.fecha_creacion) = fecha
 group by pro.tipo_institucion_id ; 
end
// delimiter //

