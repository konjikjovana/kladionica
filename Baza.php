<?php
class Baza
{
    private $konekcija;

    public function __construct()
    {
        $this->konekcija = new Mysqli('localhost','root','','ekladionica');
        $this->konekcija->set_charset("utf8");
    }

    public function vratiAktivneMeceve($mecevi)
    {
        if(empty($mecevi)){
            $upit = "SELECT * FROM mec where datumMeca > now()";
        }else{
            $idMeceva = implode(",",$mecevi);
            $upit = "SELECT * FROM mec where datumMeca > now() and mecID NOT IN (".$idMeceva.")";
        }

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

    public function vratiKvotePoIdu($id)
    {
        $upit = "SELECT * FROM kvota k join ishod i on k.ishodID = i.ishodID where kvotaID = " .$id;
        $resultSet = $this->konekcija->query($upit);

        while($red = $resultSet->fetch_object()){
            return $red;
        }

        return null;
    }

    public function napraviTiket($uplata, $korisnikID)
    {
        $stmt = $this->konekcija->prepare("INSERT INTO tiket VALUES(null,?,?,?,?)");
        $status = 'Tekuci';
        $datum = date("Y-m-d H:i:s");
        $stmt->bind_param("sisi", $datum, $uplata, $status,$korisnikID);
        return $stmt->execute();
    }

    public function vratiPoslednjiID()
    {
        return $this->konekcija->insert_id;
    }

    public function sacuvajOdigrano($tiketID, $kvotaID)
    {
        $stmt = $this->konekcija->prepare("INSERT INTO odigrano VALUES(null,?,?)");
        $stmt->bind_param("ii", $tiketID, $kvotaID);
        return $stmt->execute();
    }

    public function promeniBalans($uplata,$korisnikID)
    {
        $stmt = $this->konekcija->prepare("UPDATE korisnik SET balans = ? WHERE korisnikid = ?");
        $stmt->bind_param("ii", $uplata, $korisnikID);
        return $stmt->execute();
    }

    public function vratiTiketeZaKorisnika($id)
    {
        $upit = "SELECT * FROM tiket where korisnikID = ".$id;
        $resultSet = $this->konekcija->query($upit);
        $rezultat = [];
        while($red = $resultSet->fetch_object()){
            $rezultat[] = $red;
        }

        return $rezultat;
    }

    public function vratiOdigraneUtakmice($tiketID)
    {
        $upit = "select * from odigrano o join kvota k on o.kvotaID = k.kvotaID join mec m on k.mecID = m.mecID join ishod i on k.ishodID = i.ishodID join igra ig on i.igraID = ig.igraID where o.tiketID =".$tiketID;
        $resultSet = $this->konekcija->query($upit);
        $rezultat = [];
        while($red = $resultSet->fetch_object()){
            $rezultat[] = $red;
        }

        return $rezultat;
    }

    public function vratiKorisnikeKockare()
    {
        $upit = "select * from korisnik where tipKorisnika = 'Kockar'";
        $resultSet = $this->konekcija->query($upit);
        $rezultat = [];
        while($red = $resultSet->fetch_object()){
            $rezultat[] = $red;
        }

        return $rezultat;
    }

    public function vratiTrenutniBalans($korisnikID)
    {
        $upit = "select balans from korisnik where korisnikID = ".$korisnikID;
        $resultSet = $this->konekcija->query($upit);

        while($red = $resultSet->fetch_object()){
            return $red->balans;
        }

        return 0;
    }

    public function vratiTikete()
    {
        $upit = "SELECT * FROM tiket ";
        $resultSet = $this->konekcija->query($upit);
        $rezultat = [];
        while($red = $resultSet->fetch_object()){
            $rezultat[] = $red;
        }

        return $rezultat;
    }
    public function vratiTiketeGrafik()
    {
        $upit = "SELECT statusTiketa,count(tiketID) as broj FROM tiket group by statusTiketa";
        $resultSet = $this->konekcija->query($upit);
        $rezultat = [];
        while($red = $resultSet->fetch_object()){
            $rezultat[] = $red;
        }

        return $rezultat;
    }

    public function podaciGrafik()
    {
        $upit = "SELECT ishod,count(id) as broj FROM odigrano o join kvota k on o.kvotaID = k.kvotaID join mec m on k.mecID = m.mecID join ishod i on k.ishodID = i.ishodID join igra ig on i.igraID = ig.igraID group by i.ishodID";
        $resultSet = $this->konekcija->query($upit);
        $rezultat = [];
        while($red = $resultSet->fetch_object()){
            $rezultat[] = $red;
        }

        return $rezultat;
    }

    public function promeniStatusTiketa($status, $tiketID)
    {
        $stmt = $this->konekcija->prepare("UPDATE tiket SET statusTiketa = ? WHERE tiketID = ?");
        $stmt->bind_param("si", $status, $tiketID);
        return $stmt->execute();
    }

    public function vratiTiket($tiketID)
    {
        $upit = "SELECT * FROM tiket where tiketID = ".$tiketID;
        $resultSet = $this->konekcija->query($upit);

        while($red = $resultSet->fetch_object()){
            return $red;
        }

        return null;
    }

    public function vratiIshode()
    {
        $upit = "select * from ishod i join igra ig on i.igraID = ig.igraID";
        $resultSet = $this->konekcija->query($upit);
        $rezultat = [];
        while($red = $resultSet->fetch_object()){
            $rezultat[] = $red;
        }

        return $rezultat;
    }
    public function vratiIgre()
    {
        $upit = "select * from  igra";
        $resultSet = $this->konekcija->query($upit);
        $rezultat = [];
        while($red = $resultSet->fetch_object()){
            $rezultat[] = $red;
        }

        return $rezultat;
    }

    public function unesiMec($domacin, $gost, $datum)
    {
        $stmt = $this->konekcija->prepare("INSERT INTO mec VALUES(null,?,?,?)");
        $stmt->bind_param("sss", $domacin, $gost, $datum);
        return $stmt->execute();
    }

    public function vratiMeceve()
    {
        $upit = "select * from  mec";
        $resultSet = $this->konekcija->query($upit);
        $rezultat = [];
        while($red = $resultSet->fetch_object()){
            $rezultat[] = $red;
        }

        return $rezultat;
    }

    public function pronadjiKvotuZaMecIIshod($mecID, $ishodID)
    {
        $upit = "select * from  kvota where mecID = ".$mecID . " AND ishodID = ".$ishodID;
        $resultSet = $this->konekcija->query($upit);
        $rezultat = [];
        while($red = $resultSet->fetch_object()){
            $rezultat[] = $red;
        }

        return $rezultat;
    }

    public function sacuvajKvotu($mecID, $ishodID, $kvota)
    {
        $stmt = $this->konekcija->prepare("INSERT INTO kvota VALUES(null,?,?,?)");
        $stmt->bind_param("dii", $kvota, $mecID, $ishodID);
        return $stmt->execute();
    }
}