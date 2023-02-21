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
    protected $bd;


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
            $message = "Connexion établie a la bdd";
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
        if (mysqli_num_rows($Requete) == 0) {
            $message = "Le login ou le mot de passe est incorrect, le compte n'a pas été trouvé";
        } else {
            $_SESSION['login'] = $login;
            $_SESSION['password'] = $password;
        }
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
    // update
    public function update($login, $password, $email, $firstname, $lastname)
    {
        $Requete = $this->bd->query("UPDATE utilisateurs SET login = '$login', password='$password', email='$email' , firstname='$firstname' ,lastname='$lastname' WHERE login='" . $_SESSION["login"] . "'");
        echo "utilisateur a été modifé";
    }
    // isConnected ?
    public function isConnected()
    {
        if (isset($_SESSION['login'])) {
            echo "Vous étes connecté";
            return true;
        } else {
            echo "Vous étes pas connecté";
            return false;
        }
    }
    // getAllInfos
    public function getAllInfos()
    {
        $Requete = $this->bd->query("SELECT * FROM utilisateurs WHERE login = '" . $_SESSION['login'] . "'");
        $Requete = $Requete->fetch_all(MYSQLI_ASSOC);
        var_dump($Requete);
        return $Requete;
    }
    // getLogin
    public function getLogin()
    {
        $Requete = $this->bd->query("SELECT login FROM utilisateurs WHERE login = '" . $_SESSION['login'] . "'");
        $Requete = $Requete->fetch_all(MYSQLI_ASSOC);
        var_dump($Requete);
        return $Requete;
    }
    // getEmail
    public function getEmail()
    {
        $Requete = $this->bd->query("SELECT email FROM utilisateurs WHERE login = '" . $_SESSION['login'] . "'");
        $Requete = $Requete->fetch_all(MYSQLI_ASSOC);
        var_dump($Requete);
        return $Requete;
    }
    // getFirstname
    public function getFirstname()
    {
        $Requete = $this->bd->query("SELECT firstname FROM utilisateurs WHERE login = '" . $_SESSION['login'] . "'");
        $Requete = $Requete->fetch_all(MYSQLI_ASSOC);
        var_dump($Requete);
        return $Requete;
    }
    // getFirstname
    public function getLastname()
    {
        $Requete = $this->bd->query("SELECT lastname FROM utilisateurs WHERE login = '" . $_SESSION['login'] . "'");
        $Requete = $Requete->fetch_all(MYSQLI_ASSOC);
        var_dump($Requete);
        return $Requete;
    }
}
var_dump($_SESSION);
$User = new User();
// $User->register('test', "test", "test", "test", "test");
// $User->connect('test3', "test3");
// $User->disconnect();
// $User->delete();
// $User->update('test3', 'test3', 'test3', 'test3', 'test3');
// $User->isConnected();
// $User->getAllInfos();
// $User->getLogin();
// $User->getEmail();
// $User->getFirstname();
// $User->getLastname();



?>

<div><?php  ?></div>