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

class sniffFactory {

   protected $defaultController = 'sniffErrorController';

   public function setDefaultController($default) {
      $this->defaultController = $default;
   }

   public function getController($name) {
      $name = 'sniff' . ucfirst($name).'Controller';
      if (!class_exists($name)) {
         return new $this->defaultController($this);
      }
      return new $name($this);
   }

   public function getDatabase($dsn) {
      return new sniffDatabase($dsn);
   }
}