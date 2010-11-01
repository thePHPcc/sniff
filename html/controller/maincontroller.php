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

class sniffMainController extends sniffController {

   public function execute(sniffRequest $request, sniffResponse $response) {
      $db = $this->factory->getDatabase(DSN);
      $res = $db->query(
         'select * from user where UID in (select FRIEND from friends where UID="%s")',
         $request->getValue('user')->UID
      );
      $friends = array();
      while ($tmp = $res->fetch_object()) {
         $friends[] = $tmp;
      }
      $response->FRIENDS = $friends;

      return new sniffStaticView(__DIR__ . '/../pages/main.xhtml');
   }

}