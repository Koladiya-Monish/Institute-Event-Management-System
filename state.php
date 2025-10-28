<?php require_once 'config.php'; ?>

<?php 
if(isset($_GET['country'])){
    $countryname = $_GET['country'];
    $selectedState = $_GET['selected'] ?? ''; // Get selected state if passed

    $q = "SELECT DISTINCT state FROM tblcity WHERE country = '$countryname' ORDER BY state";
    $query = mysqli_query($connect, $q);

    echo "<option value=''>Select State</option>";
    while($r = mysqli_fetch_assoc($query)){
        $sel = ($r['state'] == $selectedState) ? "selected" : "";
        echo "<option value='{$r['state']}' $sel>{$r['state']}</option>";
    }
}
?>
