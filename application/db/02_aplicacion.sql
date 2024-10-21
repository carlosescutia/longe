DROP TABLE IF EXISTS organizacion;
ALTER TABLE usuario RENAME COLUMN id_organizacion TO id_comunidad;
ALTER TABLE bitacora RENAME COLUMN nom_organizacion TO nom_comunidad;

DROP TABLE IF EXISTS grupo;
CREATE TABLE grupo (
    id_grupo serial,
    nom_grupo text
);

DROP TABLE IF EXISTS comunidad;
CREATE TABLE comunidad (
    id_comunidad serial,
    id_grupo integer,
    id_responsable integer,
    nom_comunidad text,
    direccion text,
    telefono text,
    ciudad text,
    activo integer
);

DROP TABLE IF EXISTS persona;
CREATE TABLE persona (
    id_persona serial,
    id_comunidad integer,
    nom_persona text,
    fecha_ingreso date,
    id_instructor_inicial integer,
    id_instructor_actual integer,
    sexo text,
    id_talla_yazbek integer,
    es_instructor integer,
    activo integer
);

DROP TABLE IF EXISTS grado;
CREATE TABLE grado (
    id_grado serial,
    nom_grado text,
    orden integer
);

DROP TABLE IF EXISTS persona_grado;
CREATE TABLE persona_grado (
    id_persona integer,
    id_grado integer,
    id_evento integer,
    id_otorgante integer,
    fecha date,
    nota text
);

DROP TABLE IF EXISTS evento;
CREATE TABLE evento (
    id_evento serial,
    id_comunidad integer,
    nom_evento text,
    fecha_ini date,
    fecha_fin date,
    lugar text
);

DROP TABLE IF EXISTS operacion;
CREATE TABLE operacion (
    id_operacion serial,
    fecha date,
    id_entidad integer,
    id_producto integer,
    cantidad integer,
    id_forma_pago integer,
    nota text
);

DROP TABLE IF EXISTS producto;
CREATE TABLE producto (
    id_producto serial,
    id_entidad integer,
    codigo text,
    nom_producto text,
    precio integer
);

DROP TABLE IF EXISTS forma_pago;
CREATE TABLE forma_pago (
    id_forma_pago serial,
    nom_forma_pago text
);

DROP TABLE IF EXISTS dato_persona;
CREATE TABLE dato_persona (
    id_dato_persona serial,
    id_persona integer,
    nom_dato_persona text,
    domicilio text,
    telefono text
);

DROP TABLE IF EXISTS talla_yazbek;
CREATE TABLE talla_yazbek (
    id_talla_yazbek serial,
    nom_talla_yazbek text,
    orden integer
);



/* Aplicación */

INSERT INTO grupo (id_grupo, nom_grupo) VALUES
    (1,'Longe do Mar'),
    (2,'Capoeira Cura'),
    (3,'Cordão de Ouro');

INSERT INTO comunidad (id_grupo, id_comunidad, nom_comunidad, ciudad, activo) VALUES
    (1,1,'Odara Roma','Ciudad de México',1),
    (1,2,'León LdM','León',1),
    (2,3,'Capoeira Cura León','León',1),
    (3,4,'CDO Bajío','León',1);

INSERT INTO talla_yazbek (id_talla_yazbek, nom_talla_yazbek, orden) VALUES
    (1,'Mujer CH',1),
    (2,'Mujer M',2),
    (3,'Mujer G',3),
    (4,'Mujer EG',4),
    (5,'Hombre CH',5),
    (6,'Hombre M',6),
    (7,'Hombre G',7),
    (8,'Hombre EG',8);

INSERT INTO persona (id_persona, id_comunidad, nom_persona, fecha_ingreso, id_instructor_inicial, id_instructor_actual, sexo, id_talla_yazbek, es_instructor, activo) VALUES
    (1,1,'Cigano',null,null,'H',null,1,1),
    (2,1,'Arame',null,null,'H',null,1,0),
    (3,3,'Palito',null,null,'H',null,1,1),
    (4,4,'Pita Tigresa',null,null,'M',null,1,1),
    (5,2,'Pretzel','2002-01-01',2,1,'H',null,1,1),
    (6,2,'Marionete','2010-01-01',5,5,'H',6,1,1),
    (7,2,'Chiclete','2018-03-10',5,5,'H',6,0,1),
    (8,2,'Abril','2024-05-10',5,6,'M',1,0,1),
    (9,2,'Caboclo LdM','2017-09-01',5,5,'H',8,0,0),
    (10,2,'Pequenho','2021-07-18',5,5,'H',8,0,0),
    (11,4,'Caboclo CdO',null,4,'H',null,1,1);

UPDATE comunidad SET id_responsable = 1 WHERE id_comunidad = 1;
UPDATE comunidad SET id_responsable = 5 WHERE id_comunidad = 2;
UPDATE comunidad SET id_responsable = 3 WHERE id_comunidad = 3;
UPDATE comunidad SET id_responsable = 4 WHERE id_comunidad = 4;



/* Sistema */

INSERT INTO usuario (id_comunidad, id_rol, nom_usuario, usuario, password, activo) VALUES
    (2,'sup','Pretzel Rodriguez','pretzel','hola',1);

INSERT INTO opcion_sistema (cod_opcion_sistema, nom_opcion_sistema, otorgable) VALUES
    ('grupo.can_edit','Editar grupos',null),
    ('comunidad.can_edit','Editar comunidades',null),
    ('persona.can_edit','Editar personas',null),
    ('talla_yazbek.can_edit','Editar tallas yazbek',null);

INSERT INTO acceso_sistema (id_rol, cod_opcion_sistema) VALUES
    ('adm','grupo.can_edit'),
    ('adm','comunidad.can_edit'),
    ('adm','persona.can_edit'),
    ('adm','talla_yazbek.can_edit'),
    ('sup','comunidad.can_edit'),
    ('sup','persona.can_edit');
