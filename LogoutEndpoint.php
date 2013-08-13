<?php

class LogoutEndpoint extends AjaxEndpoint {

  /**
   * Destroys the Facebook session and redirects to the page you were on.
   * @return void
   */
  public function getPayload() {
    $facebook = new Facebook(array(
      'appId' => CONFIG::FB_APP_ID,
      'secret' => CONFIG::FB_APP_SECRET,
    ));
    $facebook->destroySession();
    header("Location: " . $_SERVER['HTTP_REFERER']);
  }

}
