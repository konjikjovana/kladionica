<?php
class Baza
{
    private $konekcija;

    public function __construct()
    {
        $this->konekcija = new Mysqli('localhost','root','','ekladionica');
        $this->konekcija->set_charset("utf8");
    }

    public function vratiAktivneMeceve()
    {
        $upit = "SELECT * FROM mec where datumMeca > now()";
        $resultSet = $this->konekcija->query($upit);
        $rezultat = [];
        while($red = $resultSet->fetch_object()){
            $rezultat[] = $red;
        }

        return $rezultat;
    }

    public function vratiMecPoIdu($id)
    {
        $upit = "SELECT * FROM mec where mecID = " .$id;
        $resultSet = $this->konekcija->query($upit);
        $rezultat = [];
        while($red = $resultSet->fetch_object()){
            return $red;
        }

        return null;
    }

    public function vratiKvoteZaMec($id)
    {
        $upit = "SELECT * FROM kvota k join ishod i on k.ishodID = i.ishodID join igra ig on i.igraID = ig.igraID where k.mecID = ".$id;
        $resultSet = $this->konekcija->query($upit);
        $rezultat = [];
        while($red = $resultSet->fetch_object()){
            $rezultat[] = $red;
        }

        return $rezultat;
    }

    public function login($username, $password)
    {
        $stmt = $this->konekcija->prepare("SELECT * FROM korisnik WHERE username = ? AND password = ?");
        $stmt->bind_param("ss", $username, $password);
        $stmt->execute();

        $resultSet = $stmt->get_result();
        $stmt->close();

        while($red = $resultSet->fetch_object()){
            return $red;
        }

        return null;
    }

    public function registruj($username, $password, $imeprezime)
    {
        $stmt = $this->konekcija->prepare("INSERT INTO korisnik(imePrezime,username,password,balans,tipKorisnika) VALUES(?,?,?,?,?)");
        $tipKorisnika = 'Kockar';
        $balans = 0;
        $stmt->bind_param("sssds", $imeprezime, $username, $password,$balans,$tipKorisnika);
        return $stmt->execute();
    }
}