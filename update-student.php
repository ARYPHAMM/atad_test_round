<?php
include_once "init.php";
include_once _source . "Student.php";
$ob = new Student();
$item = array();
$id = $_REQUEST['id'];
$item = $ob->getItem($id);
if (!is_array($item)) {
  alert("Học viên không tồn tại");
  redirect("list-student.php");
  exit();
}
if (isset($_REQUEST['action']) && ($_REQUEST['action'] == 'create' || $_REQUEST['action'] == 'update')) {
  if ($ob->updateItem()) {
    alert("Lưu thành công");
    sleep(1);
    redirect("list-student.php");
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
      <form action="update-student.php" method="POST" class="form-horizontal  w-100" role="form">
        <div class="form-group">
          <legend>
            <?php
            if (is_null($id)  || empty($id) ) {
              echo "Thêm mới";
            } else {
              echo "Cập nhật";
            } ?>
          </legend>
        </div>
        <input type="hidden" name="id" value="<?php echo $id ?>">
        <input type="hidden" name="action" value="<?php echo is_null($id) ? 'create' : 'update' ?>">
      
        <div class="form-group">
          <label for="">Mã học viên</label>
          <input name="code" type="text" class="form-control" placeholder="Nhập mã học viên" value="<?php echo $_REQUEST['code'] ?? $item['code'] ?>" aria-describedby="helpId">
        </div>
        <div class="form-group">
          <label for="">Họ tên</label>
          <input name="full_name" type="text" class="form-control" placeholder="Nhập mã họ tên" value="<?php echo $_REQUEST['full_name'] ?? $item['full_name'] ?>" aria-describedby="helpId">
        </div>
        <div class="form-group">
          <label for="">Số điện thoại</label>
          <input name="phone_number" type="text" class="form-control" placeholder="Nhập số điện thoại" value="<?php echo $_REQUEST['phone_number'] ?? $item['phone_number'] ?>" aria-describedby="helpId">
        </div>
        <div class="form-group">
          <label for="">Email</label>
          <input name="email" type="text" class="form-control" placeholder="Nhập email" value="<?php echo $_REQUEST['email'] ?? $item['email'] ?>" aria-describedby="helpId">
        </div>
        <div class="form-group">
          <label for="">Giới thiệu bản thân</label>
          <textarea name="description" class="form-control" rows="3" placeholder="Nhập giới thiệu"><?php echo $_REQUEST['description'] ?? $item['description'] ?></textarea>
        </div>
        <div class="form-group">
          <button type="submit" class="btn btn-primary">Lưu</button>
        </div>
      </form>
    </div>
  </div>
</body>

</html>