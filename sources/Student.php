<?php
class Student
{
  private $object = ["code", "email", "full_name", "phone_number", "description"];
  private $table = "students";
  public function getItems()
  {
    $items = getItems("select * from {$this->table}");
    return $items;
  }
  public function getItem($id = null)
  {
    $item = [];
    if (is_null($id) || empty($id))
      $item = $this->object;
    else {
      $item = getItem("select * from {$this->table} where id like '{$id}'");
    }
    return $item;
  }
  public function removeItem($id = null)
  {
    $item = removeItem("delete from {$this->table} where id like '{$id}'");
    return $item;
  }
  public function updateItem()
  {
    $data = $this->object;
    $data[] = 'id';
    if (@$_POST['id'] != "")
      $condition = "where id like '{$_POST['id']}'";
    if (saveItem(array("table" => $this->table, "data" => $data, "condition" => @$condition))) {
      return true;
    }
  }
}
