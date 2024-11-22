ALTER TABLE grupo ADD COLUMN IF NOT EXISTS activo integer;
ALTER TABLE grado ADD COLUMN IF NOT EXISTS activo integer;
ALTER TABLE forma_pago ADD COLUMN IF NOT EXISTS activo integer;
ALTER TABLE talla_yazbek ADD COLUMN IF NOT EXISTS activo integer;

ALTER TABLE comunidad ADD COLUMN IF NOT EXISTS mensaje text;
ALTER TABLE producto ADD COLUMN IF NOT EXISTS id_evento integer;
ALTER TABLE evento ADD COLUMN IF NOT EXISTS activo integer;
