<?php require '../header.php'; ?>
<style>
    p {
      color: red;
      font-size: 20px;
    }
  </style>
<p>
  <?php
  echo 'ID:',$_REQUEST['id'],'さん'; //test
  ?>
</p>

<?php
if ($_REQUEST['pass'] == 'pass') {
  echo 'ログイン成功しました';
} else {
  echo '<p>',$_REQUEST['id'],'さんのパスワードは違います。</p>';
}
?>
<?php require '../footer.php'; ?>
</body>

</html>