<html>
<?php
if ($c=OCILogon("ora_m3c9", "a39296132", "dbhost.ugrad.cs.ubc.ca:1522/ug")) { 
  echo "Successfully connected to Oracle.\n"; 
} else { 
  $err = OCIError(); 
  echo "Oracle Connect Error " . $err['message']; 
}
//create 4 digit cid at random
//get cids from table
//if
$eid = $_GET["employee"];
$email = $_GET["email"];
$password = $_GET["pass"];
$name = $_GET["name"];
$addy = $_GET["addy"];
$phone = $_GET["phone"];
$sql = "INSERT INTO employee(eid, email, password, name, address, phone_num, hire_date) VALUES ('$eid' , '$email', '$password', '$name' ,'$addy' ,'$phone'  , sysdate)";
$st = oci_parse($c, $sql);
oci_execute($st);
oci_free_statement($st);

$stid = oci_parse($c, 'SELECT * FROM employee');
oci_execute($stid);
echo "<table border='1'>\n";
while ($row = oci_fetch_array($stid, OCI_ASSOC+OCI_RETURN_NULLS)) {
    echo "<tr>\n";
    foreach ($row as $item) {
        echo "    <td>" . ($item !== null ? htmlentities($item, ENT_QUOTES) : "&nbsp;") . "</td>\n";
    }
    echo "</tr>\n";
}
echo "</table>\n";
oci_close($c);
?>
</html>
