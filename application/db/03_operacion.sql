DROP TABLE IF EXISTS operacion;
CREATE TABLE operacion (
    id_operacion serial,
    id_persona integer,
    id_producto integer,
    id_forma_pago integer,
    fecha date,
    cantidad integer,
    precio integer,
    nota text
);

DROP TABLE IF EXISTS producto;
CREATE TABLE producto (
    id_producto serial,
    id_comunidad integer,
    cod_producto text,
    nom_producto text,
    precio integer,
    activo integer
);

DROP TABLE IF EXISTS forma_pago;
CREATE TABLE forma_pago (
    id_forma_pago serial,
    nom_forma_pago text,
    orden int
);
