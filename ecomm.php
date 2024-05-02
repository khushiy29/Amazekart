<?php
$servername = "db4free.net";
$username = "ecomtest";
$password = "ecomtest@1234#";

$conn = new mysqli($servername, $username, $password);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$conn->query('use ecomtest');

$data = array();
$data['result'] = 'success';
$data['reason'] = '';

$func = $_POST['func'] ?? '';

if ($func == 'showimage') {
    $q = "SELECT * FROM `Product`";
    $res = $conn->query($q);

    $data = array();
    while ($row = mysqli_fetch_assoc($res)) {
        $data[] = $row;
    }

    echo json_encode($data);
} 
elseif ($func == 'addtocart') {
    $productID = $_POST['productID'] ?? '';
    $quantity = $_POST['quantity'];

    if ($productID !== '') {
        $q = "SELECT productID FROM Cart WHERE productID = '$productID'";
        $res = $conn->query($q);

        if ($res->num_rows == 0) {
            $q = "INSERT INTO Cart (`productID`) VALUES ('$productID')";
            $conn->query($q);

            $q1 = "UPDATE Product SET quantity='$quantity' WHERE productID='$productID'";
            $conn->query($q1);

            $data['result'] = 'success';
            $data['reason'] = 'Product inserted in cart successfully';
        } else {
            $data['result'] = 'failed';
            $data['reason'] = 'Product already exists';
        }
        $res->close();
    } else {
        $data['result'] = 'failed';
        $data['reason'] = 'Product ID not provided';
    }
    echo json_encode($data);
} 
elseif ($func == 'getlistprod') {
    $q = "SELECT * FROM Cart AS a
            LEFT JOIN  Product AS b
            ON a.productID = b.productID";

    $res = $conn->query($q);
    $data = array();
    while ($row = mysqli_fetch_assoc($res)) {
        $data[] = $row;
    }
    echo json_encode($data);
}
elseif ($func == 'getlistcat') {
    $catID = $_POST['selectedCategory'] ?? '';

    if ($catID !== '') {
        $q = "SELECT * FROM Product WHERE categoryID=$catID";
        $res = $conn->query($q);
        $data = array();
        while ($row = mysqli_fetch_assoc($res)) {
            $data[] = $row;
        }
        echo json_encode($data);
    } else {
        $data['result'] = 'failed';
        $data['reason'] = 'Category ID not provided';

        header('Content-Type: application/json'); // Add Content-Type header
        echo json_encode($data);
    }
} 
elseif ($func == 'getlistsubcat') {
    $q = "SELECT * FROM Product WHERE subcategoryID=30";
    $res = $conn->query($q);
    $data = array();
    while ($row = mysqli_fetch_assoc($res)) {
        $data[] = $row;
    }

    header('Content-Type: application/json'); // Add Content-Type header
    echo json_encode($data);
} elseif ($func == 'updbook') {
    $srno = $_POST['srno'] ?? '';
    $qty = $_POST['qty'] ?? '';
    $quantity = $_POST['quantity'] ?? '';

    if ($srno !== '' && $qty !== '' && $quantity !== '') {
        $q = "UPDATE Cart SET `qty`='$qty' WHERE `cartID`='$srno'";
        $res = $conn->query($q);
        $q1 = "UPDATE Product a left join Cart b on a.productID = b.productID  SET `quantity`='$quantity' WHERE `cartID`='$srno'";
        $res1 = $conn->query($q1);

        $data['result'] = 'success';
        $data['reason'] = 'Book updated successfully';
    } else {
        $data['result'] = 'failed';
        $data['reason'] = 'Incomplete parameters';
    }

    header('Content-Type: application/json'); // Add Content-Type header
    echo json_encode($data);
} elseif ($func == 'delbook') {
    $srno = $_POST['srno'] ?? '';

    if ($srno !== '') {
        $q = "DELETE FROM Cart where cartID = '$srno'";
        $conn->query($q);

        $data['result'] = 'success';
        $data['reason'] = 'Book deleted successfully';
    } else {
        $data['result'] = 'failed';
        $data['reason'] = 'Cart ID not provided';
    }

    header('Content-Type: application/json'); // Add Content-Type header
    echo json_encode($data);
} else {
    $data['result'] = 'failed';
    $data['reason'] = 'Invalid function';

    header('Content-Type: application/json'); // Add Content-Type header
    echo json_encode($data);
}
?>