BEGIN TRANSACTION;

DROP TABLE IF EXISTS usuarios CASCADE;
CREATE TABLE usuarios (
	rut int NOT NULL,
	email varchar(255),
	nombres varchar(255),
	apellidos varchar(255),
	remember_token character varying(100),
	created_at timestamp NOT NULL DEFAULT NOW(),
	updated_at timestamp NOT NULL DEFAULT NOW(),
	UNIQUE (email),
        PRIMARY KEY (rut)
);



DROP TABLE IF EXISTS periodos CASCADE;
CREATE TABLE periodos (
	id bigserial NOT NULL,
	bloque varchar(255) NOT NULL,
	inicio time NOT NULL,
    fin time NOT NULL,
	created_at timestamp NOT NULL DEFAULT NOW(),
	updated_at timestamp NOT NULL DEFAULT NOW(),
	UNIQUE (bloque),
    UNIQUE (inicio, fin),
	PRIMARY KEY (id)
);


DROP TABLE IF EXISTS roles CASCADE;
CREATE TABLE roles (
	id serial NOT NULL,
	nombre varchar(255) NOT NULL,
	descripcion text,
	created_at timestamp NOT NULL DEFAULT NOW(),
	updated_at timestamp NOT NULL DEFAULT NOW(),
	UNIQUE (nombre),
	PRIMARY KEY (id)
);

DROP TABLE IF EXISTS roles_usuarios CASCADE;
CREATE TABLE roles_usuarios (
	id serial NOT NULL,
	rut int NOT NULL REFERENCES usuarios(rut) ON UPDATE CASCADE ON DELETE CASCADE,
	rol_id int NOT NULL REFERENCES roles(id) ON UPDATE CASCADE ON DELETE CASCADE,
	created_at timestamp NOT NULL DEFAULT NOW(),
	updated_at timestamp NOT NULL DEFAULT NOW(),
	UNIQUE (rut, rol_id),
	PRIMARY KEY (id)
);


DROP TABLE IF EXISTS campus CASCADE;
CREATE TABLE campus (
	id serial NOT NULL,
	nombre varchar(255) NOT NULL,
	direccion varchar(255) NOT NULL,
	descripcion text,
	rut_encargado int NOT NULL,
	created_at timestamp NOT NULL DEFAULT NOW(),
	updated_at timestamp NOT NULL DEFAULT NOW(),
	UNIQUE (nombre),
	PRIMARY KEY (id)
);


DROP TABLE IF EXISTS facultades CASCADE;
CREATE TABLE facultades (
	id serial NOT NULL,
	nombre varchar(255) NOT NULL,
	campus_id int NOT NULL REFERENCES campus(id) ON UPDATE CASCADE ON DELETE CASCADE,
	descripcion text,
	created_at timestamp NOT NULL DEFAULT NOW(),
	updated_at timestamp NOT NULL DEFAULT NOW(),
	UNIQUE (nombre),
	PRIMARY KEY (id)
);


DROP TABLE IF EXISTS departamentos CASCADE;
CREATE TABLE departamentos (
	id serial NOT NULL,
	nombre varchar(255) NOT NULL,
	facultad_id int NOT NULL REFERENCES facultades(id) ON UPDATE CASCADE ON DELETE CASCADE,
	descripcion text,
	created_at timestamp NOT NULL DEFAULT NOW(),
	updated_at timestamp NOT NULL DEFAULT NOW(),
	UNIQUE (nombre, facultad_id),
	PRIMARY KEY (id)
);


DROP TABLE IF EXISTS escuelas CASCADE;
CREATE TABLE escuelas (
	id serial NOT NULL,
	nombre varchar(255) NOT NULL,
	departamento_id int NOT NULL REFERENCES departamentos(id) ON UPDATE CASCADE ON DELETE CASCADE,
	descripcion text,
	created_at timestamp NOT NULL DEFAULT NOW(),
	updated_at timestamp NOT NULL DEFAULT NOW(),
	UNIQUE (nombre, departamento_id),
	PRIMARY KEY (id)
);


DROP TABLE IF EXISTS carreras CASCADE;
CREATE TABLE carreras (
	id serial NOT NULL,
	escuela_id int NOT NULL REFERENCES escuelas(id) ON UPDATE CASCADE ON DELETE CASCADE,
	codigo int NOT NULL,
	nombre varchar(255) NOT NULL,
	descripcion text,
	created_at timestamp NOT NULL DEFAULT NOW(),
	updated_at timestamp NOT NULL DEFAULT NOW(),
	UNIQUE (codigo),
	UNIQUE (codigo, nombre),
	PRIMARY KEY (id)
);


DROP TABLE IF EXISTS docentes CASCADE;
CREATE TABLE docentes (
	id serial NOT NULL,
	departamento_id int NOT NULL REFERENCES departamentos(id) ON UPDATE CASCADE ON DELETE CASCADE,
	rut int NOT NULL REFERENCES usuarios(rut) ON UPDATE CASCADE ON DELETE CASCADE,
	nombres varchar(255) NOT NULL,
	apellidos varchar(255) NOT NULL,
	email varchar(255) NOT NULL REFERENCES usuarios(email) ON UPDATE CASCADE ON DELETE CASCADE,
	created_at timestamp NOT NULL DEFAULT NOW(),
	updated_at timestamp NOT NULL DEFAULT NOW(),
	UNIQUE (rut),
	UNIQUE (email),
	PRIMARY KEY (id)
);


DROP TABLE IF EXISTS tipos_salas CASCADE;
CREATE TABLE tipos_salas (
	id serial NOT NULL,
	nombre varchar(255) NOT NULL,
	descripcion text,
	created_at timestamp NOT NULL DEFAULT NOW(),
	updated_at timestamp NOT NULL DEFAULT NOW(),
	UNIQUE (nombre),
	PRIMARY KEY (id)
);


DROP TABLE IF EXISTS salas CASCADE;
CREATE TABLE salas (
	id bigserial NOT NULL,
	campus_id int NOT NULL REFERENCES campus(id) ON UPDATE CASCADE ON DELETE CASCADE,
	tipo_sala_id int NOT NULL REFERENCES tipos_salas(id) ON UPDATE CASCADE ON DELETE CASCADE,
	nombre varchar(255) NOT NULL,
	descripcion text,
	capacidad int NOT NULL,
	created_at timestamp NOT NULL DEFAULT NOW(),
	updated_at timestamp NOT NULL DEFAULT NOW(),
	UNIQUE (tipo_sala_id, nombre),
	PRIMARY KEY (id)
);


DROP TABLE IF EXISTS asignaturas CASCADE;
CREATE TABLE asignaturas (
	id bigserial NOT NULL,
	departamento_id int NOT NULL REFERENCES departamentos(id) ON UPDATE CASCADE ON DELETE CASCADE,
	codigo varchar(255) NOT NULL,
	nombre varchar(255) NOT NULL,
	descripcion text,
	created_at timestamp NOT NULL DEFAULT NOW(),
	updated_at timestamp NOT NULL DEFAULT NOW(),
	UNIQUE (codigo),
	PRIMARY KEY (id)
);

DROP TABLE IF EXISTS cursos CASCADE;
CREATE TABLE cursos (
	id bigserial NOT NULL,
	asignatura_id bigint NOT NULL REFERENCES asignaturas(id) ON UPDATE CASCADE ON DELETE CASCADE,
	docente_id int NOT NULL REFERENCES docentes(id) ON UPDATE CASCADE ON DELETE CASCADE,
        semestre int NOT NULL,
        anio int NOT NULL,
	seccion int NOT NULL,
	created_at timestamp NOT NULL DEFAULT NOW(),
	updated_at timestamp NOT NULL DEFAULT NOW(),
	UNIQUE (asignatura_id, docente_id, semestre, anio, seccion),
	PRIMARY KEY (id)
);




DROP TABLE IF EXISTS horarios CASCADE;
CREATE TABLE horarios (
        id bigserial NOT NULL,
        fecha date NOT NULL DEFAULT NOW(),
        sala_id bigint NOT NULL REFERENCES salas(id) ON UPDATE CASCADE ON DELETE CASCADE,
        periodo_id int NOT NULL REFERENCES periodos(id) ON UPDATE CASCADE ON DELETE CASCADE,
	curso_id bigint NOT NULL REFERENCES cursos(id) ON UPDATE CASCADE ON DELETE CASCADE,
	permanencia varchar(255) NOT NULL,
	dia varchar(10) NOT NULL,
	created_at timestamp NOT NULL DEFAULT NOW(),
	updated_at timestamp NOT NULL DEFAULT NOW(),
        UNIQUE (fecha, sala_id, periodo_id),
        PRIMARY KEY (id)
);



COMMIT;
