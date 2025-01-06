-- Insérer des données dans la table Client
INSERT INTO Client (nom, prenom, telephone, adresse_mail, mot_de_passe)
VALUES
('Doe', 'John', '0601234567', 'john.doe@example.com', 'password123'),
('Smith', 'Jane', '0612345678', 'jane.smith@example.com', 'secure456'),
('Brown', 'Alice', '0623456789', 'alice.brown@example.com', 'alice789'),
('Johnson', 'Bob', '0634567890', 'bob.johnson@example.com', 'bob123'),
('Williams', 'Emma', '0645678901', 'emma.williams@example.com', 'emma456'),
('Jones', 'Michael', '0656789012', 'michael.jones@example.com', 'michael789'),
('Miller', 'Sophia', '0667890123', 'sophia.miller@example.com', 'sophia123'),
('Davis', 'James', '0678901234', 'james.davis@example.com', 'james456'),
('Garcia', 'Olivia', '0689012345', 'olivia.garcia@example.com', 'olivia789'),
('Rodriguez', 'Benjamin', '0690123456', 'benjamin.rodriguez@example.com', 'benjamin123'),
('Martinez', 'Mia', '0601234568', 'mia.martinez@example.com', 'mia456'),
('Hernandez', 'Ethan', '0612345679', 'ethan.hernandez@example.com', 'ethan789'),
('Lopez', 'Ava', '0623456790', 'ava.lopez@example.com', 'ava123'),
('Gonzalez', 'Alexander', '0634567891', 'alexander.gonzalez@example.com', 'alexander456'),
('Wilson', 'Charlotte', '0645678902', 'charlotte.wilson@example.com', 'charlotte789'),
('Anderson', 'Daniel', '0656789013', 'daniel.anderson@example.com', 'daniel123'),
('Thomas', 'Grace', '0667890124', 'grace.thomas@example.com', 'grace456'),
('Taylor', 'Matthew', '0678901235', 'matthew.taylor@example.com', 'matthew789'),
('Moore', 'Harper', '0689012346', 'harper.moore@example.com', 'harper123'),
('Jackson', 'Liam', '0690123457', 'liam.jackson@example.com', 'liam456'),
('Martin', 'Ella', '0601234569', 'ella.martin@example.com', 'ella789'),
('Lee', 'Lucas', '0612345680', 'lucas.lee@example.com', 'lucas123'),
('Perez', 'Aria', '0623456791', 'aria.perez@example.com', 'aria456'),
('Thompson', 'Henry', '0634567892', 'henry.thompson@example.com', 'henry789'),
('White', 'Scarlett', '0645678903', 'scarlett.white@example.com', 'scarlett123');

-- Insérer des données dans la table Medecin
INSERT INTO Medecin (nom, prenom, code_postale, adresse_mail, mot_de_passe)
VALUES
('Martin', 'Paul', 75001, 'paul.martin@medecin.com', 'paul123'),
('Durand', 'Claire', 69002, 'claire.durand@medecin.com', 'claire456'),
('Dubois', 'Marc', 33000, 'marc.dubois@medecin.com', 'marc789'),
('Lefevre', 'Sophie', 13000, 'sophie.lefevre@medecin.com', 'sophie123'),
('Moreau', 'Jean', 44000, 'jean.moreau@medecin.com', 'jean456'),
('Fournier', 'Marie', 59000, 'marie.fournier@medecin.com', 'marie789'),
('Girard', 'Pierre', 67000, 'pierre.girard@medecin.com', 'pierre123'),
('Dupont', 'Anne', 76000, 'anne.dupont@medecin.com', 'anne456'),
('Lambert', 'Julien', 29000, 'julien.lambert@medecin.com', 'julien789'),
('Rousseau', 'Catherine', 31000, 'catherine.rousseau@medecin.com', 'catherine123'),
('Vidal', 'Philippe', 34000, 'philippe.vidal@medecin.com', 'philippe456'),
('Gauthier', 'Isabelle', 38000, 'isabelle.gauthier@medecin.com', 'isabelle789'),
('Chevalier', 'Nicolas', 42000, 'nicolas.chevalier@medecin.com', 'nicolas123'),
('Fontaine', 'Caroline', 45000, 'caroline.fontaine@medecin.com', 'caroline456'),
('Morin', 'Sebastien', 51000, 'sebastien.morin@medecin.com', 'sebastien789'),
('Blanc', 'Valerie', 54000, 'valerie.blanc@medecin.com', 'valerie123'),
('Leclerc', 'Patrick', 57000, 'patrick.leclerc@medecin.com', 'patrick456'),
('Roux', 'Sandra', 59000, 'sandra.roux@medecin.com', 'sandra789'),
('Leroy', 'Thomas', 62000, 'thomas.leroy@medecin.com', 'thomas123'),
('Brun', 'Nathalie', 63000, 'nathalie.brun@medecin.com', 'nathalie456'),
('Meunier', 'Christophe', 67000, 'christophe.meunier@medecin.com', 'christophe789'),
('Garnier', 'Sylvie', 69000, 'sylvie.garnier@medecin.com', 'sylvie123'),
('Faure', 'Laurent', 75000, 'laurent.faure@medecin.com', 'laurent456'),
('Roussel', 'Brigitte', 76000, 'brigitte.roussel@medecin.com', 'brigitte789'),
('Blanchard', 'Eric', 77000, 'eric.blanchard@medecin.com', 'eric123');

-- Insérer des données dans la table specialites
INSERT INTO specialites (nom)
VALUES
('Cardiologie'),
('Orthopédie'),
('Neurologie'),
('Dermatologie'),
('Pédiatrie'),
('Gynécologie'),
('Ophtalmologie'),
('Urologie'),
('Gastro-entérologie'),
('Psychiatrie');

-- Insérer des données dans la table disponibilite
INSERT INTO disponibilite (is_dispo, debut_periode, fin_periode, debut_heure, fin_heure)
VALUES
(TRUE, '2025-01-01', '2025-01-31', '09:00:00', '12:00:00'),
(TRUE, '2025-02-01', '2025-02-28', '13:00:00', '16:00:00'),
(TRUE, '2025-03-01', '2025-03-31', '08:00:00', '11:00:00'),
(TRUE, '2025-04-01', '2025-04-30', '14:00:00', '17:00:00'),
(TRUE, '2025-05-01', '2025-05-31', '10:00:00', '13:00:00'),
(TRUE, '2025-06-01', '2025-06-30', '15:00:00', '18:00:00'),
(TRUE, '2025-07-01', '2025-07-31', '09:00:00', '12:00:00'),
(TRUE, '2025-08-01', '2025-08-31', '13:00:00', '16:00:00'),
(TRUE, '2025-09-01', '2025-09-30', '08:00:00', '11:00:00'),
(TRUE, '2025-10-01', '2025-10-31', '14:00:00', '17:00:00'),
(TRUE, '2025-11-01', '2025-11-30', '10:00:00', '13:00:00'),
(TRUE, '2025-12-01', '2025-12-31', '15:00:00', '18:00:00');

-- Insérer des données dans la table Etablissement
INSERT INTO Etablissement (nom, adresse, Ville)
VALUES
('Clinique A', '123 Rue Santé', 'Paris'),
('Clinique B', '456 Avenue Médicale', 'Lyon'),
('Clinique C', '789 Boulevard Bien-être', 'Bordeaux'),
('Hôpital D', '101 Rue de la Santé', 'Marseille'),
('Clinique E', '202 Avenue de la Médecine', 'Lille'),
('Hôpital F', '303 Boulevard de la Santé', 'Nantes'),
('Clinique G', '404 Rue de la Médecine', 'Strasbourg'),
('Hôpital H', '505 Avenue de la Santé', 'Montpellier'),
('Clinique I', '606 Boulevard de la Médecine', 'Rennes'),
('Hôpital J', '707 Rue de la Santé', 'Toulouse');

-- Insérer des données dans la table RendezVous
INSERT INTO RendezVous (date, heure, est_passe, duree, id_client, id_medecin, id_etablissement, id_dispo)
VALUES
('2025-01-10 10:30:00', '10:30:00', FALSE, '01:00:00', 1, 1, 1, 1),
('2025-02-15 14:00:00', '14:00:00', FALSE, '01:30:00', 2, 2, 2, 2),
('2025-03-20 09:00:00', '09:00:00', FALSE, '01:00:00', 3, 3, 3, 3),
('2025-04-25 15:00:00', '15:00:00', FALSE, '01:30:00', 4, 4, 4, 4),
('2025-05-30 11:00:00', '11:00:00', FALSE, '01:00:00', 5, 5, 5, 5),
('2025-06-05 16:00:00', '16:00:00', FALSE, '01:30:00', 6, 6, 6, 6),
('2025-07-10 10:30:00', '10:30:00', FALSE, '01:00:00', 7, 7, 7, 7),
('2025-08-15 14:00:00', '14:00:00', FALSE, '01:30:00', 8, 8, 8, 8),
('2025-09-20 09:00:00', '09:00:00', FALSE, '01:00:00', 9, 9, 9, 9),
('2025-10-25 15:00:00', '15:00:00', FALSE, '01:30:00', 10, 10, 10, 10),
('2025-11-30 11:00:00', '11:00:00', FALSE, '01:00:00', 11, 11, 1, 11),
('2025-12-05 16:00:00', '16:00:00', FALSE, '01:30:00', 12, 12, 2, 12),
('2025-01-15 10:30:00', '10:30:00', FALSE, '01:00:00', 13, 13, 3, 1),
('2025-02-20 14:00:00', '14:00:00', FALSE, '01:30:00', 14, 14, 4, 2),
('2025-03-25 09:00:00', '09:00:00', FALSE, '01:00:00', 15, 15, 5, 3),
('2025-04-30 15:00:00', '15:00:00', FALSE, '01:30:00', 16, 16, 6, 4),
('2025-05-05 11:00:00', '11:00:00', FALSE, '01:00:00', 17, 17, 7, 5),
('2025-06-10 16:00:00', '16:00:00', FALSE, '01:30:00', 18, 18, 8, 6),
('2025-07-15 10:30:00', '10:30:00', FALSE, '01:00:00', 19, 19, 9, 7),
('2025-08-20 14:00:00', '14:00:00', FALSE, '01:30:00', 20, 20, 10, 8),
('2025-09-25 09:00:00', '09:00:00', FALSE, '01:00:00', 21, 21, 1, 9),
('2025-10-30 15:00:00', '15:00:00', FALSE, '01:30:00', 22, 22, 2, 10),
('2025-11-05 11:00:00', '11:00:00', FALSE, '01:00:00', 23, 23, 3, 11),
('2025-12-10 16:00:00', '16:00:00', FALSE, '01:30:00', 24, 24, 4, 12),
('2025-01-20 10:30:00', '10:30:00', FALSE, '01:00:00', 25, 25, 5, 1),
('2025-02-25 14:00:00', '14:00:00', FALSE, '01:30:00', 1, 1, 6, 2),
('2025-03-30 09:00:00', '09:00:00', FALSE, '01:00:00', 2, 2, 7, 3),
('2025-04-05 15:00:00', '15:00:00', FALSE, '01:30:00', 3, 3, 8, 4),
('2025-05-10 11:00:00', '11:00:00', FALSE, '01:00:00', 4, 4, 9, 5),
('2025-06-15 16:00:00', '16:00:00', FALSE, '01:30:00', 5, 5, 10, 6),
('2025-07-20 10:30:00', '10:30:00', FALSE, '01:00:00', 6, 6, 1, 7),
('2025-08-25 14:00:00', '14:00:00', FALSE, '01:30:00', 7, 7, 2, 8),
('2025-09-30 09:00:00', '09:00:00', FALSE, '01:00:00', 8, 8, 3, 9),
('2025-10-05 15:00:00', '15:00:00', FALSE, '01:30:00', 9, 9, 4, 10),
('2025-11-10 11:00:00', '11:00:00', FALSE, '01:00:00', 10, 10, 5, 11),
('2025-12-15 16:00:00', '16:00:00', FALSE, '01:30:00', 11, 11, 6, 12),
('2025-01-25 10:30:00', '10:30:00', FALSE, '01:00:00', 12, 12, 7, 1),
('2025-02-28 14:00:00', '14:00:00', FALSE, '01:30:00', 13, 13, 8, 2),
('2025-03-05 09:00:00', '09:00:00', FALSE, '01:00:00', 14, 14, 9, 3),
('2025-04-10 15:00:00', '15:00:00', FALSE, '01:30:00', 15, 15, 10, 4),
('2025-05-15 11:00:00', '11:00:00', FALSE, '01:00:00', 16, 16, 1, 5),
('2025-06-20 16:00:00', '16:00:00', FALSE, '01:30:00', 17, 17, 2, 6),
('2025-07-25 10:30:00', '10:30:00', FALSE, '01:00:00', 18, 18, 3, 7),
('2025-08-30 14:00:00', '14:00:00', FALSE, '01:30:00', 19, 19, 4, 8),
('2025-09-05 09:00:00', '09:00:00', FALSE, '01:00:00', 20, 20, 5, 9),
('2025-10-10 15:00:00', '15:00:00', FALSE, '01:30:00', 21, 21, 6, 10),
('2025-11-15 11:00:00', '11:00:00', FALSE, '01:00:00', 22, 22, 7, 11),
('2025-12-20 16:00:00', '16:00:00', FALSE, '01:30:00', 23, 23, 8, 12),
('2025-01-30 10:30:00', '10:30:00', FALSE, '01:00:00', 24, 24, 9, 1),
('2025-02-05 14:00:00', '14:00:00', FALSE, '01:30:00', 25, 25, 10, 2),
('2025-03-10 09:00:00', '09:00:00', FALSE, '01:00:00', 1, 1, 1, 3),
('2025-04-15 15:00:00', '15:00:00', FALSE, '01:30:00', 2, 2, 2, 4),
('2025-05-20 11:00:00', '11:00:00', FALSE, '01:00:00', 3, 3, 3, 5),
('2025-06-25 16:00:00', '16:00:00', FALSE, '01:30:00', 4, 4, 4, 6),
('2025-07-30 10:30:00', '10:30:00', FALSE, '01:00:00', 5, 5, 5, 7),
('2025-08-05 14:00:00', '14:00:00', FALSE, '01:30:00', 6, 6, 6, 8),
('2025-09-10 09:00:00', '09:00:00', FALSE, '01:00:00', 7, 7, 7, 9),
('2025-10-15 15:00:00', '15:00:00', FALSE, '01:30:00', 8, 8, 8, 10),
('2025-11-20 11:00:00', '11:00:00', FALSE, '01:00:00', 9, 9, 9, 11),
('2025-12-25 16:00:00', '16:00:00', FALSE, '01:30:00', 10, 10, 10, 12),
('2025-01-05 10:30:00', '10:30:00', FALSE, '01:00:00', 11, 11, 1, 1),
('2025-02-10 14:00:00', '14:00:00', FALSE, '01:30:00', 12, 12, 2, 2),
('2025-03-15 09:00:00', '09:00:00', FALSE, '01:00:00', 13, 13, 3, 3),
('2025-04-20 15:00:00', '15:00:00', FALSE, '01:30:00', 14, 14, 4, 4),
('2025-05-25 11:00:00', '11:00:00', FALSE, '01:00:00', 15, 15, 5, 5),
('2025-06-30 16:00:00', '16:00:00', FALSE, '01:30:00', 16, 16, 6, 6),
('2025-07-05 10:30:00', '10:30:00', FALSE, '01:00:00', 17, 17, 7, 7),
('2025-08-10 14:00:00', '14:00:00', FALSE, '01:30:00', 18, 18, 8, 8),
('2025-09-15 09:00:00', '09:00:00', FALSE, '01:00:00', 19, 19, 9, 9),
('2025-10-20 15:00:00', '15:00:00', FALSE, '01:30:00', 20, 20, 10, 10),
('2025-11-25 11:00:00', '11:00:00', FALSE, '01:00:00', 21, 21, 1, 11),
('2025-12-30 16:00:00', '16:00:00', FALSE, '01:30:00', 22, 22, 2, 12),
('2025-01-10 10:30:00', '10:30:00', FALSE, '01:00:00', 23, 23, 3, 1),
('2025-02-15 14:00:00', '14:00:00', FALSE, '01:30:00', 24, 24, 4, 2),
('2025-03-20 09:00:00', '09:00:00', FALSE, '01:00:00', 25, 25, 5, 3);

-- Insérer des données dans la table possede
INSERT INTO possede (id_spe, id_medecin)
VALUES
(1, 1), -- Paul Martin est cardiologue
(2, 2), -- Claire Durand est orthopédiste
(3, 3), -- Marc Dubois est neurologue
(4, 4), -- Sophie Lefevre est dermatologue
(5, 5), -- Jean Moreau est pédiatre
(6, 6), -- Marie Fournier est gynécologue
(7, 7), -- Pierre Girard est ophtalmologue
(8, 8), -- Anne Dupont est urologue
(9, 9), -- Julien Lambert est gastro-entérologue
(10, 10), -- Catherine Rousseau est psychiatre
(1, 11), -- Philippe Vidal est cardiologue
(2, 12), -- Isabelle Gauthier est orthopédiste
(3, 13), -- Nicolas Chevalier est neurologue
(4, 14), -- Caroline Fontaine est dermatologue
(5, 15), -- Sebastien Morin est pédiatre
(6, 16), -- Valerie Blanc est gynécologue
(7, 17), -- Patrick Leclerc est ophtalmologue
(8, 18), -- Sandra Roux est urologue
(9, 19), -- Thomas Leroy est gastro-entérologue
(10, 20), -- Nathalie Brun est psychiatre
(1, 21), -- Christophe Meunier est cardiologue
(2, 22), -- Sylvie Garnier est orthopédiste
(3, 23), -- Laurent Faure est neurologue
(4, 24), -- Brigitte Roussel est dermatologue
(5, 25); -- Eric Blanchard est pédiatre

-- Insérer des données dans la table travail_dans
INSERT INTO travail_dans (id_etablissement, id_medecin)
VALUES
(1, 1), -- Paul Martin travaille à Clinique A
(2, 2), -- Claire Durand travaille à Clinique B
(3, 3), -- Marc Dubois travaille à Clinique C
(4, 4), -- Sophie Lefevre travaille à Hôpital D
(5, 5), -- Jean Moreau travaille à Clinique E
(6, 6), -- Marie Fournier travaille à Hôpital F
(7, 7), -- Pierre Girard travaille à Clinique G
(8, 8), -- Anne Dupont travaille à Hôpital H
(9, 9), -- Julien Lambert travaille à Clinique I
(10, 10), -- Catherine Rousseau travaille à Hôpital J
(1, 11), -- Philippe Vidal travaille à Clinique A
(2, 12), -- Isabelle Gauthier travaille à Clinique B
(3, 13), -- Nicolas Chevalier travaille à Clinique C
(4, 14), -- Caroline Fontaine travaille à Hôpital D
(5, 15), -- Sebastien Morin travaille à Clinique E
(6, 16), -- Valerie Blanc travaille à Hôpital F
(7, 17), -- Patrick Leclerc travaille à Clinique G
(8, 18), -- Sandra Roux travaille à Hôpital H
(9, 19), -- Thomas Leroy travaille à Clinique I
(10, 20), -- Nathalie Brun travaille à Hôpital J
(1, 21), -- Christophe Meunier travaille à Clinique A
(2, 22), -- Sylvie Garnier travaille à Clinique B
(3, 23), -- Laurent Faure travaille à Clinique C
(4, 24), -- Brigitte Roussel travaille à Hôpital D
(5, 25); -- Eric Blanchard travaille à Clinique E

-- Insérer des données dans la table requiert
INSERT INTO requiert (id_dispo, id_medecin)
VALUES
(1, 1), -- Disponibilité 1 pour Paul Martin
(2, 2), -- Disponibilité 2 pour Claire Durand
(3, 3), -- Disponibilité 3 pour Marc Dubois
(4, 4), -- Disponibilité 4 pour Sophie Lefevre
(5, 5), -- Disponibilité 5 pour Jean Moreau
(6, 6), -- Disponibilité 6 pour Marie Fournier
(7, 7), -- Disponibilité 7 pour Pierre Girard
(8, 8), -- Disponibilité 8 pour Anne Dupont
(9, 9), -- Disponibilité 9 pour Julien Lambert
(10, 10), -- Disponibilité 10 pour Catherine Rousseau
(11, 11), -- Disponibilité 11 pour Philippe Vidal
(12, 12), -- Disponibilité 12 pour Isabelle Gauthier
(1, 13), -- Disponibilité 1 pour Nicolas Chevalier
(2, 14), -- Disponibilité 2 pour Caroline Fontaine
(3, 15), -- Disponibilité 3 pour Sebastien Morin
(4, 16), -- Disponibilité 4 pour Valerie Blanc
(5, 17), -- Disponibilité 5 pour Patrick Leclerc
(6, 18), -- Disponibilité 6 pour Sandra Roux
(7, 19), -- Disponibilité 7 pour Thomas Leroy
(8, 20), -- Disponibilité 8 pour Nathalie Brun
(9, 21), -- Disponibilité 9 pour Christophe Meunier
(10, 22), -- Disponibilité 10 pour Sylvie Garnier
(11, 23), -- Disponibilité 11 pour Laurent Faure
(12, 24), -- Disponibilité 12 pour Brigitte Roussel
(1, 25); -- Disponibilité 1 pour Eric Blanchard

-- Insérer des données dans la table relie
INSERT INTO relie (id_etablissement, id_dispo)
VALUES
(1, 1), -- Disponibilité 1 reliée à Clinique A
(2, 2), -- Disponibilité 2 reliée à Clinique B
(3, 3), -- Disponibilité 3 reliée à Clinique C
(4, 4), -- Disponibilité 4 reliée à Hôpital D
(5, 5), -- Disponibilité 5 reliée à Clinique E
(6, 6), -- Disponibilité 6 reliée à Hôpital F
(7, 7), -- Disponibilité 7 reliée à Clinique G
(8, 8), -- Disponibilité 8 reliée à Hôpital H
(9, 9), -- Disponibilité 9 reliée à Clinique I
(10, 10), -- Disponibilité 10 reliée à Hôpital J
(1, 11), -- Disponibilité 11 reliée à Clinique A
(2, 12); -- Disponibilité 12 reliée à Clinique B


-- Ajouter 7 nouvelles disponibilités pour le médecin avec l'ID 1 (Paul Martin)
INSERT INTO disponibilite (is_dispo, debut_periode, fin_periode, debut_heure, fin_heure)
VALUES
(TRUE, '2025-01-15', '2025-01-15', '09:00:00', '12:00:00'),
(TRUE, '2025-02-20', '2025-02-20', '13:00:00', '16:00:00'),
(TRUE, '2025-03-25', '2025-03-25', '08:00:00', '11:00:00'),
(TRUE, '2025-04-30', '2025-04-30', '14:00:00', '17:00:00'),
(TRUE, '2025-05-31', '2025-05-31', '10:00:00', '13:00:00'),
(TRUE, '2025-06-30', '2025-06-30', '15:00:00', '18:00:00'),
(TRUE, '2025-07-31', '2025-07-31', '09:00:00', '12:00:00');

-- Mettre à jour la table requiert pour refléter les nouvelles disponibilités
INSERT INTO requiert (id_dispo, id_medecin)
VALUES
(13, 1), -- Nouvelle disponibilité 1 pour Paul Martin
(14, 1), -- Nouvelle disponibilité 2 pour Paul Martin
(15, 1), -- Nouvelle disponibilité 3 pour Paul Martin
(16, 1), -- Nouvelle disponibilité 4 pour Paul Martin
(17, 1), -- Nouvelle disponibilité 5 pour Paul Martin
(18, 1), -- Nouvelle disponibilité 6 pour Paul Martin
(19, 1); -- Nouvelle disponibilité 7 pour Paul Martin

-- Mettre à jour la table relie pour refléter les nouvelles disponibilités
INSERT INTO relie (id_etablissement, id_dispo)
VALUES
(1, 13), -- Nouvelle disponibilité 1 reliée à Clinique A
(1, 14), -- Nouvelle disponibilité 2 reliée à Clinique A
(1, 15), -- Nouvelle disponibilité 3 reliée à Clinique A
(1, 16), -- Nouvelle disponibilité 4 reliée à Clinique A
(1, 17), -- Nouvelle disponibilité 5 reliée à Clinique A
(1, 18), -- Nouvelle disponibilité 6 reliée à Clinique A
(1, 19); -- Nouvelle disponibilité 7 reliée à Clinique A
