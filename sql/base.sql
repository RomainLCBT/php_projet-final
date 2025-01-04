-- Table: client
CREATE TABLE client (
    id_client SERIAL PRIMARY KEY,
    nom VARCHAR(50) NOT NULL,
    prenom VARCHAR(50) NOT NULL,
    telephone VARCHAR(10) NOT NULL,
    adresse_mail VARCHAR(50) NOT NULL,
    mot_de_passe VARCHAR(50) NOT NULL
);

-- Table: medecin
CREATE TABLE medecin (
    id_medecin SERIAL PRIMARY KEY,
    nom VARCHAR(50) NOT NULL,
    prenom VARCHAR(50) NOT NULL,
    code_postale INT NOT NULL,
    adresse_mail VARCHAR(50) NOT NULL,
    mot_de_passe VARCHAR(50) NOT NULL
);

-- Table: specialites
CREATE TABLE specialites (
    id_spe SERIAL PRIMARY KEY,
    nom VARCHAR(50) NOT NULL
);

-- Table: disponibilite
CREATE TABLE disponibilite (
    id_dispo SERIAL PRIMARY KEY,
    is_dispo BOOLEAN NOT NULL,
    debut_periode DATE NOT NULL,
    fin_periode DATE NOT NULL,
    debut_heure TIME NOT NULL,
    fin_heure TIME NOT NULL
);

-- Table: etablissement
CREATE TABLE etablissement (
    id_etablissement SERIAL PRIMARY KEY,
    nom VARCHAR(50) NOT NULL,
    adresse VARCHAR(50) NOT NULL,
    ville VARCHAR(50) NOT NULL
);

-- Table: rendezvous
CREATE TABLE rendezvous (
    id_rendez_vous SERIAL PRIMARY KEY,
    date TIMESTAMP NOT NULL,
    heure TIME NOT NULL,
    est_passe BOOLEAN NOT NULL,
    duree TIME NOT NULL,
    id_client INT NOT NULL,
    id_medecin INT NOT NULL,
    id_etablissement INT NOT NULL,
    id_dispo INT NOT NULL,
    CONSTRAINT fk_client FOREIGN KEY (id_client) REFERENCES client (id_client),
    CONSTRAINT fk_medecin FOREIGN KEY (id_medecin) REFERENCES medecin (id_medecin),
    CONSTRAINT fk_etablissement FOREIGN KEY (id_etablissement) REFERENCES etablissement (id_etablissement),
    CONSTRAINT fk_disponibilite FOREIGN KEY (id_dispo) REFERENCES disponibilite (id_dispo)
);

-- Table: possede
CREATE TABLE possede (
    id_spe INT NOT NULL,
    id_medecin INT NOT NULL,
    PRIMARY KEY (id_spe, id_medecin),
    CONSTRAINT fk_possede_spe FOREIGN KEY (id_spe) REFERENCES specialites (id_spe),
    CONSTRAINT fk_possede_medecin FOREIGN KEY (id_medecin) REFERENCES medecin (id_medecin)
);

-- Table: travail_dans
CREATE TABLE travail_dans (
    id_etablissement INT NOT NULL,
    id_medecin INT NOT NULL,
    PRIMARY KEY (id_etablissement, id_medecin),
    CONSTRAINT fk_travail_etablissement FOREIGN KEY (id_etablissement) REFERENCES etablissement (id_etablissement),
    CONSTRAINT fk_travail_medecin FOREIGN KEY (id_medecin) REFERENCES medecin (id_medecin)
);

-- Table: requiert
CREATE TABLE requiert (
    id_dispo INT NOT NULL,
    id_medecin INT NOT NULL,
    PRIMARY KEY (id_dispo, id_medecin),
    CONSTRAINT fk_requiert_dispo FOREIGN KEY (id_dispo) REFERENCES disponibilite (id_dispo),
    CONSTRAINT fk_requiert_medecin FOREIGN KEY (id_medecin) REFERENCES medecin (id_medecin)
);

-- Table: relie
CREATE TABLE relie (
    id_etablissement INT NOT NULL,
    id_dispo INT NOT NULL,
    PRIMARY KEY (id_etablissement, id_dispo),
    CONSTRAINT fk_relie_etablissement FOREIGN KEY (id_etablissement) REFERENCES etablissement (id_etablissement),
    CONSTRAINT fk_relie_dispo FOREIGN KEY (id_dispo) REFERENCES disponibilite (id_dispo)
);
