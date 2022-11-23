<?php
//declared namespace user
namespace user;

session_start();

if (!isset($_SESSION['cart'])) {
  $_SESSION['cart'] = [];
}
?>
<?php
//created class operations
class operations
{
  //function for adding products  to cart 
  function add($id)
  {
    include 'config.php';

    $c = 0;
    foreach ($_SESSION['cart'] as $k1 => $v1) {
      if ($v1['id'] == $id) {
        $c = 1;
      }
    }
    if ($c == 0) {
      foreach ($products as $k => $v) {
        if ($v['id'] == $id) {
          array_push($_SESSION['cart'], $v);
        }
      }
    }
    if ($c == 1) {

      foreach ($_SESSION['cart'] as $k1 => $v1) {
        if ($v1['id'] == $id) {
          $_SESSION['cart'][$k1]['q'] += 1;
        }
      }
    }
    echo json_encode($_SESSION['cart']);
  }
  //function for delete items  from cart 
  function del($id)
  {
    array_splice($_SESSION['cart'], $id, 1);
    echo json_encode($_SESSION['cart']);
  }
  //function for increase quantity in cart
  function inc($id)
  {
    $_SESSION['cart'][$id]['q'] += 1;
    echo json_encode($_SESSION['cart']);
  }
  //function for decrease quantity in cart
  function dec($id)
  {
    if ($_SESSION['cart'][$id]['q'] > 1) {
      $_SESSION['cart'][$id]['q'] -= 1;
    } else {
      if ($_SESSION['cart'][$id]['q'] <= 1) {
        array_splice($_SESSION['cart'], $id, 1);
      }
    }
    echo json_encode($_SESSION['cart']);
  }
  //function to empty cart
  function empty()
  {
    $_SESSION['cart'] = [];
    echo json_encode($_SESSION['cart']);
  }
}
?>