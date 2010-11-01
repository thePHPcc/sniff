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

abstract class sniffController {

   protected $factory;

   public function __construct(sniffFactory $factory) {
      $this->factory = $factory;
   }

   abstract public function execute(sniffRequest $request, sniffResponse $response);
}