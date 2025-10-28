<?php require_once 'config.php'; ?>

<?php 
if(isset($_GET['state'])){
    $statename = $_GET['state'];
    $selectedCity = $_GET['selected'] ?? ''; // Pre-selected city ID
    $q = "SELECT id, city FROM tblcity WHERE state = '$statename' ORDER BY city";
    $query = mysqli_query($connect, $q);

    echo "<option value=''>-- Select City --</option>";
    while($r = mysqli_fetch_assoc($query)){
        $sel = ($r['id'] == $selectedCity) ? "selected" : "";
        echo "<option value='{$r['id']}' $sel>{$r['city']}</option>";
    }
}
?>
