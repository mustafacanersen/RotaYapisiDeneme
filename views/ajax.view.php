<?php
$nereden = "";
if (isset($_POST['nereden'])) {
    $nereden = $_POST['nereden'];
}
    $db->where ("r.tukeyPortId", "t.id");
    $db->where ("r.greecePortId", "g.id");
    $db->where ("g.portPoint", $nereden);
    $portPoint = $db->getValue ("route r, turkey_port t, greece_port g", "t.portPoint", null);
    foreach ($portPoint as $port)
    echo'<option value = "'.$port.'">'.$port.'</option>';
?>