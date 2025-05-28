
## Scaler un système de notation de jeux vidéo en live

Aucune techno imposée (si ce n'est Kubernetes).
Si tu veux adapter le problème pour qu'il s'adapte davantage à ton projet, n'hésite pas.


---

### 🎯 **Contexte du projet**

Tu travailles sur un projet avec un ami streamer Twitch. Pendant les lives, les viewers notent en direct les jeux testés avec un barème personnalisé (ex : fun, graphismes, durée de vie…). En dehors des lives, il n’y a quasiment **aucune** activité.

**Objectifs techniques :**

* **Répartir les données ** (partitionnement)
* **Gérer les montées en charge** ponctuelles (pics pendant les lives)
* **Proposer une architecture scalable** pour ne pas planter sous la charge
* **Simuler un afflux massif d’écritures et de lectures**
* **Assurer un backup/disponibilité des données**

---

## 🧩 Étape 1 – Conception de la base de données

Tu dois modéliser les données suivantes :

* `jeux` : infos sur les jeux testés
* `barèmes` : les critères utilisés (fun, immersion, etc.)
* `notes` : les notes données par les viewers
* `viewers` : optionnel si tu veux enregistrer qui vote

> ✅ **Ajoute `live_id` ou `timestamp`** des notes pour segmenter les données temporellement → utile pour le **partitionnement**

---

## ⚙️ Étape 2 – Partitionnement horizontal

Tu dois proposer une **stratégie de partitionnement** :

* Par `live_id` ? Par `jeu_id` ? Par mois ?

> 💡 Il doit y avoir **au moins 3 partitions**, réparties sur **différents volumes ou nœuds**

---

## 🖥️ Étape 3 – Architecture scalable avec Kubernetes

### ✍️ À faire :

* Proposer un schéma d’architecture :

  * BDD principale partitionnée
  * Réplicas (lecture)
  * Service backend qui reçoit les votes
  * Load balancer
  * Cluster Kubernetes (minikube ou GKE)

* Justifier le choix des composants :

  * Pourquoi Kubernetes ?
  * Quel SGBD pour supporter la charge ?
  * Où sont les backups ? Les réplicas ?
  * Comment tu scales la base  pendant un live ?


---

## 📊 Étape 4 – Simuler l'afflux massif pendant un live

Créer un **script de simulation** (Python, JS, PHP, Bash…) qui :

* Simule 10.000 notes envoyées en 10 minutes
* Avec des notes aléatoires sur plusieurs jeux
* Affiche des notes moyennes en live

```bash
for i in {1..10000}; do
  curl -X POST http://localhost:PORT/api/note -d 'jeu_id=2&fun=4&graph=3&durée=5'
done
```

> ✅ Mesure le **temps de réponse**, la **charge** ...

---

## 💾 Étape 5 – Résilience et backup

* Mettre en place un **dump automatique** des données après chaque live
* Proposer une stratégie de **rétention des données**

---

## 💬 Livrables attendus

* ✅ Script de création + partitions
* ✅ Script de simulation de charge
* ✅ Diagramme d’architecture scalable
* ✅ Documentation expliquant :

  * Le choix de partitionnement
  * Comment l’architecture supporte les pics de charge
  * Comment se fait la réplication / sauvegarde
