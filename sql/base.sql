#------------------------------------------------------------
# Table: Client
#------------------------------------------------------------

CREATE TABLE Client(
        id_client    Int  Auto_increment  NOT NULL ,
        nom          Varchar (50) NOT NULL ,
        prenom       Varchar (50) NOT NULL ,
        telephone    Varchar (10) NOT NULL ,
        adresse_mail Varchar (50) NOT NULL ,
        mot_de_passe Varchar (50) NOT NULL
	,CONSTRAINT Client_PK PRIMARY KEY (id_client)
)ENGINE=InnoDB;


#------------------------------------------------------------
# Table: Médecin
#------------------------------------------------------------

CREATE TABLE Medecin(
        id_medecin   Int  Auto_increment  NOT NULL ,
        nom          Varchar (50) NOT NULL ,
        prenom       Varchar (50) NOT NULL ,
        code_postale Int NOT NULL ,
        adresse_mail Varchar (50) NOT NULL ,
        mot_de_passe Varchar (50) NOT NULL
	,CONSTRAINT Medecin_PK PRIMARY KEY (id_medecin)
)ENGINE=InnoDB;


#------------------------------------------------------------
# Table: spécialités
#------------------------------------------------------------

CREATE TABLE specialites(
        id_spe Int  Auto_increment  NOT NULL ,
        nom    Varchar (50) NOT NULL
	,CONSTRAINT specialites_PK PRIMARY KEY (id_spe)
)ENGINE=InnoDB;


#------------------------------------------------------------
# Table: disponibilité
#------------------------------------------------------------

CREATE TABLE disponibilite(
        id_dispo      Int  Auto_increment  NOT NULL ,
        is_dispo      Bool NOT NULL ,
        debut_periode Date NOT NULL ,
        fin_periode   Date NOT NULL ,
        fin_heure     Time NOT NULL ,
        debut_heure   Time NOT NULL
	,CONSTRAINT disponibilite_PK PRIMARY KEY (id_dispo)
)ENGINE=InnoDB;


#------------------------------------------------------------
# Table: Etablissement
#------------------------------------------------------------

CREATE TABLE Etablissement(
        id_etablissement Int  Auto_increment  NOT NULL ,
        nom              Varchar (50) NOT NULL ,
        adresse          Varchar (50) NOT NULL ,
        Ville            Varchar (50) NOT NULL
	,CONSTRAINT Etablissement_PK PRIMARY KEY (id_etablissement)
)ENGINE=InnoDB;


#------------------------------------------------------------
# Table: RendezVous
#------------------------------------------------------------

CREATE TABLE RendezVous(
        Id_rendez_vous   Int  Auto_increment  NOT NULL ,
        date             Datetime NOT NULL ,
        heure            Time NOT NULL ,
        est_passe        Bool NOT NULL ,
        duree            Time NOT NULL ,
        id_client        Int NOT NULL ,
        id_medecin       Int NOT NULL ,
        id_etablissement Int NOT NULL ,
        id_dispo         Int NOT NULL
	,CONSTRAINT RendezVous_PK PRIMARY KEY (Id_rendez_vous)

	,CONSTRAINT RendezVous_Client_FK FOREIGN KEY (id_client) REFERENCES Client(id_client)
	,CONSTRAINT RendezVous_Medecin0_FK FOREIGN KEY (id_medecin) REFERENCES Medecin(id_medecin)
	,CONSTRAINT RendezVous_Etablissement1_FK FOREIGN KEY (id_etablissement) REFERENCES Etablissement(id_etablissement)
	,CONSTRAINT RendezVous_disponibilite2_FK FOREIGN KEY (id_dispo) REFERENCES disponibilite(id_dispo)
)ENGINE=InnoDB;


#------------------------------------------------------------
# Table: possède
#------------------------------------------------------------

CREATE TABLE possede(
        id_spe     Int NOT NULL ,
        id_medecin Int NOT NULL
	,CONSTRAINT possede_PK PRIMARY KEY (id_spe,id_medecin)

	,CONSTRAINT possede_specialites_FK FOREIGN KEY (id_spe) REFERENCES specialites(id_spe)
	,CONSTRAINT possede_Medecin0_FK FOREIGN KEY (id_medecin) REFERENCES Medecin(id_medecin)
)ENGINE=InnoDB;


#------------------------------------------------------------
# Table: travail dans
#------------------------------------------------------------

CREATE TABLE travail_dans(
        id_etablissement Int NOT NULL ,
        id_medecin       Int NOT NULL
	,CONSTRAINT travail_dans_PK PRIMARY KEY (id_etablissement,id_medecin)

	,CONSTRAINT travail_dans_Etablissement_FK FOREIGN KEY (id_etablissement) REFERENCES Etablissement(id_etablissement)
	,CONSTRAINT travail_dans_Medecin0_FK FOREIGN KEY (id_medecin) REFERENCES Medecin(id_medecin)
)ENGINE=InnoDB;


#------------------------------------------------------------
# Table: requiert
#------------------------------------------------------------

CREATE TABLE requiert(
        id_dispo   Int NOT NULL ,
        id_medecin Int NOT NULL
	,CONSTRAINT requiert_PK PRIMARY KEY (id_dispo,id_medecin)

	,CONSTRAINT requiert_disponibilite_FK FOREIGN KEY (id_dispo) REFERENCES disponibilite(id_dispo)
	,CONSTRAINT requiert_Medecin0_FK FOREIGN KEY (id_medecin) REFERENCES Medecin(id_medecin)
)ENGINE=InnoDB;


#------------------------------------------------------------
# Table: relié
#------------------------------------------------------------

CREATE TABLE relie(
        id_etablissement Int NOT NULL ,
        id_dispo         Int NOT NULL
	,CONSTRAINT relie_PK PRIMARY KEY (id_etablissement,id_dispo)

	,CONSTRAINT relie_Etablissement_FK FOREIGN KEY (id_etablissement) REFERENCES Etablissement(id_etablissement)
	,CONSTRAINT relie_disponibilite0_FK FOREIGN KEY (id_dispo) REFERENCES disponibilite(id_dispo)
)ENGINE=InnoDB;

