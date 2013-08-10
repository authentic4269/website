<?php

abstract class AjaxEndpoint extends WebObject {

  private $request;

  public function __construct($request) {
    $this->request = $request;
    parent::__construct();
  }

  /**
   * Entry point for the async request.
   * @return string The payload (markup, etc.)
   */
  abstract public function getPayload();
}
