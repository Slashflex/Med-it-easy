#------------------------------------------------------------
#        Script MySQL.
#------------------------------------------------------------


#------------------------------------------------------------
# Table: typeActe
#------------------------------------------------------------

CREATE TABLE typeActe(
        id_type           Int  Auto_increment  NOT NULL ,
        description       Varchar (60) NOT NULL ,
        dureeConsultation Time NOT NULL ,
        couleur           Varchar (60) NOT NULL
	,CONSTRAINT typeActe_PK PRIMARY KEY (id_type)
)ENGINE=InnoDB;


#------------------------------------------------------------
# Table: specialite
#------------------------------------------------------------

CREATE TABLE specialite(
        id_spe      Int  Auto_increment  NOT NULL ,
        description Varchar (50) NOT NULL
	,CONSTRAINT specialite_PK PRIMARY KEY (id_spe)
)ENGINE=InnoDB;


#------------------------------------------------------------
# Table: praticien
#------------------------------------------------------------

CREATE TABLE praticien(
        id_praticien       Int  Auto_increment  NOT NULL ,
        praticienPrenom    Varchar (60) NOT NULL ,
        praticienNom       Varchar (60) NOT NULL ,
        praticienDate      Date NOT NULL ,
        praticienEmail     Varchar (255) NOT NULL ,
        password_1         Varchar (255) NOT NULL ,
        confirmation_token Varchar (255) NOT NULL ,
        confirmed          Varchar (255) NOT NULL ,
        id_spe             Int NOT NULL
	,CONSTRAINT praticien_PK PRIMARY KEY (id_praticien)

	,CONSTRAINT praticien_specialite_FK FOREIGN KEY (id_spe) REFERENCES specialite(id_spe)
)ENGINE=InnoDB;


#------------------------------------------------------------
# Table: patient
#------------------------------------------------------------

CREATE TABLE patient(
        id_patient         Int  Auto_increment  NOT NULL ,
        patientPrenom      Varchar (60) NOT NULL ,
        patientNom         Varchar (60) NOT NULL ,
        patientDate        Date NOT NULL ,
        email              Varchar (255) NOT NULL ,
        password_1         Varchar (255) NOT NULL ,
        confirmation_token Varchar (255) NOT NULL ,
        confirmed          Varchar (255) NOT NULL ,
        id_praticien       Int NOT NULL
	,CONSTRAINT patient_PK PRIMARY KEY (id_patient)

	,CONSTRAINT patient_praticien_FK FOREIGN KEY (id_praticien) REFERENCES praticien(id_praticien)
)ENGINE=InnoDB;


#------------------------------------------------------------
# Table: events
#------------------------------------------------------------

CREATE TABLE events(
        id_event   Int  Auto_increment  NOT NULL ,
        start      Datetime NOT NULL ,
        id_type    Int NOT NULL ,
        id_patient Int NOT NULL
	,CONSTRAINT events_PK PRIMARY KEY (id_event)

	,CONSTRAINT events_typeActe_FK FOREIGN KEY (id_type) REFERENCES typeActe(id_type)
	,CONSTRAINT events_patient0_FK FOREIGN KEY (id_patient) REFERENCES patient(id_patient)
)ENGINE=InnoDB;

