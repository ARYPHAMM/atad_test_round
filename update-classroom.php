<?php
include_once "init.php";
include_once _source . "Classroom.php";
$ob = new Classroom();
$item = array();
$id = $_REQUEST['id'];
$item = $ob->getItem($id);
if (!is_array($item)) {
  alert("Học viên không tồn tại");
  redirect("list-classroom.php");
  exit();
}
if (isset($_REQUEST['action']) && ($_REQUEST['action'] == 'create' || $_REQUEST['action'] == 'update')) {
  if ($ob->updateItem()) {
    alert("Lưu thành công");
    sleep(1);
    redirect("list-classroom.php");
  }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
</head>

<body>
  <div class="container">
    <div class="row">
      <form action="update-classroom.php" method="POST" class="form-horizontal  w-100" role="form">
        <div class="form-group">
          <legend>
            <?php
            if (is_null($id) || empty($id)) {
              echo "Thêm mới";
            } else {
              echo "Cập nhật";
            } ?>
          </legend>
        </div>
        <input type="hidden" name="id" value="<?php echo $id ?>">
        <input type="hidden" name="action" value="<?php echo is_null($id) ? 'create' : 'update' ?>">
       
        <div class="form-group">
          <label for="">Mã lớp học</label>
          <input name="code" type="text" class="form-control" placeholder="Nhập mã lớp học" value="<?php echo $_REQUEST['code'] ?? $item['code'] ?>" aria-describedby="helpId">
        </div>
        <div class="form-group">
          <label for="">Tên lớp</label>
          <input name="name" type="text" class="form-control" placeholder="Nhập mã tên lớp" value="<?php echo $_REQUEST['name'] ?? $item['name'] ?>" aria-describedby="helpId">
        </div>
       
        <div class="form-group">
          <button type="submit" class="btn btn-primary">Lưu</button>
        </div>
      </form>
    </div>
  </div>
</body>

</html>