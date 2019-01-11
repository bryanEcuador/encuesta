delimiter //
create procedure sp_cargos(in fecha date) 
begin
select car.descpcion , count(pro.id) as total from tb_informacion_profesional pro
inner join tb_tipo_cargo car on pro.cargo_id = car.id where extract(year from pro.fecha_creacion) = fecha group by pro.cargo_id  ; 
end
// delimiter //