<?php
include "connection.php";
include "products.php";
include "temps/header.php";
include "temps/menu.php";?>

<?php
$id=$_GET["id"];
$selectOneRecord=$connection->prepare("SELECT * FROM prudact WHERE id=?");
$selectOneRecord->execute([$id]);
$products=$selectOneRecord->fetchAll(PDO::FETCH_CLASS,"products");
foreach ($products as $productData){
    ?>
    <hr>
    <h5 class="display-5">Edit Product:</h5>
    <form class="row gx-3 gy-2 align-items-center" method="post" action="<?php $_SERVER['PHP_SELF']?>">
        <div class="col-sm-3">
            <input type="hidden" name="id" value="<?php echo $productData->id?>">
            <label class="visually-hidden" for="specificSizeInputName">Name</label>
            <input type="text" class="form-control" id="specificSizeInputName" placeholder="Product Name" name="Name" value="<?php echo $productData->name?>">
        </div>
        <div class="col-sm-3">
            <label class="visually-hidden" for="specificSizeInputCity">City</label>
            <input type="text" class="form-control" id="specificSizeInputCity" placeholder="Quantity"  name="Quantity" value="<?php echo $productData->quantity?>">
        </div>
        <div class="col-sm-3">
            <label class="visually-hidden" for="specificSizeInputbod">Date Of Birth</label>
            <input type="date" id="specificSizeInputbod" class="form-control" name="Date_of_Manifacture" value="<?php echo $productData->date_of_manifacture;?>">
        </div>
        <div class="col-sm-3">
            <label class="visually-hidden" for="specificSizeInputbod">Availability</label>
            <input type="text" id="specificSizeInputbod" class="form-control" placeholder="Availability" name="Availability" value="<?php echo $productData->availability?>">
        </div>
        <div class="col-sm-3">
            <label class="visually-hidden" for="specificSizeInputbod">Price</label>
            <input type="text" id="specificSizeInputbod" class="form-control" placeholder="Price" name="Price" value="<?php echo $productData->price?>">
        </div>
        <div class="col-auto">
            <button type="submit" class="btn btn-primary" name="update">Edit</button>
        </div>
    </form>
    <?php
}
if(isset($_POST["update"])){
    if(!empty($_POST["id"])&&!empty($_POST["Name"])&&!empty($_POST["Quantity"])&&!empty($_POST["Date_of_Manifacture"])&&!empty($_POST["Availability"])&&!empty($_POST["Price"])){
        $id=$_POST["id"];
        $Name=$_POST["Name"];
        $Quantity=$_POST["Quantity"];
        $Date_of_Manifacture=$_POST["Date_of_Manifacture"];
        $Availability=$_POST["Availability"];
        $Price=$_POST["Price"];
        $update=$connection->prepare("Update products SET Name=?,Quantity=?,Date_of_Manifacture=?,Availability=?,Price=? WHERE id=?");
        $update->execute([$Name,$Quantity,$Date_of_Manifacture,$Availability,$Price,$id]);
        header("Location: index.php");
    }else{
        echo "<div class='alert alert-danger' role='alert'>Please Fill All Inputs</div>";
    }
}

?>

<?php include "temps/footer.php"; ?>
