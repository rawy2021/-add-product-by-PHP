<?php
include "connection.php";
include "products.php";
include "temps/header.php";
include "temps/menu.php";?>
<h5 class="display-4" style="color: crimson">Products Management System</h5>

        <table class="table table-success table-striped">
        <thead>
        <tr>
            <th scope="col">#</th>
            <th scope="col">Name</th>
            <th scope="col">Quantity</th>
            <th scope="col">Date of Manifacture</th>
            <th scope="col">Availability</th>
            <th scope="col">Price</th>
        </tr>
        </thead>
        <tbody>
        <tr>
            <?php
                $select = $connection->prepare("SELECT * FROM prudact");
                $select->execute();
                $products=$select->fetchAll(PDO::FETCH_CLASS,"products");
            if(!empty($products)){
                foreach ($products as $product){
            ?>
            <th scope="row"><?php echo $product->id?></th>
            <td><?php echo $product->name?></td>
            <td><?php echo $product->quantity?></td>
            <td><?php echo $product->date_of_manifacture?></td>
            <td><?php echo $product->availability?></td>
            <td><?php echo $product->price?></td>
            <td>
                <a href="delete.php?id=<?php echo $product->id?>"><i class="material-icons">delete_outline</i></a>|
                <a href="edit.php?id=<?php echo $product->id?>"><i class="material-icons">app_registration</i></a>
            </td>
        </tr>
        <?php } }else{
                        echo"No records";
         }?>
        </tbody>
    </table>

        <hr>
        <h5 class="display-5">Adding New Product:</h5>
    <form class="row gx-3 gy-2 align-items-center" method="post" action="<?php $_SERVER['PHP_SELF']?>">
        <div class="col-sm-3">
            <label class="visually-hidden" for="specificSizeInputName">Name</label>
            <input type="text" class="form-control" id="specificSizeInputName" placeholder="Product Name" name="Name">
        </div>
        <div class="col-sm-3">
            <label class="visually-hidden" for="specificSizeInputCity">Quantity</label>
            <input type="text" class="form-control" id="specificSizeInputCity" placeholder="Quantity"  name="Quantity">
        </div>
        <div class="col-sm-3">
            <label class="visually-hidden" for="specificSizeInputbod">Date of Manifacture</label>
            <input type="date" id="specificSizeInputbod" class="form-control" name="Date_of_Manifacture">
        </div>
        <div class="col-sm-3">
            <label class="visually-hidden" for="specificSizeInputbod">Availability</label>
            <input type="text" id="specificSizeInputbod" class="form-control" placeholder="Availability" name="Availability">
        </div>
        <div class="col-sm-3">
            <label class="visually-hidden" for="specificSizeInputbod">Price</label>
            <input type="text" id="specificSizeInputbod" class="form-control" placeholder="Price" name="Price">
        </div>
        <div class="col-auto">
            <button type="submit" class="btn btn-primary" name="add">Add</button>
        </div>
    </form>
    <?php
     if(isset($_POST["add"])){
         if(!empty($_POST["Name"])&&!empty($_POST["Quantity"])&&!empty($_POST["Date_of_Manifacture"])&&!empty($_POST["Availability"])&&!empty($_POST["Price"]))
         {
             $Name=$_POST["Name"];
             $Quantity=$_POST["Quantity"];
             $Date_of_Manifacture=$_POST["Date_of_Manifacture"];
             $Availability=$_POST["Availability"];
             $Price=$_POST["Price"];
             $insert=$connection->prepare("INSERT INTO prudact (name,quantity,date_of_manifacture,availability,price)VALUES (?,?,?,?,?)");
             $insert->execute([$Name,$Quantity,$Date_of_Manifacture,$Availability,$Price]);
         }
         else{
             echo "<div class='alert alert-danger' role='alert'>Please Fill All Inputs</div>";
         }
     }

     else{
         echo "name";
     }

    ?>

<?php include "temps/footer.php";?>