<?php require '../header.php'; ?>
<p><?php
echo $_REQUEST['id'];
?>
</p>

<?php
    if($_REQUEST['pass']=='pass') {
      echo 'ログイン成功しました';
  } else {
      echo 'パスワードが違います。';
  }  
    ?>
 <?php require '../footer.php'; ?>
 </body>
 </html>