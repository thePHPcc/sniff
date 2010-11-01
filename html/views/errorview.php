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

class sniffErrorView implements sniffViewInterface {

   public function render(sniffRequest $request, sniffResponse $response) {
       header('Content-type: text/plain');
       $output = "An Error occoured.\n";
       $output .= print_r($request, true);
       $output .= print_r($response, true);
       return $output;
   }

}