<?php
include_once "init.php";
include_once _source . "Classroom.php";
$ob = new Classroom();
$items = $ob->getItems();
if (isset($_REQUEST['action']) && $_REQUEST['action'] == 'delete') {
  if ($ob->removeItem($_REQUEST['id'])) {
    alert("Xoá thành công");
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
    <div class="row w-100 justify-content-center">
      <?php include(_layout . "header.php") ?>
    </div>
  </div>
  <div class="container">
    <div class="row">
      <a href="update-classroom.php?id=" class="btn btn-success mb-1">
        Thêm mới
      </a>
      <table class="table table-bordered table-hover">
        <thead>
          <tr>
            <th>STT</th>
            <th>Mã số</th>
            <th>Tên</th>
            <th>
            </th>
          </tr>
        </thead>
        <tbody>
          <?php foreach ($items as $key => $item) { ?>
            <tr>
              <td><?php echo $key + 1 ?></td>
              <td><?php echo $item['code'] ?></td>
              <td><?php echo $item['name'] ?></td>
              <td>
                <a class="btn btn-warning my-1" href="update-classroom.php?id=<?php echo $item['id'] ?>">
                  Sửa</a>
                <a class="btn btn-danger" href="list-classroom.php?action=delete&id=<?php echo $item['id'] ?>">
                  Xoá
                </a>
              </td>
            </tr>
          <?php } ?>
        </tbody>
      </table>
    </div>
  </div>
</body>

</html>