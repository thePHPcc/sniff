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

class sniffLoginController extends sniffController {

   public function execute(sniffRequest $request, sniffResponse $response) {
      $db = $this->factory->getDatabase(DSN);
      if ($request->getValue('sniffUser')) {
         $_SESSION['user'] = unserialize($request->getValue('sniffUser'));
      } else {
         $res = $db->query(
            'select * from user where username="%s" and passwd="%s"',
            $request->getValue('username'),
            $request->getValue('passwd')
         );
         if ($res->num_rows != 1) {
            return new sniffStaticView(__DIR__ . '/../pages/loginfailed.xhtml');
         }
         $_SESSION['user'] =  $res->fetch_object();
         setcookie('sniffUser', serialize($_SESSION['user']),time()+60*60*24*31, '/');
      }
      header('Location: /sniff/main',302);
      die();
   }

}
