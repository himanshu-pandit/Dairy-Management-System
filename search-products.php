<?php
session_start();
//error_reporting(0);
include('includes/config.php');
if (strlen($_SESSION['aid']==0)) {
  header('location:logout.php');
  } else{
//code for Cart
if(!empty($_GET["action"])) {
switch($_GET["action"]) {

//code for adding product in cart
    case "add":
        if(!empty($_POST["quantity"])) {
            $pid=$_GET["pid"];
            $result=mysqli_query($con,"SELECT * FROM tblproducts WHERE id='$pid'");
              while($productByCode=mysqli_fetch_array($result)){
            $itemArray = array($productByCode["id"]=>array('catname'=>$productByCode["CategoryName"], 'compname'=>$productByCode["CompanyName"], 'quantity'=>$_POST["quantity"], 'pname'=>$productByCode["ProductName"], 'price'=>$productByCode["ProductPrice"],'code'=>$productByCode["id"]));
            if(!empty($_SESSION["cart_item"])) {
                if(in_array($productByCode["id"],array_keys($_SESSION["cart_item"]))) {
                    foreach($_SESSION["cart_item"] as $k => $v) {
                        if($productByCode["id"] == $k) {
                            if(empty($_SESSION["cart_item"][$k]["quantity"])) {
                                $_SESSION["cart_item"][$k]["quantity"] = 0;
                            }
                            $_SESSION["cart_item"][$k]["quantity"] = $_POST["quantity"];
                        }
                        
                    }
                } 
                else {
                    $_SESSION["cart_item"] = array_merge($_SESSION["cart_item"],$itemArray);
                }
            }  
            else {
                $_SESSION["cart_item"] = $itemArray;
            }
        }
    }
    break;

    // code for removing product from cart
    case "remove":
        if(!empty($_SESSION["cart_item"])) {
            foreach($_SESSION["cart_item"] as $k => $v) {
                    if($_GET["code"] == $k)
                        unset($_SESSION["cart_item"][$k]);              
                    if(empty($_SESSION["cart_item"]))
                        unset($_SESSION["cart_item"]);
            }
        }
    break;
    // code for if cart is empty
    case "empty":
        unset($_SESSION["cart_item"]);
    break;  
}
}

//Code for Checkout
if(isset($_POST['checkout'])){
    $invoiceno= mt_rand(100000000, 999999999);
    $pid=$_SESSION['productid'];
    $quantity=$_POST['quantity'];
    $cname=$_POST['customername'];
    $cmobileno=$_POST['mobileno'];
    $pmode=$_POST['paymentmode'];
    $value=array_combine($pid,$quantity);
    foreach($value as $pdid=> $qty){
        $query=mysqli_query($con,"insert into tblorders(ProductId,Quantity,InvoiceNumber,CustomerName,CustomerContactNo,PaymentMode) values('$pdid','$qty','$invoiceno','$cname','$cmobileno','$pmode')") ; 
    }
    echo '<script>alert("Invoice genrated successfully. Invoice number is "+"'.$invoiceno.'")</script>';  
    unset($_SESSION["cart_item"]);
    $_SESSION['invoice']=$invoiceno;
    echo "<script>window.location.href='invoice.php'</script>";

}

?>

<!doctype html>
<html lang="en">
    <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">


    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.5.0/css/all.css" 
                integrity="sha384-B4dIYHKNBt8Bc12p+WXckhzcICo0wtJAoU8YZTY5qE0Id1GSseTk6S+L3BlXeVIU" 
                crossorigin="anonymous">
    <!--/Font Awesome-->


    </head>

    <!-- Custom Styles -->
    <link rel="stylesheet" type="text/css" href="./includes/style.css">

    <title>Search Products</title>

    <style type="text/css">
        #btnEmpty {
            background-color: #ffffff;
            border: #d00000 1px solid;
            padding: 5px 10px;
            color: #d00000;
            float: center;
            text-decoration: none;
            border-radius: 3px;
            margin-bottom: 10px;
        }
        #h1 {
            padding-left: 10px;
            color: #4f4b4e;
            font-size: 26px;
        }
        .input:focus,
        .input:hover{
            outline:none;
            border:2px solid #2593b8;
        }
    </style>
    
    </head>
    <body>
        <!--header area start-->
        <header>
            <div class="left_area">
                <h3>HP <span>DAIRY</span></h3>
            </div>

            <div class="right_area">
                <a href="./logout.php" class="logout_btn">Logout</a>
            </div>
            
            <div class="right_area">
                <a href="./setting.php" class="setting_btn">Setting</a>
            </div>

            <div class="right_area">
                <a href="./profile.php" class="profile_btn">Profile</a>
            </div>

        </header>
        <!--header area end-->

        <!--sidebar start-->
        <div class="sidebar">
            <a href="./dashboard.php"><i class="fa fa-th"></i><span>Dashboard</span></a>
            <a href="./add-category.php"><i class="fa fa-file-text"></i><span>Add Category</span></a>
            <a href="./manage-categories.php"><i class="fa fa-file-text"></i><span>Manage Category</span></a>
            <a href="./add-product.php"><i class="fa fa-list-alt"></i><span>Add Product</span></a>
            <a href="./manage-products.php"><i class="fa fa-list-alt"></i><span>Manage Product</span></a>
            <a href="./add-company.php"><i class="fa fa-file-text"></i><span>Add Company</span></a>
            <a href="./manage-companies.php"><i class="fa fa-file-text"></i><span>Manage Company</span></a>
            <a href="./search-products.php"><i class="fa fa-search"></i><span>Search Product</span></a>
            <a href="./Invoices.php"><i class="fas fa-file-invoice"></i><span>Invoices</span></a>
        </div>
        <!--sidebar end-->


    <!-- Main Content -->
    <div class="content">   
        <!-- Container -->
        <div class="cardbox">
            <!-- Title -->
            <div class="card-title">
                <h2><i class="fa fa-list-alt"></i> Search Products</h2>
            </div>
            <from>
                <div class="form-group">
                    <form class="needs-validation" method="post" novalidate>                                    
                        <div class="form-row">
                        <label for="validationCustom03">Product Name  </label>
                            <div class="col-md-6 mb-10">
                                <input type="text" class="input" id="validationCustom03" placeholder="Product Name" name="productname" required></label>
                            </div>
                            <br>
                        </div>                            
                        <button class="btn btn-primary" type="submit" name="search">search</button>
                    </form>
                </div>
                <!--code for search result -->
                    <?php if(isset($_POST['search'])){?>
                    <div class="form-group">    
                        <table id="datable_1" class="table table-hover w-100 display pb-30">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Category</th>
                                    <th>Company</th>
                                    <th>Product</th>
                                    <th>Pricing</th>
                                    <th>Quantity</th>
                                    <th>Action</th>
                                    
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $pname=$_POST['productname'];
                                $query=mysqli_query($con,"select * from tblproducts where ProductName like '%$pname%'");
                                $cnt=1;
                                while($row=mysqli_fetch_array($query))
                                {    
                                    ?>
                                    <form method="post" action="search-products.php?action=add&pid=<?php echo $row["id"]; ?>">                                                  
                                        <tr>
                                            <td><?php echo $cnt;?></td>
                                            <td><?php echo $row['CategoryName'];?></td>
                                            <td><?php echo $row['CompanyName'];?></td>
                                            <td><?php echo $row['ProductName'];?></td>
                                            <td><?php echo $row['ProductPrice'];?></td>
                                            <td><input type="text" class="product-quantity" name="quantity" value="1" size="2" /></td>
                                            <td>
                                            <input type="submit" value="Add to Cart" class="btnAddAction" />
                                            </td>
                                        </tr>
                                    </form>
                                    <?php 
                                    $cnt++;
                                } ?>
                            </tbody>
                        </table>    
                    </div>
                    <?php } ?>   
                </form> 
                </div> 
            </div>
        <div class="content">
            <div class="cardbox">                                   
                <div class="form-group">  
                    <h1 id="h1"><i class="fa fa-shopping-cart"></i> Shopping Cart</h1>  
                    <form class="needs-validation" method="post" novalidate>
                        <!--- Shopping Cart ---->
                        <a id="btnEmpty" href="search-products.php?action=empty" >Empty Cart</a>
                        <hr>
                        <?php
                        if(isset($_SESSION["cart_item"])){
                            $total_quantity = 0;
                            $total_price = 0;
                        ?>  
                        <table id="datable_1" class="table table-hover w-100 display pb-30" border="1">
                            <tbody>
                                <tr>
                                    <th>Product Name</th>
                                    <th>Category</th>
                                    <th>Company</th>
                                    <th width="5%">Quantity</th>
                                    <th width="10%">Unit Price</th>
                                    <th width="10%">Price</th>
                                    <th width="5%">Remove</th>
                                </tr>   
                                <?php 
                                $productid=array();      
                                foreach ($_SESSION["cart_item"] as $item){
                                    $item_price = $item["quantity"]*$item["price"];
                                    array_push($productid,$item['code']);
                                ?>
                                    
                                <input type="hidden" value="<?php echo $item['quantity']; ?>" name="quantity[<?php echo $item['code']; ?>]">
                                    <tr>
                                        <td><?php echo $item["pname"]; ?></td>
                                        <td><?php echo $item["catname"]; ?></td>
                                        <td><?php echo $item["compname"]; ?></td>
                                        <td><?php echo $item["quantity"]; ?></td>
                                        <td><?php echo $item["price"]; ?></td>
                                        <td><?php echo number_format($item_price,2); ?></td>
                                        <td><a href="search-products.php?action=remove&code=<?php echo $item["code"]; ?>" class="btnRemoveAction"><i class="fa fa-trash"><i/></a></td>
                                    </tr>
                                    <?php
                                        $total_quantity += $item["quantity"];
                                        $total_price += ($item["price"]*$item["quantity"]);
                                    }
                                    $_SESSION['productid']=$productid;
                                    ?>
                                    <tr>
                                        <td colspan="3" align="right">Total:</td>
                                        <td colspan="2"><?php echo $total_quantity; ?></td>
                                        <td colspan=><strong><?php echo number_format($total_price, 2); ?></strong></td>
                                        <td></td>
                                    </tr>
                            </tbody>
                        </table>  
                        <br>
                        <div class="form-group">
                            <div class="col-md-6 mb-10">
                                <div>   
                                    <label  for="validationCustom03">Customer Name </label>
                                </div>
                                <input type="text" class="input" id="validationCustom03" placeholder="Customer Name" name="customername" required>
                            </div>
                            <br>
                            <div class="col-md-6 mb-10">
                                <label for="validationCustom03">Customer Mobile Number</label>
                            </div>
                            <input type="text" class="input" id="validationCustom03"  placeholder="Mobile Number" name="mobileno" maxlength="10" pattern="[0-9]+" required>
                        </div>
                        
                        <div class="form-row">
                            <div class="col-md-6 mb-10">
                                <br>
                                <label for="validationCustom03">Payment Mode</label>
                                <div class="custom-control custom-radio mb-10">
                                    <label class="custom-control-label" for="customControlValidation3">Cash</label>
                                    <input type="radio" class="custom-control-input" id="customControlValidation2" name="paymentmode" value="card" required>             
                                </div>
                                <div class="custom-control custom-radio mb-10">
                                    <label class="custom-control-label" for="customControlValidation3">Card</label>
                                    <input type="radio" class="custom-control-input" id="customControlValidation3" name="paymentmode" value="card" required>             
                                </div> 
                            </div>
                            <br>
                            <div class="col-md-6 mb-10">
                                <button class="btn btn-primary" type="submit" name="checkout">checkout</button>
                            </div>
                        </div>
                                  
                    </form>
                    <?php
                        } else {
                    ?>
                        <div style="color:red" align="center">Your Cart is Empty</div>
                    <?php 
                        }
                    ?>
                </div>
            </div>
        </div>
        <!--/Container-->
    </div>
    <!-- /Main Content -->    
</body>
</html>

<?php } ?>