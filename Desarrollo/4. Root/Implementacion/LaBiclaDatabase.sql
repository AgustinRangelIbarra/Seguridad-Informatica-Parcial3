DROP DATABASE IF EXISTS la_bicla_db;
CREATE DATABASE la_bicla_db;
USE la_bicla_db;

-- Drop Tables

DROP TABLE IF EXISTS users; 
   
CREATE TABLE users (
                            
	email VARCHAR(100) NOT NULL PRIMARY KEY,
                                            
	password VARCHAR(100) NOT NULL,

	firstname VARCHAR(100) NOT NULL,

	lastname VARCHAR(100) NOT NULL, 

	days_of_password_validity INTEGER NOT NULL, -- En dias

	date_of_last_password_update TIMESTAMP NOT NULL,
	
	is_temporal_password BOOLEAN NOT NULL,
	
	activation_key VARCHAR(50),
	
	status VARCHAR(30) NOT NULL,
	
	p1 VARCHAR(30) NOT NULL,
	
	P2 VARCHAR(30) NOT NULL,
	
	P3 VARCHAR(30) NOT NULL
	
);

DROP TABLE IF EXISTS products;

CREATE TABLE products (
	
	id INTEGER NOT NULL PRIMARY KEY,
	name VARCHAR(100) NOT NULL,
	description VARCHAR(250) NOT NULL,
	brand VARCHAR(100) NOT NULL,
	price DECIMAL(7,2) NOT NULL,
	quantity INTEGER NOT NULL,
	image VARCHAR(200) NOT NULL
);

DROP TABLE IF EXISTS blog_entries;

CREATE TABLE blog_entries (
	
	id INTEGER NOT NULL AUTO_INCREMENT PRIMARY KEY,
	user_email VARCHAR(100) NOT NULL,
	entry_value VARCHAR(2000) NOT NULL,
	registration_date TIMESTAMP NOT NULL,
	
	INDEX user_email_index (user_email),
    FOREIGN KEY (user_email)
        REFERENCES users(email)
        ON DELETE CASCADE
);


INSERT INTO users VALUES ("admin@novalidserver.net", "passw0rd", "Admin", "", 30, now(), false, NULL, "ACTIVE","keisha","juana","Chihuahua");
INSERT INTO users VALUES ("guillermart@gmail.com", "passw0rd", "Guillermo", "Martinez", 30, now(), false, NULL, "ACTIVE","firulais","to�ita","CDMX");
INSERT INTO users VALUES ("guillermart@hotmail.com", "passw0rd", "Guillermo", "Martinez", 30, now(), false, NULL, "BLOCKED","keisha","juana","Chihuahua");
INSERT INTO users VALUES ("maryjane.watson@dccomics.com", "passw0rd", "Mary Jane", "Watson", 30, now(), false, NULL, "CANCELLED","keisha","juana","Chihuahua");
INSERT INTO users VALUES ("john.snow@got.com", "passw0rd", "John", "Snow", 30, now(), false, NULL, "ACTIVE","keisha","juana","Chihuahua");

-- insert into usuarios values ("admin@novalidserver.net", "passw0rd", "Admin", "", "ADMIN", "ACTIVO", null, false, 0, curdate());
-- insert into usuarios values ("guillermart@gmail.com", "passw0rd", "Guillermo", "Martinez" ,"SOCIO", "ACTIVO", null, false, 0, curdate());

INSERT INTO products VALUES( 1, "Diablos Infernales", "Diablos para carga...", "Benotto",50.00, 25,"<img src=""images/diablos_infernales.jpg"">" );
INSERT INTO products VALUES( 2, "Asiento", "Asiento para bicicleta deportiva...", "Benotto",300.00, 12,"<img src=""images/asiento_deportiva.jpg"">" );
INSERT INTO products VALUES( 3, "Luces", "Luces de neon parpadenates", "Phillips",150.00, 50,"<img src=""images/luces_neon.jpg"">" );
INSERT INTO products VALUES( 4, "Llanta", "Llanta bicicleta montaña rodada 20", "Tornel",200.00, 2, "<img src=""images/llanta_20.jpg"">");
INSERT INTO products VALUES( 5, "Llanta", "Llanta bicicleta montaña rodada 28", "Tornel",230.00, 4,"<img src=""images/llanta_28.jpg"">" );
INSERT INTO products VALUES( 6, "Rin", "Rin cromado para bicileta rodada 26", "Patita",140.00, 1,"<img src=""images/rin_cromado.jpg"">" );
INSERT INTO products VALUES( 7, "Cadena", "Cadena de medio eslabon", "Shimano",500.00, 5,"<img src=""images/cadena.jpg"">" );



INSERT INTO blog_entries (user_email, entry_value, registration_date) VALUES ("guillermart@hotmail.com", "Alguien sabe como se llaman los tubitos que se ponen en la llanta de atras y sirven para cargar a otra persona?", now());
INSERT INTO blog_entries (user_email, entry_value, registration_date) VALUES ("maryjane.watson@dccomics.com", "Necesito una bicicleta rosa con canastita vintage, ideas?", now());
INSERT INTO blog_entries (user_email, entry_value, registration_date) VALUES ("john.snow@got.com", "Alguna bici para lugares frios?", now());
  