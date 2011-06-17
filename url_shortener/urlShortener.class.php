<?php
/**
 * This class create a shorter string. 
 *
 * Author: Boris Morel <morel.boris@orange.fr>
 */

class UrlShortener
{
  private static $rangeStr = "abcdefghijklmnopqrstuvwxyz";
  private static $rangeInt = "0123456789";

  private static $singleton;

  private
    $shuffle,
    $length;

  public function getInstance()
  {
    if(!isset(static::$singleton))
      static::$singleton = new static();

    return static::$singleton;
  }

  private function __construct()
  {
    $this->toShake();
  }

  public function toShake()
  {
    $this->shuffle = str_shuffle(
      str_shuffle(self::$rangeStr)
      .str_shuffle(strtoupper(self::$rangeStr))
      .str_shuffle(self::$rangeInt)
    );
    
    return $this;
  }

  public function setLength($length)
  {
    $this->length = $length;
    
    return $this;
  }

  public function run()
  {
    return $this->doRun();
  }

  private function doRun()
  {
    if(!$this->length)
      throw new Exception('length is mandatory ; please use setLength()');

    $rand = '';

    for($i=0 ; $i < $this->length ; $i++)
      {
        $rand .= $this->getRandomChar();
      }

    return $rand;
  }

  private function getRandomChar()
  {
    $limit = strlen($this->shuffle) - 1;

    return $this->shuffle[rand(0,(int)$limit)];
  }
}