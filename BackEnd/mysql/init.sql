CREATE DATABASE IF NOT EXISTS swc;
USE swc;

-- Crear usuario con acceso desde cualquier host
CREATE USER 'swc'@'%' IDENTIFIED BY 'swc';

-- Conceder privilegios solo en la base de datos 'esignature'
GRANT ALL PRIVILEGES ON esignature.* TO 'swc'@'%';

-- No es necesario FLUSH PRIVILEGES aquí después del GRANT


