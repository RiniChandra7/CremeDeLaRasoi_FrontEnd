<?php
start_session();
if(isset($_POST['qty'])){
  $qty = $_POST['qty']; 
    $_SESSION['UserName'] = $qty;
  }
}else{
  echo "What the hell are you doing?";
}
?>