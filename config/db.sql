-- TABLAS PARA SESION Y USUARIOS
CREATE TABLE tipo_usuario(
	id_tipo int primary key not null,
    nomtipo varchar(30) unique not null
)ENGINE=INNODB;

CREATE TABLE accion_sesion(
	id_accion int primary key not null,
    accion varchar(10) unique not null
)ENGINE=INNODB;

CREATE TABLE usuario(
	id_usuario bigint unsigned auto_increment primary key not null,
    nomusuario varchar(70) unique not null,
    clave varchar(255) not null,
    id_tipo int not null
)ENGINE=INNODB;
ALTER TABLE usuario ADD CONSTRAINT usu_tipo_fk FOREIGN KEY (id_tipo) REFERENCES tipo_usuario (id_tipo);

CREATE TABLE sesion(
	id_sesion bigint unsigned primary key auto_increment not null,
    fecsesion timestamp default NOW(),
    id_usuario bigint unsigned not null,
    id_accion int not null
)ENGINE=INNODB;
ALTER TABLE sesion ADD CONSTRAINT sesion_usuario_fk FOREIGN KEY (id_usuario) REFERENCES usuario (id_usuario);
ALTER TABLE sesion ADD CONSTRAINT sesion_accion_fk FOREIGN KEY (id_accion) REFERENCES accion_sesion (id_accion);

-- TABLAS PARA PRODUCTOS
CREATE TABLE marca(
	id_marca int unsigned auto_increment primary key not null,
    marca_ varchar(100) unique not null  
)ENGINE=INNODB;

CREATE TABLE area(
	id_area int unsigned auto_increment primary key not null,
    area_ varchar(255) unique not null
)ENGINE=INNODB;

CREATE TABLE categoria(
	id_cat int unsigned auto_increment primary key not null,
    cat varchar(120) unique not null 
)ENGINE=INNODB;

CREATE TABLE subcategoria(
	id_sub int unsigned auto_increment primary key not null,
    subcat varchar(120) unique not null,
    id_cat int unsigned
)ENGINE=INNODB;
ALTER TABLE subcategoria ADD CONSTRAINT subcat_cat_fk FOREIGN KEY (id_cat) REFERENCES categoria (id_cat);

CREATE TABLE producto(
	id_prod bigint unsigned auto_increment primary key not null,
    cod varchar(255) unique not null, 
    feccreacion timestamp default NOW(),
    fecactual timestamp default NOW(),
    producto_ varchar(255) unique not null, 
    proddescrip TEXT, 
    foto varchar(255), 
    umedida varchar(40) not null,
    stock double, 
    valor double,
    desc_x_prod double,
    id_marca int unsigned, 
    id_sub int unsigned, 
    id_area int unsigned
)ENGINE=INNODB;
ALTER TABLE producto ADD CONSTRAINT prod_marca_fk FOREIGN KEY (id_marca) REFERENCES marca (id_marca);
ALTER TABLE producto ADD CONSTRAINT prod_sub_fk FOREIGN KEY (id_sub) REFERENCES subcategoria (id_sub);
ALTER TABLE producto ADD CONSTRAINT prod_area_fk FOREIGN KEY (id_area) REFERENCES area (id_area);

CREATE TABLE lote(
	id_lote bigint unsigned primary key auto_increment,
    lote_cod varchar(70) not null, 
    cantidad double not null,
    pesaje double,
    feceingreso timestamp default NOW() not null,
    fecproduccion date default null,
    vencimiento date default null,
    id_prod bigint unsigned not null
)ENGINE=INNODB;
ALTER TABLE lote ADD CONSTRAINT lote_prod_fk FOREIGN KEY (id_prod) REFERENCES producto (id_prod);

CREATE TABLE merma(
	id_merma int unsigned auto_increment primary key,
    fechaingreso datetime default NOW(),
    codprod varchar(255) not null,
    cantidad tinyint not null,
    descripcion tinytext,
    id_prod bigint unsigned
)engine=INNODB;
ALTER TABLE merma ADD CONSTRAINT merma_prod_fk FOREIGN KEY (id_prod) REFERENCES producto (id_prod);

CREATE TABLE comuna(
	id_comuna int unsigned auto_increment primary key not null, 
    comuna_ varchar(100) unique not null
)ENGINE=INNODB;

-- VENTA
CREATE TABLE sucursal(  
	id_sucursal int unsigned auto_increment primary key,
    sucursal_ varchar(120) not null, 
    direccion_sucursal varchar(255) not null, 
    id_comuna int unsigned not null
)ENGINE=INNODB;
ALTER TABLE sucursal ADD CONSTRAINT suc_com_fk FOREIGN KEY (id_comuna) REFERENCES comuna (id_comuna);

CREATE TABLE documento(
	id_doc int primary key, 
    doc varchar(40) not null
)ENGINE=INNODB;

CREATE TABLE medio_pago(
	id_pago int primary key,
    pago varchar(20) not null
)ENGINE=INNODB;

CREATE TABLE venta(
	id_venta bigint unsigned primary key auto_increment, 
    fecventa timestamp default NOW() not null,
    vendedor varchar(70),
    subtotal double, 
    descventa double, 
    total double,
    rutempresa varchar(14), 
    nomempresa varchar(255), 
    direcemp varchar(255),
    estado int default (1),
    id_comuna int unsigned default null,
    id_sucursal int unsigned default null,
    id_doc int not null,
    id_pago int not null
)ENGINE=INNODB;
ALTER TABLE venta ADD CONSTRAINT venta_com_fk FOREIGN KEY (id_comuna) REFERENCES comuna (id_comuna);
ALTER TABLE venta ADD CONSTRAINT venta_suc_fk FOREIGN KEY (id_sucursal) REFERENCES sucursal (id_sucursal);
ALTER TABLE venta ADD CONSTRAINT venta_doc_fk FOREIGN KEY (id_doc) REFERENCES documento (id_doc);
ALTER TABLE venta ADD CONSTRAINT venta_pago_fk FOREIGN KEY (id_pago) REFERENCES medio_pago (id_pago);

CREATE TABLE detalle_venta(
	id_detalle_venta bigint unsigned primary key auto_increment, 
    cantidad_prod double not null, 
    desc_detalle double, 
    total_detalle double not null,
    id_venta bigint unsigned not null, 
    id_prod bigint unsigned not null
)ENGINE=INNODB;
ALTER TABLE detalle_venta ADD CONSTRAINT detven_venta_fk FOREIGN KEY (id_venta) REFERENCES venta (id_venta);
ALTER TABLE detalle_venta ADD CONSTRAINT detven_prod_fk FOREIGN KEY (id_prod) REFERENCES producto (id_prod);

-- DESPACHO
CREATE TABLE cliente(
	id_cliente int unsigned auto_increment primary key,
    run varchar(12), 
    nomcliente varchar(70) not null, 
    fono varchar(18) not null, 
    direcliente varchar(255) not null, 
    id_comuna int unsigned
)ENGINE=INNODB;
ALTER TABLE cliente ADD CONSTRAINT cli_com_fk FOREIGN KEY (id_comuna) REFERENCES comuna (id_comuna);

CREATE TABLE despacho(
	id_despacho bigint unsigned auto_increment primary key, 
    fecdespacho timestamp default NOW() not null,
    fecmodificar timestamp,
    direc_desp varchar(255) not null,
    estado int default (1),
    observacion varchar(6000),
    id_comuna int unsigned not null,
    id_venta bigint unsigned not null, 
    id_cliente int unsigned not null
)ENGINE=INNODB;
ALTER TABLE despacho ADD CONSTRAINT desp_com_fk FOREIGN KEY (id_comuna) REFERENCES comuna (id_comuna);
ALTER TABLE despacho ADD CONSTRAINT desp_venta_fk FOREIGN KEY (id_venta) REFERENCES venta (id_venta);
ALTER TABLE despacho ADD CONSTRAINT desp_cli_fk FOREIGN KEY (id_cliente) REFERENCES cliente (id_cliente);

-- INSERTS BASES ------------------------------------------------------------------------------------------------------
INSERT INTO tipo_usuario VALUES(1,"ADMINISTRADOR"),(2,"VENDEDOR"),(3,"DESHABILITADO");
INSERT INTO accion_sesion VALUES(1,"ENTRADA"),(2,"SALIDA");
INSERT INTO documento VALUES(1,"BOLETA"),(2,"FACTURA");
INSERT INTO medio_pago VALUES(1,"EFECTIVO"),(2,"DEBITO"),(3,"CREDITO");
INSERT INTO usuario VALUES(1,'administrador','$2y$04$gOd0CSC1otjC3UuG.9VHE.dKD.hisTt2x5Dx7norFwWhIWrqtN5h6'); -- 1234
COMMIT;