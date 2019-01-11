delimiter //
create procedure sp_total_cargos(in fecha date) 
begin
select count(cargo_id) as cantidad from tb_informacion_profesional where extract(year from fecha_creacion ) = fecha;
end
// delimiter //