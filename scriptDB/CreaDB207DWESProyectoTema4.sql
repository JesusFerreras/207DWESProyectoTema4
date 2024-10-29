create database if not exists DB207DWESProyectoTema4;
create user if not exists 'user207DWESProyectoTema4'@'%' identified by 'paso';
grant all privileges on DB207DWESProyectoTema4.* to 'user207DWESProyectoTema4'@'%';
create table if not exists DB207DWESProyectoTema4.T02_Departamento(
    T02_CodDepartamento char(3) primary key,
    T02_DescDepartamento varchar(255),
    T02_FechaCreacionDepartamento datetime,
    T02_VolumenDeNegocio float,
    T02_FechaBajaDepartamento datetime
)engine=innodb;