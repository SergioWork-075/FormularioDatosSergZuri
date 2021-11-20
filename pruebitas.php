<form method="post" action="process.php">
    <select name="taskOption">
        <option value="first">First</option>
        <option value="second">Second</option>
        <option value="third">Third</option>
    </select>
    <input type="submit" value="Submit the form"/>
</form>
<?php
$option = isset($_POST['taskOption']) ? $_POST['taskOption'] : false;
if ($option) {
    echo htmlentities($_POST['taskOption'], ENT_QUOTES, "UTF-8");
} else {
    echo "task option is required";
    exit;
}