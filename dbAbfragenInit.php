<?php

class DB
{


    public function connect()
    {

        try {
            $datasource = "mysql:host=localhost;dbname=vhsgm";
            return new PDO($datasource, "root", "");
        } catch (PDOException $exc) {
            echo $exc->getTraceAsString();
            die();
        }
    }


    public function GetAllKurse()
    {
        try {
            header('Content-Type: application/json');
            $sql = 'SELECT * FROM Kurse';
            $statement = $this->connect()->prepare($sql);
            $inserted = $statement->execute();

            if ($inserted) {
                $data = $statement->fetchAll(PDO::FETCH_ASSOC);
                echo json_encode($data);
            } else {
                $response["massage"] = "GetAllKurse fehlgeschlagen";
            }
        } catch (PDOException $exc) {
            echo $exc->getTraceAsString();
            die();
        }
    }

    public function CheckUser($Email)
    {
        try {

            $sql = 'SELECT Email FROM schüler WHERE Email = ?';
            $statement = $this->connect()->prepare($sql);
            $statement->execute([$Email]);
            $data = $statement->fetch(PDO::FETCH_ASSOC);

            if ($data == false) {

                return $data;
            } else {

                return true;
            }
        } catch (PDOException $exc) {
            echo $exc->getTraceAsString();
            die();
        }
    }
    public function Registriren($Nachname, $Vorname, $Email, $Passwort, $Passwortwiderholen)
    {

        try {

            if (empty($Nachname) || empty($Vorname) || empty($Email) || empty($Passwort) || empty($Passwortwiderholen)) {

                echo json_encode("Alle Felder Ausfüllen");
            } else if (!filter_var($Email, FILTER_VALIDATE_EMAIL)) {

                echo json_encode("Das ist keine email");
            } else if ($Passwortwiderholen != $Passwort) {

                echo json_encode("Passwörter sind nicht gleich");
            } else
            if ($this->CheckUser($Email)) {
                echo json_encode("Diesen Schüler gibts es schon");
            } else {

                $sql = "INSERT INTO schüler (Nachname, Vorname, Email, Passwort) VALUES (?,?,?,?)";
                $st = $this->connect()->prepare($sql);

                $PasswortHas = password_hash($Passwort, PASSWORD_DEFAULT);


                $inserted = $st->execute([$Nachname, $Vorname, $Email, $PasswortHas]);



                if ($inserted) {


                    echo json_encode("User Erstelt");
                } else {


                    echo json_encode("Registriren fehlgeschlagen");
                }
            }
        } catch (PDOException $exc) {
            echo $exc->getTraceAsString();
            die();
        }
    }
    public function Anmelden($Email, $Passwort)
    {
        try {

            $sql = 'SELECT `Schüler_ID`, `Nachname`, `Vorname`, `Email`, `Passwort` FROM `schüler` WHERE Email=?';
            $statement = $this->connect()->prepare($sql);
            $inserted = $statement->execute([$Email]);

            if ($inserted) {
                $data = $statement->fetchAll(PDO::FETCH_ASSOC);


                if (password_verify($Passwort, $data[0]['Passwort'])) {
                    echo json_encode($data);
                } else {

                    echo json_encode("Falsches Passwort");
                }
            } else {

                echo json_encode("Diesen Benutzer gibt es nicht");
            }
        } catch (PDOException $exc) {
            echo $exc->getTraceAsString();
            die();
        }
    }

    public function KurseBuchen($Datum, $KursID, $SchülerID)
    {
        try {
            header('Content-Type: application/json');
            $sql = 'INSERT INTO `gebucht`(`Datum`, `Kurs_ID`, `Schüler_ID`) VALUES (?,?,?)';
            $statement = $this->connect()->prepare($sql);
            $inserted = $statement->execute([$Datum, $KursID, $SchülerID]);

            if ($inserted) {

                echo json_encode("Kurs Gebucht");
            } else {
                echo json_encode("Kurs buchen Fehlgeschlagen");
            }
        } catch (PDOException $exc) {
            echo $exc->getTraceAsString();
            die();
        }
    }

    public function UpdateKurseAnzahlFreiPlus($KursID)
    {
        try {
            header('Content-Type: application/json');
            $sql = 'UPDATE `kurse` SET `Anzahl_Frei`=Anzahl_Frei+1 WHERE `Kurs_ID`=?';
            $statement = $this->connect()->prepare($sql);
            $inserted = $statement->execute([$KursID]);

            if ($inserted) {
                $data = $statement->fetchAll(PDO::FETCH_ASSOC);
                echo json_encode($data);
            } else {
                $response["massage"] = "GetAllKurse fehlgeschlagen";
            }
        } catch (PDOException $exc) {
            echo $exc->getTraceAsString();
            die();
        }
    }
    public function UpdateKurseAnzahlFreiMinus($KursID)
    {
        try {
            header('Content-Type: application/json');
            $sql = 'UPDATE `kurse` SET `Anzahl_Frei`=Anzahl_Frei-1 WHERE `Kurs_ID`=?';
            $statement = $this->connect()->prepare($sql);
            $inserted = $statement->execute([$KursID]);

            if ($inserted) {
                $data = $statement->fetchAll(PDO::FETCH_ASSOC);
                echo json_encode($data);
            } else {
                $response["massage"] = "GetAllKurse fehlgeschlagen";
            }
        } catch (PDOException $exc) {
            echo $exc->getTraceAsString();
            die();
        }
    }
    public function EndBuchen($SchülerID, $KursID)
    {
        try {
            header('Content-Type: application/json');
            $sql = 'DELETE FROM `gebucht` WHERE Schüler_ID=? AND Kurs_ID=? ';
            $statement = $this->connect()->prepare($sql);
            $inserted = $statement->execute([$SchülerID, $KursID]);

            if ($inserted) {

                echo json_encode("Kurs Gebucht");
            } else {
                echo json_encode("Kurs buchen Fehlgeschlagen");
            }
        } catch (PDOException $exc) {
            echo $exc->getTraceAsString();
            die();
        }
    }
    public function GetGebucht($SchülerID)
    {
        try {
            header('Content-Type: application/json');
            $sql = 'SELECT `Kurs_ID` FROM `gebucht` WHERE Schüler_ID=?';
            $statement = $this->connect()->prepare($sql);
            $inserted = $statement->execute([$SchülerID]);

            if ($inserted) {
                $data = $statement->fetchAll(PDO::FETCH_ASSOC);
                echo json_encode($data);
            } else {
                echo json_encode("GetGebucht fehlgeschlagen");
            }
        } catch (PDOException $exc) {
            echo $exc->getTraceAsString();
            die();
        }
    }
}
