<?php
$exPerso = "livre";
// -> https://www.conseil-webmaster.com/formation/php-poo/01-classes-objets-php.php | https://waytolearnx.com/2024/10/exercices-corriges-php-programmation-orientee-objet-partie-1.html

if ($exPerso === "person") {
    class Person
    {
        // Déclarer une variable privée pour stocker le nom de la personne
        private $name;
        // Déclarer une variable privée pour stocker l'âge de la personne
        private $age;
        // Constructeur de la classe Person qui initialise les variables name et age
        public function __construct($name, $age)
        {
            // Attribuer à la variable name la valeur du paramètre name
            $this->name = $name;
            // Attribuer à la variable age la valeur du paramètre age
            $this->age = $age;
        }
        public function getName()
        {
            // Retourner la valeur de la variable name
            return $this->name;
        }
        public function getAge()
        {
            // Retourner la valeur de la variable age
            return $this->age;
        }
        // Méthode pour définir le nom de la personne
        public function setName($name)
        {
            // Attribuer à la variable name la valeur du paramètre name
            $this->name = $name;
        }
        // Méthode pour définir l'âge de la personne
        public function setAge($age)
        {
            // Attribuer à la variable age la valeur du paramètre age
            $this->age = $age;
        }
    }
    $p1 = new Person("Alex Babtise", 25);
    $p2 = new Person("Emily Tonari", 18);
    echo $p1->getName() . " a " . $p1->getAge() . " ans.\n";
    echo $p2->getName() . " a " . $p2->getAge() . " ans.\n";
    $p2->setName("Thomas Gozilla");
    $p2->setAge(30);
    echo $p2->getName() . " a " . $p2->getAge() . " ans.\n";
} else if ($exPerso === "chien") {
    class Chien
    {
        private $nom;
        private $race;

        public function __construct($nom, $race)
        {
            $this->nom = $nom;
            $this->race = $race;
        }

        public function getNom()
        {
            return $this->nom;
        }

        public function setNom($nom)
        {
            $this->nom = $nom;
        }

        public function getRace()
        {
            return $this->race;
        }

        public function setRace($race)
        {
            $this->race = $race;
        }
    }

    $chien1 = new Chien("Kiki", "Golder");
    $chien2 = new Chien("Kaka", "Saucisse");
    echo $chien1->getNom() . " et il est de race de " . $chien1->getRace() . "\n";
    $chien1->setNom("Koko");
    $chien1->setRace("Truc");
    echo $chien1->getNom() . " et il est de race de " . $chien1->getRace() . "\n";
} else if ($exPerso === "livre") {
    class Livre
    {
        private $titre;
        private $auteur;
        private $ISBN;
        private $livres;

        public function __construct($titre, $auteur, $ISBN)
        {
            $this->titre = $titre;
            $this->auteur = $auteur;
            $this->ISBN = $ISBN;
        }

        public function getTitre()
        {
            return $this->titre;
        }

        public function setTitre($titre)
        {
            $this->titre = $titre;
        }

        public function getAuteur()
        {
            return $this->auteur;
        }

        public function setAuteur($auteur)
        {
            $this->auteur = $auteur;
        }

        public function getISBN()
        {
            return $this->ISBN;
        }

        public function setISBN($ISBN)
        {
            $this->ISBN = $ISBN;
        }

        public static function addLivres($livres)
        {
            self::$livres[] = $livres;
        }

        public static function removeLivres($livres)
        {
            foreach (self::$livres as $key => $value) {
                if ($value === $livres) {
                    // Retire le livre de la collection
                    unset(self::$livres[$key]);
                }
            }
        }

        public function getLivres()
        {
            return $this->livres;
        }
    }

    $L1 = new Livre("Moi c'est moi", "Raph", "OUIIII");
    echo "L'auteur du livre : '" .  $L1->getTitre() . "' se nomme " . $L1->getAuteur() . " auquel sont ISBN est : " . $L1->getISBN() . "\n";
    $L2 = new Livre("One Piece", "Eichiro Oda", "KUZOKONI");
    Livre::addLivres($L1);
}
