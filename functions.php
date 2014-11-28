<?php

  require_once('wufoo/WufooApiWrapper.php');

  function wufoo_post() {
    
    $data       = wufoo_sanitize($_POST['fields']);
    $api_key    = 'XXXX-XXXX-XXXX-XXXX';
    $form_hash  = 'abcdefghijkl';
    $wufoo_id   = 'my_wufoo_id';
    
    $api        = new WufooApiWrapper($api_key, $wufoo_id);
    $response   = $api->entryPost($form_hash, $data);
    
    header('Content-Type: application/json');
    exit(json_encode($resp));
    
  }

  function wufoo_sanitize($arg) {

    $post_data  = urldecode($arg);
    $arr        = explode('&', $post_data);
    $new_arr    = array();
    $wufoo_arr  = array();

    foreach($arr as $val) {
      $val_arr              = explode('=', $val);
      $new_arr[$val_arr[0]] = $val_arr[1];
    }

    foreach ($new_arr as $key => $value) {
      array_push($wufoo_arr, new WufooSubmitField($key, $value));
    }

    return $wufoo_arr;
    
  }

  add_action('wp_ajax_wufoo_post', 'wufoo_post');
  add_action('wp_ajax_nopriv_wufoo_post', 'wufoo_post');

?>
