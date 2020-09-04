<?php
  /***************************************************
   * Only these origins are allowed to upload images *
   ***************************************************/
  $accepted_origins = array("http://127.0.0.1:8000");

  /*********************************************
   * Change this line to set the upload folder *
   *********************************************/
  $imageFolder = "../storage/image/moreInfo/";

  reset ($_FILES);
  $temp = current($_FILES);
  if (is_uploaded_file($temp['tmp_name'])){
    if (isset($_SERVER['HTTP_ORIGIN'])) {
      // same-origin requests won't set an origin. If the origin is set, it must be valid.
      if (in_array($_SERVER['HTTP_ORIGIN'], $accepted_origins)) {
        header('Access-Control-Allow-Origin: ' . $_SERVER['HTTP_ORIGIN']);
      } else {
        header("HTTP/1.1 403 Origin Denied");
        return;
      }
    }

    /*
      If your script needs to receive cookies, set images_upload_credentials : true in
      the configuration and enable the following two headers.
    */
    // header('Access-Control-Allow-Credentials: true');
    // header('P3P: CP="There is no P3P policy."');

    // Sanitize input
    /*
      if (preg_match("/([^\w\s\d\-_~,;:\[\]\(\).])|([\.]{2,})/", $temp['name'])) {
          header("HTTP/1.1 400 Invalid file name.");
          return;
      }
    */

    // Verify extension

    $ext = strtolower(pathinfo($temp['name'], PATHINFO_EXTENSION));

    if (!in_array($ext, array("gif", "jpg", "png", "jpeg"))) {
      header("HTTP/1.1 400");
      exit("副檔名只允許gif、jpg、png及jpeg") ;
    }

    // Verify File Size
    if(filesize($temp['tmp_name']) > 1024 * 1024) {
      header("HTTP/1.1 400");
      exit("圖檔大小必須小於1MB");
    }

    // Accept upload if there was no origin, or if it is an accepted origin
    $filetowrite = $imageFolder . strtotime("now").".".$ext;
    move_uploaded_file($temp['tmp_name'], $filetowrite);

    // Respond to the successful upload with JSON.
    // Use a location key to specify the path to the saved image resource.
    // { location : '/your/uploaded/image/file'}
    echo json_encode(array('location' => $filetowrite));
  } else {
    // Notify editor that the upload failed
    header("HTTP/1.1 500 Server Error");
  }
?>