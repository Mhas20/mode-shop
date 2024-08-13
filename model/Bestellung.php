<?php
class Bestellung
{
    private int $b_id;
    private int $u_id;
    private array $produkte;
    private string $datum;
    private int $amount;
    private int $ordernum;

    /**
     * @param int $b_id
     * @param int $u_id
     * @param array $produkte
     * @param string $datum
     * @param int $amount
     */
    public function __construct(int $b_id, int $u_id, array $produkte, string $datum, int $amount, int $ordernum)
    {
        $this->b_id = $b_id;
        $this->u_id = $u_id;
        $this->produkte = $produkte;
        $this->datum = $datum;
        $this->amount = $amount;
        $this->ordernum = $ordernum;
    }

    public function getBId(): int
    {
        return $this->b_id;
    }

    public function getUId(): int
    {
        return $this->u_id;
    }

    public function getProdukte(): array
    {
        return $this->produkte;
    }

    public function getDatum(): string
    {
        return $this->datum;
    }


    public function getAmount(): int
    {
        return $this->amount;
    }

    public function getOrdernum(): int
    {
        return $this->ordernum;
    }

    /**
     * @return PDO
     */
    public static function dbconn()
    {
        $servername = "localhost";
        $username = "root";
        $password = "";
        $dbname = "modeshops";
        return new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    }


    /**
     * @param int $u_id
     * @param int $p_id
     * @param int $amount
     * @param int $ordernum
     * @return bool
     */
    public static function createBestellung(int $u_id, int $p_id, int $amount, int $ordernum): bool
    {
        $con = self::dbconn();
        $datum = date('Y-m-d H:i:s');

        $sql = 'INSERT INTO Bestellung (u_id, p_id, dateTime, amount, ordernum) VALUES (:u_id, :p_id, :datum, :amount, :ordernum)';
        $stmt = $con->prepare($sql);
        $stmt->bindParam(':u_id', $u_id);
        $stmt->bindParam(':p_id', $p_id);
        $stmt->bindParam(':datum', $datum);
        $stmt->bindParam(':amount', $amount);
        $stmt->bindParam(':ordernum', $ordernum);
        $stmt->execute();

        return true;
    }

    /**
     * @param int $ordernum
     * @return array
     */

    public static function orderDetails(int $ordernum): array
    {
        $con = self::dbconn();
        // Anzeigen der einzelnen Produkte pro Bestellnummer
        $sql = 'SELECT * FROM Bestellung WHERE ordernum = :ordernum';
        $stmt = $con->prepare($sql);
        $stmt->bindParam(':ordernum', $ordernum, PDO::PARAM_INT);
        $stmt->execute();
        $bestellungen = $stmt->fetchAll(PDO::FETCH_ASSOC);

        if (empty($bestellungen)) {
            die('Keine Bestellungen gefunden.');
        }

        foreach ($bestellungen as $bestellung) {
            $sql = 'SELECT * FROM products WHERE p_id = :p_id';
            $stmt = $con->prepare($sql);
            $stmt->bindParam(':p_id', $bestellung['p_id'], PDO::PARAM_INT);
            $stmt->execute();
            $productData = $stmt->fetch(PDO::FETCH_ASSOC);
            if ($productData){
                $product = new Products(
                    $productData['p_id'],
                    $productData['p_name'],
                    $productData['price'],
                    $productData['role'],
                    $productData['details'],
                    $productData['image'],
                );
                $bestellung['produkte'][] = $product;
            }

            $orders[] = new Bestellung(
                $bestellung['b_id'],
                $bestellung['u_id'],
                $bestellung['produkte'],
                $bestellung['dateTime'],
                $bestellung['amount'],
                $bestellung['ordernum'],
            );
        }

        return $orders;
    }

    /**
     * @param int $u_id
     * @return array
     */
    public static function findOrderNum(int $u_id): array
    {
        $con = self::dbconn();

        // Gruppierung und Sortierung nach Datum außerdem nur eine b_id anzeigen damit die Bestellung nicht doppelt anzuzeigen
        $sql = 'SELECT b.*  FROM Bestellung b INNER JOIN (
            SELECT ordernum, MAX(dateTime) as max_date 
            FROM Bestellung 
            WHERE u_id = :u_id 
            GROUP BY ordernum 
        ) latest 
        ON b.ordernum = latest.ordernum 
        AND b.dateTime = latest.max_date 
        AND b.b_id = (
            SELECT MIN(b_id)
            FROM Bestellung
            WHERE ordernum = b.ordernum
            AND dateTime = b.dateTime
        )
        ORDER BY latest.max_date DESC';

        $stmt = $con->prepare($sql);
        $stmt->bindParam(':u_id', $u_id, PDO::PARAM_INT);
        $stmt->execute();
        $bestellungData = $stmt->fetchAll(PDO::FETCH_ASSOC);

        $bestellungen = [];
        foreach ($bestellungData as $bestellung) {
            $sql = 'SELECT p_id FROM Bestellung WHERE ordernum = :ordernum GROUP BY ordernum';
            $stmt = $con->prepare($sql);
            $stmt->bindParam(':ordernum', $bestellung['ordernum'], PDO::PARAM_INT);
            $stmt->execute();
            $produkteData = $stmt->fetchAll(PDO::FETCH_COLUMN);

            $bestellungen[] = new Bestellung(
                $bestellung['b_id'],
                $bestellung['u_id'],
                $produkteData,
                $bestellung['dateTime'],
                $bestellung['amount'],
                $bestellung['ordernum']
            );
        }
        return $bestellungen;
    }


    public static function randOrderNum() {
        return mt_rand(1000, 9999);
    }

}

