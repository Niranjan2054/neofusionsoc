<?php 
  include $_SERVER['DOCUMENT_ROOT'].'config/init.php';
  // debugger($_FILES,true);
  // debugger($_POST);
  $busfair = new busfair();
  if ((isset($_POST) && !empty($_POST)) || (isset($_FILES) && !empty($_FILES))) {
    // debugger($data);
    if (isset($_FILES) && !empty($_FILES) && !empty($_FILES['csv']) && $_FILES['csv']['error'] == 0) {
      $file_content = json_decode(file_get_contents('e:/'.$_FILES['csv']['name']));
      if ($file_content) {
        foreach ($file_content as $key => $each_content) {
          $data = array(
            'yourplace' => $each_content->from,
            'destination' => $each_content->to,
            'fee' => $each_content->fee,
          );
          $busfairs = $busfair->addBusFair($data);
        }
      }
    }
    // debugger($data,true);
    if (isset($_POST['id']) && !empty($_POST['id'])) {
      $busfair_id = $_POST['id'];
    }
    if (isset($busfair_id) && !empty($busfair_id)) {
      $act = 'updat';
      $data = array(
            'yourplace' => sanitize($_POST['yourplace']),
            'destination' => sanitize($_POST['destination']),
            'fee' => (int)$_POST['fee'],
          );
      $busfairs = $busfair->updatebusfair($data,(int)$_POST['id']);
    }else{
      $act = "add";
    }
    echo $busfairs;
    if ($busfairs) {
      setFlash('../busfair','success','BusFair '.$act.'ed Successfully');
    }else{
      setFlash('../busfair','error','Error While Adding To Database');
    }
  }else if(isset($_GET) && !empty($_GET)){
    if (isset($_GET['id']) && !empty($_GET['id']) && $_GET['id']>0) {
      $act = substr(md5('BusFair-'.$_GET['id'].'-'.$_SESSION['token']),3,15);
      if (isset($_GET['act']) && !empty($_GET['act']) && $act == $_GET['act']) {
        $busfair_id = (int)$_GET['id'];
        $BusFair_info = $busfair->getBusFairById($busfair_id);
        if ($BusFair_info) {
          $success = $busfair->deleteBusFairbyId($BusFair_info[0]->id);
          if ($success) {
            setFlash('../busfair','success','BusFair Deleted Successfully');
          }else{
            setFlash('../busfair','error','Error While Deleting BusFair');
          }
        }else{
          setFlash('../busfair','error','BusFair Not found.');
        }

      }else{
        setFlash('../busfair','error','Error unknown access to delete');
      }
    }else{
      setFlash('../busfair','error','Invalid Id.');
    }
  }
  else{
    setFlash('../busfair','error','Unauthorized Access');
  }
?>