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

class sniffFrontController {

   protected $factory;
   protected $request;
   protected $response;

   public function __construct(sniffRequest $request, sniffResponse $response, sniffFactory $factory) {
      $this->request  = $request;
      $this->response = $response;
      $this->factory  = $factory;
   }

   public function execute($controllerName) {
      $controller = $this->factory->getController($controllerName);
      return $controller->execute($this->request, $this->response);
   }

}