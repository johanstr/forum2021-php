<?php


namespace App\Models;


use App\Database\Database;

class UserModel
{
    // Properties (eigenschappen)
    private static $db = null;

    // Methods (functionaliteit)
    private static function openConnection()
    {
        self::$db = new Database();
    }

    /*
     * all
     * Haalt alle records uit de threads tabel
     */
    public static function all() : array
    {
        if(self::$db === null)
            self::openConnection();

        self::$db->query("SELECT * FROM users");

        return self::$db->getAll();
    }

    public static function find(int $id) : array
    {
        if(self::$db === null)
            self::openConnection();

        self::$db->query("SELECT * FROM `users` WHERE `id` = :id", [':id' => $id]);

        return [ self::$db->get() ];
    }

    public static function findByColumn(string $column, string $value) : array
    {
        if(self::$db === null)
            self::openConnection();

        self::$db->query("SELECT * FROM `users` WHERE `{$column}` = :value", [ ':value' => $value ]);

        return [ self::$db->get() ];
    }

    /*
     * Creëren van een nieuwe record in de tabel Threads
     */
    public static function create(array $data) : array
    {
        // Als er nog geen connectie met de database server is
        if(self::$db === null)
            self::openConnection();         // Dan maken we de connectie nu

        $args = [];                 // Hulpvariabele, bevat de placeholders en de values
        $column_names = '';         // String voor SQL van alle kolommen die gevuld gaan worden
        $value_placeholders = '';   // String voor de SQL code met placeholder namen
        $first = true;              // Hulpvariabele, om te bepalen of een komma vooraf moet of niet

        foreach($data as $key => $value) {
            if($first) {
                $first = false;                     // Dit is de eerste kolom, dus alle volgende niet. Vandaar nu false
                $column_names .= "`{$key}`";        // Construeert b.v. `kolomnaam`
                $value_placeholders .= ":{$key}";   // Construeert b.v. :kolomnaam
            } else {
                $column_names .= ", `{$key}`";      // Construeert b.v. , `kolomnaam`
                $value_placeholders .= ", :{$key}"; // Construeert b.v. , :kolomnaam
            }
            $args[":{$key}"] = $value;      // Array bedoeld voor de PDO execute functie
        }

        // Hier stellen we nu de complete SQL statement samen
        $sql = "INSERT INTO `users` ({$column_names}) VALUES($value_placeholders)";

        // Nu geven we de SQL en de array met placeholders door en voegen de record toe aan de db
        $lastID = self::$db->insert($sql, $args);

        // We genereren hier de return structuur voor de client. De client krijgt ook de
        // nieuwe ID van deze toegevoegde record terug
        return [ 'msg' => 'User created', 'id' => $lastID ];
    }

    /*
     * Updaten van een bestaande record in de tabel threads
     */
    public static function update(array $data, int $id) : array
    {
        // Als er nog geen connectie met de database server is
        if(self::$db === null)
            self::openConnection();         // Dan maken we de connectie nu

        $args = [':id' => $id];                 // Hulpvariabele, bevat de placeholders en de values
        $column_names = '';         // String voor SQL van alle kolommen die gevuld gaan worden
        $first = true;              // Hulpvariabele, om te bepalen of een komma vooraf moet of niet

        foreach($data as $key => $value) {
            if($first) {
                $first = false;                     // Dit is de eerste kolom, dus alle volgende niet. Vandaar nu false
                $column_names .= "`{$key}` = :{$key}";        // Construeert b.v. `kolomnaam`
            } else {
                $column_names .= ", `{$key}` = :{$key}";      // Construeert b.v. , `kolomnaam`
            }
            $args[":{$key}"] = $value;      // Array bedoeld voor de PDO execute functie
        }

        // Hier stellen we nu de complete SQL statement samen
        $sql = "UPDATE `users` SET {$column_names} WHERE `id` = :id";

        // Nu geven we de SQL en de array met placeholders door en voegen de record toe aan de db
        self::$db->query($sql, $args);

        // We genereren hier de return structuur voor de client. De client krijgt ook de
        // nieuwe ID van deze toegevoegde record terug
        return [ 'msg' => 'User updated', 'id' => $id ];
    }

    /*
     * Verwijderen van een record uit de tabel threads
     */
    public static function destroy(int $id) : array
    {
        // Als er nog geen connectie met de database server is
        if(self::$db === null)
            self::openConnection();         // Dan maken we de connectie nu

        $sql = "DELETE FROM `users` WHERE `id` = :id";

        self::$db->query($sql, [ ':id' => $id ]);

        return [ 'msg' => 'User deleted', 'id' => $id ];
    }

}