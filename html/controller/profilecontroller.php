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

class sniffProfileController extends sniffController {

   protected $viewFile =  '/../pages/profile.xhtml';

   public function execute(sniffRequest $request, sniffResponse $response) {
      $db = $this->factory->getDatabase(DSN);
      if ($request->getValue('login')) {
         $res = $db->query(
            'select * from user where USERNAME="%s"',
            $request->getValue('login')
         );
         $response->profile = $res->fetch_object();
      } else {
         $response->profile = $request->getValue('user');
      }

      return new sniffStaticView(__DIR__ . $this->viewFile);
   }

}