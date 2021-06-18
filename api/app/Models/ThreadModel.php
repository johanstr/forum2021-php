<?php


namespace App\Models;
use App\Database\Database;

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

    public static function create()
    {
        //
    }

    public static function insert()
    {
        //
    }

    public static function update()
    {

    }

    public static function destroy()
    {
        //
    }
}
