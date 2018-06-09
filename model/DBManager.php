<?php
  class DBManager {
    private static $db = null;
    public static function getConnection()
        {
          $HOST_NAME = "localhost";
        	$DB_NAME = "bbmsyste_catc";
        	$CHAR_SET = "charset=utf8"; // เช็ตให้อ่านภาษาไทยได้

        	$USERNAME = "bbmsyste_boriwat";     // ตั้งค่าตามการใช้งานจริง
        	$PASSWORD = "Ibomba123";  // ตั้งค่าตามการใช้งานจริง
        	try {
        		$db = new PDO('mysql:host='.$HOST_NAME.';dbname='.$DB_NAME.';'.$CHAR_SET,$USERNAME,$PASSWORD);
        	} catch (PDOException $e) {
        		echo "ไม่สามารถเชื่อมต่อฐานข้อมูลได้ : ".$e->getMessage();
        	}
          return $db ;
        }
  }
 ?>
