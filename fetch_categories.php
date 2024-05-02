<?php

$host = 'db4free.net'; // Replace with your host name
$username = 'ecomtest'; // Replace with your MySQL username
$password = 'ecomtest@1234#'; // Replace with your MySQL password
$database = 'ecomtest'; // Replace with your MySQL database name

// Establish the MySQL connection
$connection = mysqli_connect($host, $username, $password, $database);

// Check if the connection was successful
if (!$connection) {
  die('Failed to connect to MySQL: ' . mysqli_connect_error());
}

// Fetch the action parameter from the request
$action = $_GET['action'];

// Handle the action based on the request
if ($action === 'fetch_main_categories') {
  fetchMainCategories();
} elseif ($action === 'fetch_sub_categories') {
  $mainCategory = $_GET['mainCategory'];
  fetchSubCategories($mainCategory);
} elseif ($_SERVER['REQUEST_METHOD'] === 'POST') {
  // Handle form submission and database insertion
  $aksinCode = $_POST['aksin-code'];
  $productName = $_POST['product-name'];
  $productBrand = $_POST['product-brand'];
  $productPrice = $_POST['product-price'];
  $productMainCategory = $_POST['main-category'];
  $productSubCategory = $_POST['sub-category'];
  $productQuantity = $_POST['product-quantity'];

  if (
    $aksinCode === "" ||
    $productName === "" ||
    $productBrand === "" ||
    $productPrice === "" ||
    $productMainCategory === "None" ||
    $productSubCategory === "None" ||
    $productQuantity === ""
  ) {
    echo "Please enter all the product details!";
  } else {
    // Perform database insertion
    $sql = "INSERT INTO products (aksin_code, product_name, product_brand, product_price, main_category, sub_category, product_quantity) VALUES ('$aksinCode', '$productName', '$productBrand', '$productPrice', '$productMainCategory', '$productSubCategory', '$productQuantity')";

    if (mysqli_query($connection, $sql)) {
      echo "Product added successfully";
    } else {
      echo "Error: " . mysqli_error($connection);
    }
  }
} else {
  // Invalid action parameter
  echo 'Invalid action';
}

// Function to fetch main categories
function fetchMainCategories() {
  global $connection;

  // Perform the MySQL query to fetch main categories
  $query = "SELECT categoryname FROM Category";
  $result = mysqli_query($connection, $query);

  if ($result) {
    $mainCategories = array();

    // Fetch the main categories and store them in an array
    while ($row = mysqli_fetch_assoc($result)) {
      $mainCategories[] = $row['categoryname'];
    }

    // Send the main categories as a JSON response
    header('Content-Type: application/json');
    echo json_encode($mainCategories);
  } else {
    // Error occurred during the query
    echo 'error';
  }
}

// Function to fetch sub categories based on the selected main category
function fetchSubCategories($mainCategory) {
  global $connection;

  // Perform the MySQL query to fetch sub categories based on the selected main category
  $query = "SELECT subcategory FROM subcategory WHERE categoryname = '$mainCategory'";
  $result = mysqli_query($connection, $query);

  if ($result) {
    $subCategories = array();

    // Fetch the sub categories and store them in an array
    while ($row = mysqli_fetch_assoc($result)) {
      $subCategories[] = $row['subcategory'];
    }

    // Send the sub categories as a JSON response
    header('Content-Type: application/json');
    echo json_encode($subCategories);
  } else {
    // Error occurred during the query
    echo 'error';
  }
}


$subcategory = '';
$maincategory = '';
$aksincode = '';
$productname = '';
$productbrand = '';
$productprice = '';
$productquantity ='';
$description1='';
$description2='';
$description3='';
$description4='';
$description5='';
$description6='';
$description7='';
$description8='';
$subdescription1='';
$subdescription2='';
$subdescription3='';
$subdescription4='';
$subdescription5='';
$subdescription6='';
$subdescription7='';
$subdescription8='';
$mainimage='';
$image2='';
$image3='';
$image4='';
$image5='';

$func = $_POST['func'];



if ($func == 'add1'){

    $subcategory = $_POST['subcategory'];
     $maincategory = $_POST['maincategory'];
     $aksincode = $_POST['aksincode'];
     $productname = $_POST['productname'];
     $productbrand = $_POST['productbrand'];
     $productprice = $_POST['productprice'];
     $productquantity = $_POST['productquantity'];
}

if ($func == 'add2'){

  $description1 = $_POST['description1'];
   $description2 = $_POST['description2'];
   $description3 = $_POST['description3'];
   $description4 = $_POST['description4'];
   $description5 = $_POST['description5'];
   $description6 = $_POST['description6'];
   $description7 = $_POST['description7'];
   $description8 = $_POST['description8'];
}

if ($func == 'add3'){

  $subdescription1 = $_POST['subdescription1'];
   $subdescription2 = $_POST['subdescription2'];
   $subdescription3 = $_POST['subdescription3'];
   $subdescription4 = $_POST['subdescription4'];
   $subdescription5 = $_POST['subdescription5'];
   $subdescription6 = $_POST['subdescription6'];
   $subdescription7 = $_POST['subdescription7'];
   $subdescription8 = $_POST['subdescription8'];

}

if ($func == 'add4'){

  $mainimage = $_POST['mainimage'];
   $image2 = $_POST['image2'];
   $image3 = $_POST['image3'];
   $image4 = $_POST['image4'];
   $image5 = $_POST['image5'];


}





// Close the MySQL connection
mysqli_close($connection);
?>
