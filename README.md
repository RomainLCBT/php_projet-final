
# Projet PHP avec Configuration PostgreSQL

Ce guide vous guidera à travers l'installation de PostgreSQL, sa connexion à votre projet PHP, et la vérification de la création de la base de données et des tables.

## Prérequis
- **VSCode** avec intégration WSL (Windows Subsystem for Linux)
- **Serveur web Apache** installé
- **PHP** installé sur votre machine
- **PostgreSQL** installé via WSL

---

## Étapes à suivre

### 1. Installer PostgreSQL
Ouvrez votre terminal dans VSCode et suivez les étapes ci-dessous pour installer PostgreSQL.

```bash
sudo apt-get update
sudo apt-get install postgresql
```

### 2. Installer le module PHP PostgreSQL
Installez le module PHP PostgreSQL pour permettre à PHP d'interagir avec la base de données PostgreSQL.

```bash
sudo apt-get install php-pgsql
```

### 3. Démarrer le service PostgreSQL
Démarrez le service PostgreSQL avec la commande suivante :

```bash
sudo service postgresql start
```

### 4. Se connecter à PostgreSQL
Passez à l'utilisateur PostgreSQL et entrez dans le prompt PostgreSQL.

```bash
sudo -u postgres psql
```

### 5. Créer la base de données
Dans le prompt PostgreSQL, créez une nouvelle base de données nommée `citations`.

```sql
create database citations;
```

### 6. Vérifier la création de la base de données
Pour confirmer que la base de données a bien été créée, utilisez la commande suivante :

```sql
\l
```

### 7. Changer le mot de passe de l'utilisateur PostgreSQL
Changez le mot de passe de l'utilisateur `postgres` par défaut.

```sql
ALTER USER postgres WITH PASSWORD 'new_password';
```

---

### 8. Installer l'extension SQLTools PostgreSQL pour VSCode
Pour interagir avec PostgreSQL depuis VSCode, installez l'extension **SQLTools PostgreSQL/Cockroach** :

1. Ouvrez VSCode et allez dans la vue Extensions.
2. Recherchez **SQLTools PostgreSQL/Cockroach** et installez-la.
3. Cliquez sur l'icône de la base de données à gauche et sélectionnez **Add new connection**.
4. Choisissez **PostgreSQL** et remplissez les champs nécessaires (généralement le port 5432 ou 5433, vérifiez votre configuration avec `sudo /etc/init.d/postgresql status`).

Cliquez sur **Test Connection**. Si la connexion est réussie, un message indiquant "Successfully connected!" apparaîtra.

---

### 9. Sauvegarder et se connecter
Cliquez sur **Save Connection** puis sur **Connect Now**. Cela va créer un fichier SQL dans le répertoire `var/www/html`.

### 10. Exécuter les fichiers SQL
Exécutez maintenant les fichiers SQL pour créer et remplir les tables de la base de données :

1. Ouvrez les fichiers `base.sql` et `data.sql` situés dans le dossier `sql`.
2. Faites un clic droit sur le fichier et sélectionnez **Run on active connection** pour les exécuter.

Cela va créer les tables et insérer les données nécessaires dans votre base de données PostgreSQL.

---

### 11. Vérifier la création des tables
Enfin, utilisez VSCode pour vérifier que les tables ont bien été créées dans la base de données.

---

### 12. Démarrer le serveur Apache
Pour démarrer le serveur Apache, exécutez la commande suivante :

```bash
sudo service apache2 start
```

---

### 13. Accéder au projet dans le navigateur
- Ouvrez votre navigateur web et allez sur `http://localhost/nom_de_votre_projet`.
- Naviguez vers le dossier "site" puis cliquez sur le fichier `register.html` pour le visualiser.

---

En suivant ces étapes, vous aurez correctement configuré votre base de données PostgreSQL et votre serveur Apache pour le projet PHP.
