<?php

class User
{
    private int $u_id;
    private string $fname;
    private string $lname;
    private string $email;
    private string $password;
    private string $address;

    /**
     * @param int $u_id
     * @param string $fname
     * @param string $lname
     * @param string $email
     * @param string $password
     * @param string $address
     */
    public function __construct(int $u_id, string $fname, string $lname, string $email, string $password, string $address)
    {
        $this->u_id = $u_id;
        $this->fname = $fname;
        $this->lname = $lname;
        $this->email = $email;
        $this->password = $password;
        $this->address = $address;
    }

    public function getUId(): int
    {
        return $this->u_id;
    }

    public function getFname(): string
    {
        return $this->fname;
    }


    public function getLname(): string
    {
        return $this->lname;
    }


    public function getEmail(): string
    {
        return $this->email;
    }

    public function getPassword(): string
    {
        return $this->password;
    }


    public function getAddress(): string
    {
        return $this->address;
    }


    public static function dbcon()
    {
        $servername = "localhost";
        $username = "root";
        $password = "";
        $dbname = "modeshops";
        return new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    }

    public static function createUser(string $fname, string $lname, string $password, string $email, string $address): bool
    {
        $con = self::dbcon();
        try {
            $sql = 'INSERT INTO user (fname, lname, email, password, address) VALUES (:fname, :lname, :email, :pwhash, :address)';
            $stmt = $con->prepare($sql);

            $pwhash = password_hash($password,PASSWORD_DEFAULT);

            $stmt->bindParam(':fname', $fname);
            $stmt->bindParam(':lname', $lname);
            $stmt->bindParam(':email', $email);
            $stmt->bindParam(':pwhash', $pwhash);
            $stmt->bindParam(':address', $address);
            return $stmt->execute();

        } catch (PDOException $e) {

            if ($e->getCode() == 23000) {
                throw new Exception("Diese E-Mail-Adresse ist bereits vergeben.");
            } else {
                throw new Exception("Fehler bei der Registrierung: " . $e->getMessage());
            }
        }

    }

    /**
     * @param $u_id
     * @return User
     */
    public static function findbyUser($u_id){
        $con = self::dbcon();
        $sql = 'SELECT * FROM user WHERE u_id = :u_id';
        $stmt = $con->prepare($sql);
        $stmt->bindParam(':u_id', $u_id);
        $stmt->execute();
        $results = $stmt->fetch(PDO::FETCH_ASSOC);

        return new User($results['u_id'],
            $results['fname'],
            $results['lname'],
            $results['email'],
            $results['password'],
            $results['address']);

    }

    /**
     * @param string $email
     * @return User|null
     */
    public static function findByEmail(string $email): ?User
    {
        $con = self::dbcon();
        $sql = 'SELECT * FROM User WHERE email = :email';
        $stmt = $con->prepare($sql);
        $stmt->bindParam(':email', $email);
        $stmt->execute();
        $results = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($results){
            return new User($results['u_id'], $results['fname'], $results['lname'], $results['email'], $results['password'], $results['address']);

        }
        else{
            return null;
        }
    }

    /**
     * @param string $email
     * @param string $password
     * @return User|bool
     */
    public static function login(string $email, string $password): User|bool
    {
        $user = self::findByEmail($email);

        if ($user) {
            if (password_verify($password, $user->getPassword())) {
                return $user;
            } else {
                return "falsche PW";
            }
        } else {
            return "falsche User";
        }

    }

}