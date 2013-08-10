<?php

class UpdateBrotherEndpoint extends AjaxEndpoint {

  /**
   * Validates the form, dispatches the email, and renders the payload.
   * @return string The inner content markup.
   */
  public function getPayload() {
    if ($this->isAdmin()) {
      return null;
    }

    $stmt = $this->mysqli->prepare(
      "UPDATE brothers SET image = ? WHERE fbid = ?"
    );

    $id = filter_var($_POST['fbid'], FILTER_SANITIZE_STRING);

    if (!$id) {
      return null;
    }

    $newimage = WebBrothersController::getProfilePicture($id);
    $stmt->bind_param("ss", $newimage, $id);
    $stmt->execute();
    $stmt->close();

    WebBrothersController::saveImage($id);

    return "success";
  }

}
