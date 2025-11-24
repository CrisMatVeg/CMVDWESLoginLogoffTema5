USE DBCMVDWESLoginLogoffTema5;

CREATE TABLE IF NOT EXISTS T02_Departamento (
    T02_CodDepartamento VARCHAR(3) PRIMARY KEY,
    T02_DescDepartamento VARCHAR(255) NOT NULL,
    T02_FechaCreacionDepartamento DATETIME NOT NULL,
    T02_VolumenDeNegocio FLOAT NOT NULL,
    T02_FechaBajaDepartamento DATETIME
);

CREATE TABLE IF NOT EXISTS T01_Usuarios (
    T01_CodUsuario VARCHAR(10) NOT NULL,
        CHECK (LENGTH(T01_CodUsuario) >= 4),
        PRIMARY KEY (T01_CodUsuario),
    T01_Password VARCHAR(255) NOT NULL,
        CHECK (LENGTH(T01_Password) >= 4),
    T01_DescUsuario VARCHAR(255) NOT NULL,
    T01_NumConexiones INT NOT NULL default 0,
    T01_FechaHoraUltimaConexion DATETIME NOT NULL default now(),
    T01_Perfil VARCHAR(20) NOT NULL default 'usuario',
    T01_ImagenUsuario VARCHAR(255) default null
);

insert into T02_Departamento (T02_CodDepartamento,T02_DescDepartamento,T02_FechaCreacionDepartamento,T02_VolumenDeNegocio,T02_FechaBajaDepartamento) values
        ('INF','Departamento de informatica.',now(),1235.5,null),
        ('AUT','Departamento de automocion.',now(),5235.8,null),
        ('ELE','Departamento de electricidad.',now(),2275.1,null),
        ('MAT','Departamento de matematicas.',now(),735.2,null),
        ('ING','Departamento de ingles.',now(),235.9,now());

insert into T01_Usuarios (T01_CodUsuario,T01_Password,T01_DescUsuario) values
        ('gonzalo',SHA2('gonzalopaso',256),'Gonzalo Junquera Lorenzo'),
        ('enrique',SHA2('enriquepaso',256),'Enrique Nieto Lorenzo'),
        ('alvaroG',SHA2('alvarogpaso',256),'Alvaro Gonzalez'),
        ('jimmy',SHA2('jimmypaso',256),'Jimmy Nuñez Cuzcano'),
        ('oscar',SHA2('oscarpaso',256),'Oscar'),
        ('alejandro',SHA2('alejandropaso',256),'Alejandro'),
        ('alvaroA',SHA2('alvaroapaso',256),'Alvaro Allén Perlines'),
        ('vero',SHA2('veropaso',256),'Veronique Grue'),
        ('alberto',SHA2('albertopaso',256),'Alberto Mendez Nuñez'),
        ('jesus',SHA2('jesuspaso',256),'Jesus Temprano Gallego'),
        ('cristian',SHA2('cristianpaso',256),'Cristian Mateos Vega'),
        ('heraclio',SHA2('heracliopaso',256),'Heraclio Borbujo Moran'),
        ('amor',SHA2('amorpaso',256),'Amor Rodriguez Navarro'),
        ('albertoB',SHA2('albertobpaso',256),'Alberto Bahillo Fernandez'),
        ('antonio',SHA2('antoniopaso',256),'Antonio');