<?php


namespace App\Models;
use App\Database\Database;
use App\Http\HttpResponse;

class ThreadModel
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
    public static function all()
    {
        if(self::$db === null)
            self::openConnection();

        self::$db->query("SELECT * FROM threads");

        return self::$db->getAll();
    }

    public static function find($id)
    {
        if(self::$db === null)
            self::openConnection();

        self::$db->query("SELECT * FROM `threads` WHERE `id` = :id", [':id' => $id]);

        return [ self::$db->get() ];
    }

    /*
     * Creëren van een nieuwe record in de tabel Threads
     */
    public static function create($data)
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
        $sql = "INSERT INTO `threads` ({$column_names}) VALUES($value_placeholders)";

        // Nu geven we de SQL en de array met placeholders door en voegen de record toe aan de db
        $lastID = self::$db->insert($sql, $args);

        // We genereren hier de return structuur voor de client. De client krijgt ook de
        // nieuwe ID van deze toegevoegde record terug
        return [ 'msg' => 'Thread created', 'id' => $lastID ];
    }

    /*
     * Updaten van een bestaande record in de tabel threads
     */
    public static function update()
    {

    }

    /*
     * Verwijderen van een record uit de tabel threads
     */
    public static function destroy()
    {
        //
    }
}
