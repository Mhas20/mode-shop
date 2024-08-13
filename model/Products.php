<?php

class Products
{
    private int $p_id;
    private string $p_name;
    private string $p_price;
    private string $role;
    private string $details;
    private string $image;

    /**
     * @param int $p_id
     * @param string $p_name
     * @param string $p_price
     * @param string $role
     * @param string $details
     * @param string $image
     */
    public function __construct(int $p_id, string $p_name, string $p_price, string $role, string $details, string $image)
    {
        $this->p_id = $p_id;
        $this->p_name = $p_name;
        $this->p_price = $p_price;
        $this->role = $role;
        $this->details = $details;
        $this->image = $image;
    }

    public function getPId(): int
    {
        return $this->p_id;
    }

    public function getPName(): string
    {
        return $this->p_name;
    }

    public function getRole(): string
    {
        return $this->role;
    }


    public function getPPrice(): string
    {
        return $this->p_price;
    }

    public function getDetails(): string
    {
        return $this->details;
    }
    public function getImage(): string
    {
        return $this->image;
    }


    public static function dbconn()
    {
        $servername = "localhost";
        $username = "root";
        $password = "";
        $dbname = "modeshops";
        return new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    }

    public static function createProducts(string $p_name, string $p_price, string $role, string $details, string $image): bool
    {
        $con = self::dbconn();
        $sql = 'INSERT INTO products (p_name, details, role, price, image) VALUES (:p_name, :details, :role, :price, :image)';
        $stmt = $con->prepare($sql);

        $stmt->bindParam(":p_name", $p_name);
        $stmt->bindParam(":price", $p_price);
        $stmt->bindParam(":role", $role);
        $stmt->bindParam(":details", $details);
        $stmt->bindParam(":image", $image);

        return $stmt->execute();
    }

    /**
     * @return Products[]
     */
    public static function findAll(): array
    {
        $con = self::dbconn();
        $sql = 'SELECT * FROM products';
        $stmt = $con->prepare($sql);
        $stmt->execute();
        $results = $stmt->fetchAll();

        $result = [];
        foreach ($results as $row){
            $result[] = new Products($row['p_id'],$row['p_name'],$row['price'],$row['role'],$row['details'],$row['image']);
        }
        return $result;

    }

    /**
     * @param int $p_id
     * @return Products|null
     */

    public static function findbyId(int $p_id): ?Products
    {
        $con = self::dbconn();
        $sql = 'SELECT * FROM products WHERE p_id = :p_id';
        $stmt = $con->prepare($sql);
        $stmt->bindParam(":p_id", $p_id);
        $stmt->execute();
        $results = $stmt->fetch(PDO::FETCH_ASSOC);
        if ($results){
            return new Products($results['p_id'], $results['p_name'], $results['price'], $results['role'], $results['details'],$results['image']);
        }
        else{
            return null;
        }
    }

    public static function startSession()
    {
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }
    }
    public static function addProduct($productId, $quantity)
    {
        self::startSession();

        if (isset($_SESSION['cart'][$productId])) {
            $_SESSION['cart'][$productId] += $quantity;
        } else {
            $_SESSION['cart'][$productId] = $quantity;
        }
    }
}