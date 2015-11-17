<?php

/**
 * SDBW - Simple database wrapper
 * 
 * @package SDBW
 * @author Jaap-Willem Dooge
 * @copyright 2014 Jaap-Willem Dooge
 * @license http://creativecommons.org/licenses/by-sa/4.0/
 * @version 1.0
 * @link https://github.com/DoogeJ/sdbw
 * 
 * SDBW is a simple wrapper for PDO/mysql that I did build to not deal with
 * database code in my other modules.
 * 
 * SDBW is licensed under a Creative Commons Attribution-ShareAlike 4.0 Int.
 * License as readable at http://creativecommons.org/licenses/by-sa/4.0/
 * 
 * This means that you are free to:
 * 
 * Share — copy and redistribute the material in any medium or format
 * 
 * Adapt — remix, transform, and build upon the material
 * 
 * The licensor cannot revoke these freedoms as long as you follow the license
 * terms.
 * 
 * Under the following terms:
 * 
 * Attribution — You must give appropriate credit, provide a link to the
 * license, and indicate if changes were made. You may do so in any reasonable
 * manner, but not in any way that suggests the licensor endorses you or your
 * use.
 * 
 * ShareAlike — If you remix, transform, or build upon the material, you must
 * distribute your contributions under the same license as the original.
 * 
 * No additional restrictions — You may not apply legal terms or technological
 * measures that legally restrict others from doing anything the license
 * permits.
 */
class SDBW {

    private $db_conn;
    private $tablePrefix = '';

    function __construct($hostname, $database, $username, $password) {
        $this->db_conn = new PDO('mysql:host=' . $hostname . ';dbname=' . $database . ';charset=utf8', $username, $password);
    }

    // method for select queries
    public function request($query, $vars) {
        $stmt = $this->db_conn->prepare($query);
        $stmt->execute($vars);

        //return query result
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // method for DM (Data Manipulation) statements
    public function change($query, $vars) {
        $stmt = $this->db_conn->prepare($query);
        $stmt->execute($vars);

        //return affected rows
        return $stmt->rowCount();
    }

    public function getTablePrefix() {
        return $this->tablePrefix;
    }

    public function setTablePrefix($tablePrefix) {
        $this->tablePrefix = $tablePrefix;
        return $this;
    }

}
