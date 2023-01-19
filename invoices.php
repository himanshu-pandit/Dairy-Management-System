<?php
session_start();
//error_reporting(0);
include('includes/config.php');
if (strlen($_SESSION['aid']==0)) {
  header('location:logout.php');
  } else{
// Code for deletion   
if(isset($_GET['del'])){    
$cmpid=substr(base64_decode($_GET['del']),0,-5);
$query=mysqli_query($con,"delete from tblcategory where id='$cmpid'");
echo "<script>alert('Category record deleted.');</script>";   
echo "<script>window.location.href='manage-categories.php'</script>";
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

            
    <style>
        .input:focus,
        .input:hover{
            outline:none;
            border:2px solid #2593b8;
        }
    </style>

    </head>

    <!-- Custom Styles -->
    <link rel="stylesheet" type="text/css" href="./includes/style.css">

    <title>Invoices</title>
    </head>
    <body>
        <!--header area start-->
        <header>
        <!--
            <label for="check">
                <i class="fas fa-bars" id="sidebar_btn"></i>
            </label>
        -->
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
            <a href="./add-companies.php"><i class="fa fa-file-text"></i><span>Add Company</span></a>
            <a href="./manage-companies.php"><i class="fa fa-file-text"></i><span>Manage Company</span></a>
            <a href="./search-products.php"><i class="fa fa-search"></i><span>Search Product</span></a>
            <a href=""><i class="fa fa-file-invoice"></i><span>Invoices</span></a>
        </div>
        <!--sidebar end-->

        <div class="content">
            <div class="cardbox">
                <div class="card-title">
                    <h2><i class="fa fa-list-alt"></i> Invoices</h2>
                </div>
            </div>
            <div class="cardbox">
                <form>
                    <div class="form-group">
                        <input type="text" id="myInput" onkeyup="myFunction()" class="input" title="Type in a name" placeholder="Search here...">                
                    </div>
                    <br>
                    <div class="form-group">
                       
                                                
                        <table id="myTable">
                            <tr class="header">
                                <th>#</th>
                                <th>Invoice Number</th>
                                <th>Customer Name</th>
                                <th>Customer Contact No.</th>
                                <th>Payment Mode</th>
                                <th>Date & Time</th>
                                <th>View</th>
                            </tr>
                            <?php 
                                $rno=mt_rand(10000,99999); 
                                $query=mysqli_query($con,"select distinct InvoiceNumber,CustomerName,CustomerContactNo,PaymentMode,InvoiceGenDate  from tblorders");
                                $cnt=1;
                                while($row=mysqli_fetch_array($query))
                                {    
                                ?>                                                
                                <tr>
                                <td><?php echo $cnt;?></td>
                                <td><?php echo $row['InvoiceNumber'];?></td>
                                <td><?php echo $row['CustomerName'];?></td>
                                <td><?php echo $row['CustomerContactNo'];?></td>
                                <td><?php echo $row['PaymentMode'];?></td>
                                <td><?php echo $row['InvoiceGenDate'];?></td>
                                <td>
                                <a href="view-invoice.php?invid=<?php echo base64_encode($row['InvoiceNumber'].$rno);?>" class="mr-25" data-toggle="tooltip" data-original-title="View Details"> <i class="fa fa-envelope"></i></a>
                                </td>
                                </tr>
                                <?php 
                                $cnt++;
                                } 
                            ?>
                        </table>
                    </div>
                </form>
            </div>
        </div>
        

        <script>
            function myFunction() {
            var input, filter, table, tr, td, i, txtValue;
            input = document.getElementById("myInput");
            filter = input.value.toUpperCase();
            table = document.getElementById("myTable");
            tr = table.getElementsByTagName("tr");
            for (i = 0; i < tr.length; i++) {
                td = tr[i].getElementsByTagName("td")[2];
                if (td) {
                txtValue = td.textContent || td.innerText;
                if (txtValue.toUpperCase().indexOf(filter) > -1) {
                    tr[i].style.display = "";
                } else {
                    tr[i].style.display = "none";
                }
                }       
            }
            }
        </script>
    </body>
</html>
<?php } ?>