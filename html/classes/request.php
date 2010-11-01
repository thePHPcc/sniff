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

class sniffRequest {

   protected $input;
   protected $params;

   public function __construct(Array $request, Array $session) {
      $this->input = $request;
      $this->session = $session;
   }

   public function setParams(Array $params) {
      $this->params = $params;
   }

   public function getValue($key) {
      if (isset($this->input[$key])) {
         return $this->input[$key];
      }

      if (isset($this->session[$key])) {
         return $this->session[$key];
      }

      if (isset($this->params[$key])) {
         return $this->params[$key];
      }

      return null;
   }


}