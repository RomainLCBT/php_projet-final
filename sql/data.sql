-- Insérer des données dans la table Client
INSERT INTO Client (nom, prenom, telephone, adresse_mail, mot_de_passe)
VALUES 
('Doe', 'John', '0601234567', 'john.doe@example.com', 'password123'),
('Smith', 'Jane', '0612345678', 'jane.smith@example.com', 'secure456'),
('Brown', 'Alice', '0623456789', 'alice.brown@example.com', 'alice789');

-- Insérer des données dans la table Medecin
INSERT INTO Medecin (nom, prenom, code_postale, adresse_mail, mot_de_passe)
VALUES 
('Martin', 'Paul', 75001, 'paul.martin@medecin.com', 'paul123'),
('Durand', 'Claire', 69002, 'claire.durand@medecin.com', 'claire456'),
('Dubois', 'Marc', 33000, 'marc.dubois@medecin.com', 'marc789');

-- Insérer des données dans la table specialites
INSERT INTO specialites (nom)
VALUES 
('Cardio'),
('Ortho'),
('Neuro');

-- Insérer des données dans la table disponibilite
INSERT INTO disponibilite (is_dispo, debut_periode, fin_periode, debut_heure, fin_heure)
VALUES 
(TRUE, '2024-01-01', '2024-01-31', '09:00:00', '12:00:00'),
(TRUE, '2024-02-01', '2024-02-28', '13:00:00', '16:00:00'),
(FALSE, '2024-01-01', '2024-01-15', '08:00:00', '11:00:00');

-- Insérer des données dans la table Etablissement
INSERT INTO Etablissement (nom, adresse, Ville)
VALUES 
('Clinique A', '123 Rue Santé', 'Paris'),
('Clinique B', '456 Avenue Médicale', 'Lyon'),
('Clinique C', '789 Boulevard Bien-être', 'Bordeaux');

-- Insérer des données dans la table RendezVous
INSERT INTO RendezVous (date, heure, est_passe, duree, id_client, id_medecin, id_etablissement, id_dispo)
VALUES 
('2024-01-10 10:30:00', '10:30:00', FALSE, '00:30:00', 1, 1, 1, 1),
('2024-02-15 14:00:00', '14:00:00', FALSE, '01:00:00', 2, 2, 2, 2),
('2024-01-05 09:00:00', '09:00:00', TRUE, '00:45:00', 3, 3, 3, 3);

-- Insérer des données dans la table possede
INSERT INTO possede (id_spe, id_medecin)
VALUES 
(1, 1), -- Paul Martin est cardiologue
(2, 2), -- Claire Durand est orthopédiste
(3, 3); -- Marc Dubois est neurologue

-- Insérer des données dans la table travail_dans
INSERT INTO travail_dans (id_etablissement, id_medecin)
VALUES 
(1, 1), -- Paul Martin travaille à Clinique A
(2, 2), -- Claire Durand travaille à Clinique B
(3, 3); -- Marc Dubois travaille à Clinique C

-- Insérer des données dans la table requiert
INSERT INTO requiert (id_dispo, id_medecin)
VALUES 
(1, 1), -- Disponibilité 1 pour Paul Martin
(2, 2), -- Disponibilité 2 pour Claire Durand
(3, 3); -- Disponibilité 3 pour Marc Dubois

-- Insérer des données dans la table relie
INSERT INTO relie (id_etablissement, id_dispo)
VALUES 
(1, 1), -- Disponibilité 1 reliée à Clinique A
(2, 2), -- Disponibilité 2 reliée à Clinique B
(3, 3); -- Disponibilité 3 reliée à Clinique C
