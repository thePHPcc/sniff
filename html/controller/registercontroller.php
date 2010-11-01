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

class sniffRegisterController extends sniffController {

   public function execute(sniffRequest $request, sniffResponse $response) {
      $db = $this->factory->getDatabase(DSN);
      $res = $db->query(
         'insert into user (USERNAME,PASSWD,EMAIL,NAME) values ("%s","%s","%s","%s")',
         $request->getValue('username'),
         $request->getValue('passwd'),
         $request->getValue('email'),
         $request->getValue('name')
         );
      $msg   = 'Welcome '.$request->getValue('name') . "\n";
      $msg  .= 'Your Login: '.$request->getValue('username') . "\n";
      $msg  .= 'Your Password: '.$request->getValue('passwd') . "\n";
      $msg  .= "\n\nEnjoy your stay!";
      mail($request->getValue('email'), 'welcome to SNIFF', $msg, 'From: housekeeping@sniff.mobile');
      header('Location: /sniff/home?message=Welcome,%20please%20login!',302);
      die();
   }

}