
## 🧠 **Exercice 1 – Procédure stockée : planifier une nouvelle séance**

### 🎯 Objectif :

Créer une **procédure stockée** qui ajoute automatiquement une nouvelle séance dans la base, avec vérification de cohérence.

---

### 🔧 Contexte :

On souhaite ajouter une nouvelle séance de film sans risque d’erreur (sur les IDs, horaires, etc.).

---

### ✍️ À faire :

Crée une **procédure stockée** nommée `ajouter_seance` qui prend en paramètre :

* l’ID du film
* l’ID du cinéma
* le numéro de salle
* la date
* l’heure

Et qui :

* Vérifie que la salle appartient bien à ce cinéma
* Vérifie qu’il n'y a pas de concurrence avec une autre séance dans la même salle
* Insère la séance si tout est valide
* Sinon, **lève une erreur** explicite (`SIGNAL SQLSTATE`)

---

### 📌 Exemple d’appel :

```sql
CALL ajouter_seance(2, 1, 3, '2025-06-05', '20:00:00');
```

---

## 🔁 **Exercice 2 – Trigger : empêcher de supprimer un film encore projeté**

### 🎯 Objectif :

Créer un **trigger** empêchant la suppression accidentelle d’un film qui a encore des séances programmées.

---

### 🔧 Contexte :

On veut protéger l'intégrité du planning. Si un film a encore des séances à venir, il **ne doit pas pouvoir être supprimé**.

---

### ✍️ À faire :

Créer un **trigger `BEFORE DELETE`** sur la table `films` qui :

* Vérifie si des séances sont encore prévues pour ce film (via la table `seances`)
* Si oui : **empêche la suppression** et lève une erreur explicite (`SIGNAL SQLSTATE`)
* Sinon : autorise la suppression

---

### 📌 Cas de test :

```sql
DELETE FROM films WHERE id = 4;
-- → Erreur si le film a encore des séances en base
```

---
