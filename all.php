<?php

$host = 'db4free.net';
$username = 'ecomtest';
$password = 'ecomtest@1234#';
$database = 'ecomtest';

$connection = mysqli_connect($host, $username, $password, $database);

if (!$connection) {
  die('Failed to connect to MySQL: ' . mysqli_connect_error());
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $func = $_POST['func'];

  if ($func === 'login') {
    $phoneNumber = $_POST['phone_number'];
    $phoneNumber = mysqli_real_escape_string($connection, $phoneNumber);

    $query = "SELECT name FROM user WHERE mobile = '$phoneNumber'";
    $result = mysqli_query($connection, $query);

    if ($result) {
      $row = mysqli_fetch_assoc($result);
      if ($row) {
        $username = $row['name'];
        echo $username;
      } else {
        echo 'not_exists';
      }
    } else {
      echo 'error';
    }
  } elseif ($func === 'register') {
    $username = $_POST['username'];
    $phoneNumber = $_POST['phone_number'];
    $password = $_POST['password'];

    $username = mysqli_real_escape_string($connection, $username);
    $phoneNumber = mysqli_real_escape_string($connection, $phoneNumber);
    $password = mysqli_real_escape_string($connection, $password);

    $query = "SELECT name FROM user WHERE mobile = '$phoneNumber'";
    $result = mysqli_query($connection, $query);

    if ($result) {
      $row = mysqli_fetch_assoc($result);
      if ($row) {
        echo 'user_exists';
      } else {
        $insertQuery = "INSERT INTO user (name, mobile, password) VALUES ('$username', '$phoneNumber', '$password')";
        $insertResult = mysqli_query($connection, $insertQuery);

        if ($insertResult) {
          echo 'success';
        } else {
          echo 'error';
        }
      }
    } else {
      echo 'error';
    }
  } elseif ($func === 'vendorlogin') {
    $phoneNumber = $_POST['phone_number'];
    $phoneNumber = mysqli_real_escape_string($connection, $phoneNumber);

    $query = "SELECT name FROM vendor WHERE mobile = '$phoneNumber'";
    $result = mysqli_query($connection, $query);

    if ($result) {
      $row = mysqli_fetch_assoc($result);
      if ($row) {
        $username = $row['name'];
        echo $username;
      } else {
        echo 'not_exists';
      }
    } else {
      echo 'error';
    }
  } elseif ($func === 'registerVendor') {
    $username = $_POST['username'];
    $phoneNumber = $_POST['phone_number'];
    $password = $_POST['password'];
    $gstNumber = $_POST['gst_number'];
    $panNumber = $_POST['pan_number'];
    $bankName = $_POST['bank_name'];
    $accountName = $_POST['account_name'];
    $accountNumber = $_POST['account_number'];
    $bankIFSC = $_POST['bank_ifsc'];
    $businessName = $_POST['business_name'];
    $businessAddress = $_POST['business_address'];
    $businessPhone = $_POST['business_phone'];
    $businessEmail = $_POST['business_email'];

    $username = mysqli_real_escape_string($connection, $username);
    $phoneNumber = mysqli_real_escape_string($connection, $phoneNumber);
    $password = mysqli_real_escape_string($connection, $password);
    $gstNumber = mysqli_real_escape_string($connection, $gstNumber);
    $panNumber = mysqli_real_escape_string($connection, $panNumber);
    $bankName = mysqli_real_escape_string($connection, $bankName);
    $accountNumber = mysqli_real_escape_string($connection, $accountNumber);
    $bankIFSC = mysqli_real_escape_string($connection, $bankIFSC);
    $businessName = mysqli_real_escape_string($connection, $businessName);
    $businessAddress = mysqli_real_escape_string($connection, $businessAddress);
    $businessPhone = mysqli_real_escape_string($connection, $businessPhone);
    $businessEmail = mysqli_real_escape_string($connection, $businessEmail);

    $checkQuery = "SELECT name FROM vendor WHERE mobile = '$phoneNumber'";
    $checkResult = mysqli_query($connection, $checkQuery);

    if ($checkResult) {
      $row = mysqli_fetch_assoc($checkResult);
      if ($row) {
        echo 'user_exists';
      } else {
        $insertQuery = "INSERT INTO vendor (name, mobile, password, gst, pan, bankname, accountname, accountno, ifsc, businessname, businessadd, businessphone, businessemail) 
                        VALUES ('$username', '$phoneNumber', '$password', '$gstNumber', '$panNumber', '$bankName','$accountName', '$accountNumber', '$bankIFSC', '$businessName', '$businessAddress', '$businessPhone', '$businessEmail')";
        $insertResult = mysqli_query($connection, $insertQuery);

        if ($insertResult) {
          echo 'success';
        } else {
          echo 'error';
        }
      }
    } else {
      echo 'error';
    }
  }
}

mysqli_close($connection);
?>
