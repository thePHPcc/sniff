<?php

/**
 * This code is part of the sniff security demo application
 *
 * *** DO NOT USE IN ANY TYPE OF PRODUCTION ***
 *
 * The application is stripped down and contains various security issues to be found
 * by course attendees. It is not ment to be used as an actual social network or a
 * base for one.
 *
 * @author Arne Blankerts <arne@thephp.cc>
 * @copyright 2010 thePHP.cc - the PHP consulting company, Germany
 *
 */

class sniffResponse {

   protected $data = array();

   public function __set($key, $value) {
      $this->data[$key] = $value;
   }

   public function __get($key) {
      if (!isset($this->data[$key])) {
         throw new sniffResponseException("Key '$key' does not exist");
      }
      return $this->data[$key];
   }

   public function __isset($key) {
      return isset($this->data[$key]);
   }

}


class sniffResponseException extends Exception {
}