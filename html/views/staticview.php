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

class sniffStaticView implements sniffViewInterface {

   protected $staticFile;

   public function __construct($filename) {
      $this->staticFile = $filename;
   }

   public function render(sniffRequest $request, sniffResponse $response) {
      ob_start();
      include $this->staticFile;
      $html = ob_get_clean();
      return $html;
   }

}