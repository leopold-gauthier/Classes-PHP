<?php
session_start();

class User
{

    private $id;
    public $login;
    private $password;
    public $email;
    public $firstname;
    public $lastname;
    public $bd;


    public function __construct()
    {

        // Variables declareé 
        $host = "localhost";
        $user_name = "root";
        $password_bd = "";
        $database = "classes";

        // this fais référence à l'objet courant
        $this->bd = mysqli_connect("$host", "$user_name", "$password_bd", "$database");
        if (!$this->bd) {
            die("Connexion lost");
            $message = "Connexion non trouvées";
        } else {
            $message = "Connexion établie";
        }
        echo "<p>$message</p>";
    }

    // FUNCTION //

    // register
    public function register($login, $password, $email, $firstname, $lastname)
    {
        $this->bd->query("INSERT INTO `utilisateurs` (`login`,`password`, `email`, `firstname`, `lastname`) VALUES ('$login','$password','$email','$firstname' ,'$lastname')");
    }
    // connect
    public function connect($login, $password)
    {
        $Requete = $this->bd->query("SELECT * FROM utilisateurs WHERE login = '" . $login . "' AND password = '" . $password . "'");
        $result = $Requete->fetch_all(MYSQLI_ASSOC);
        if (mysqli_num_rows($Requete) == 0) {
            $message = "Le login ou le mot de passe est incorrect, le compte n'a pas été trouvé";
        } else {
            $message = "Vous êtes à présent connecté !";
            $_SESSION['login'] = $login;
            $_SESSION['password'] = $password;
        }
        echo "<p>$message</p>";
    }
    // disconnect
    public function disconnect()
    {
        session_destroy();
    }
    // delete
    public function delete()
    {
        $Requete = $this->bd->query("DELETE FROM utilisateurs WHERE login = '" . $_SESSION['login'] . "'");
        session_destroy();
        echo "utilisateur supprimé";
    }
}



$User = new User();
$User->register('test', "test", "test", "test", "test");
// $User->connect('test', "test");
// $User->delete();

// 
