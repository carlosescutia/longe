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
