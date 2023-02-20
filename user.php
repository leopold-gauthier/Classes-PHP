<?php
class User
{
    private $id;
    public $login;
    public $email;
    public $firstname;
    public $lastname;
    public $bd;


    public function __construct()
    {

        // Variables declareé 
        $host = "localhost";
        $user_name = "root";
        $password = "";
        $database = "classes";

        // this fais référence à l'objet courant
        $this->bd = mysqli_connect("$host", "$user_name", "$password", "$database");
        if (!$this->bd) {
            die("Connexion lost");
        } else {
            echo "Connexion établie";
        }
    }


    // FUNCTION

    public function register($login, $email, $firstname, $lastname)
    {
        $this->bd->query("INSERT INTO `utilisateurs` (`login`, `email`, `firstname`, `lastname`) VALUES ('$login','$email','$firstname' ,'$lastname')");
    }
}



$User = new User();
$User->register('klaadada', "jajdajda", "ddada", "ddada");
// 