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

class sniffProfileupdateController extends sniffController {

   public function execute(sniffRequest $request, sniffResponse $response) {
      $db = $this->factory->getDatabase(DSN);
      if (isset($_FILES['PICTURE'])) {
         $picture = basename($_FILES['PICTURE']['name']);
         $path    = __DIR__.'/../pictures/' .  $request->getValue('user')->UID;
         if (!file_exists($path)) {
            mkdir($path);
         }
         move_uploaded_file($_FILES['PICTURE']['tmp_name'], $path . '/' . $picture);
         $res = $db->query(
            'update user set PICTURE="%s" where UID=%s',
            $picture,
            $request->getValue('UID')
         );
      }

      $res = $db->query(
         'update user set NAME="%s", EMAIL="%s", DESCR="%s" where UID=%s',
         $request->getValue('NAME'),
         $request->getValue('EMAIL'),
         $request->getValue('DESCR'),
         $request->getValue('UID')
      );

      $res = $db->query('select * from user where UID=%s', $request->getValue('user')->UID);
      $_SESSION['user'] = $res->fetch_object();
      header('Location: /sniff/main?message=Saved%20successfully',302);
      die();
   }

}