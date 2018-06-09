<?php
  class Util{
    public static function getInt($val)
    {
      return ($val!=null && $val!="")?$val:0;
    }

    public static function getIntDefine($val,$define)
    {
      return ($val!=null && $val!="")?$val:$define;
    }

    public static function getStr($val)
    {
      return ($val!=null)?$val:"";
    }

    public static function getStrDefine($val,$define)
    {
      return ($val!=null)?$val:$define;
    }
  }
?>
