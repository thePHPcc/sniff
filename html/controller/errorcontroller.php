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

class sniffErrorController extends sniffController {

   public function execute(sniffRequest $request, sniffResponse $response) {
       $response->trace = debug_backtrace();
       $response->error = 'An Error occoured:';
       return new sniffErrorView();
   }
}