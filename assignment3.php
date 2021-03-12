<?php
    include_once("dbinfo.php");

    // Establish connection
    $conn = mysqli_connect($db_host, $db_user, $db_password, "assignment3");

    // Check for successful connection 
    if (!$conn) {
        die("Connection failed: " .mysqli_connect_error());
    }
    echo "Connected successfully2";

    //Create a new table if it doesn't already exist x 3 (customers, products, order_lookup)
    $sql = "CREATE TABLE IF NOT EXISTS registered_users (
        user_id int(11) NOT NULL AUTO_INCREMENT,
        title varchar(4) NOT NULL,
        firstname varchar(100) NOT NULL,
        lastname varchar(100) NOT NULL,
        street varchar(100) NOT NULL,
        city varchar(100) NOT NULL,
        province varchar(100) NOT NULL,
        postalcode varchar(100) NOT NULL,
        country varchar(100) NOT NULL,
        phone varchar(100) NOT NULL,
        email varchar(100) NOT NULL,
        newsletter varchar(100) NOT NULL,
        PRIMARY KEY (user_id)           
    ) CHARSET=utf8mb4";
    mysqli_query($conn, $sql);

        //retrieve the submitted values
        $title = $_GET["title"];
        $fname = $_GET["fname"];
        $lname = $_GET["lname"];
        $street = $_GET["street"];
        $city = $_GET["city"];
        $province = $_GET["province"];
        $postalcode = $_GET["postalcode"];
        $country = $_GET["country"];
        $phone= $_GET["phone"];
        $email = $_GET["email"];
        $newsletter = $_GET["newsletter"];

    //check for form submission

    if (isset($_GET["form1"])) {
        $formSubmit = true;
    } else {
        $formSubmit = false;
    }

    //check for clear button
    if(isset($_GET["clear"])) {
        $title = "";
        $fname = "";
        $lname = "";
        $street = "";
        $city = "";
        $province = "";
        $postalcode = "";
        $country = "";
        $phone= "";
        $email = "";
        $newsletter = "";
        $sql = "TRUNCATE TABLE registered_users";
        mysqli_query($conn, $sql);
    } else {
        //nothing
    }

    //error checking
    $errors = 0;
    if ($formSubmit && $title == "") $errors = 1;
    if ($formSubmit && $fname == "") $errors = 2;
    if ($formSubmit && $lname == "") $errors = 3;
    if ($formSubmit && $street == "") $errors = 4;
    if ($formSubmit && $city == "") $errors = 5;
    if ($formSubmit && $province == "") $errors = 6;
    if ($formSubmit && $postalcode == "") $errors = 7;
    if ($formSubmit && $country == "") $errors = 8;
    if ($formSubmit && $phone == "") $errors = 9;
    if ($formSubmit && $email == "") $errors = 10;

?>
<!DOCTYPE html>
<HTML>
    <HEAD>
        <TITLE>My Test Form</TITLE>
    </HEAD>
    <BODY>
        <P>Please fill in the following form. Fields marked with (*) are
            required.</P>
        <FORM action="" method="GET">
<label><b>Title*</b><br /></label><SELECT name="title"><OPTION VALUE=""></OPTION>
<OPTION VALUE="Mr" <?php if ($title=="Mr") echo "selected"; ?> >Mr</OPTION>
<OPTION VALUE="Mrs" <?php if ($title=="Mrs") echo "selected"; ?> >Mrs</OPTION>
<OPTION VALUE="Ms" <?php if ($title=="Ms") echo "selected"; ?> >Ms</OPTION>
<OPTION VALUE="Dr" <?php if ($title=="Dr") echo "selected"; ?> >Dr</OPTION>
</SELECT>
<?php if ($formSubmit && $title == "") echo " <font color='red'>
<strong><sup>*</sup>required</strong></font>"; ?>
<br />

<label><b>First Name*</b><br /></label><INPUT TYPE="text" name="fname" value="<?php echo $fname; ?>" />
<?php if ($formSubmit && $fname == "") echo " <font color='red'>
<strong><sup>*</sup>required</strong></font>"; ?>
<br />

<label><b>Last Name*</b><br /></label><INPUT TYPE="text" name="lname" value="<?php echo $lname; ?>" />
<?php if ($formSubmit && $lname == "") echo " <font color='red'>
<strong><sup>*</sup>required</strong></font>"; ?>
<br />

<label><b>Street*</b><br /></label><INPUT TYPE="text" name="street" value="<?php echo $street; ?>" />
<?php if ($formSubmit && $street == "") echo " <font color='red'>
<strong><sup>*</sup>required</strong></font>"; ?>
<br />

<label><b>City*</b><br /></label><INPUT TYPE="text" name="city" value="<?php echo $city; ?>" />
<?php if ($formSubmit && $city == "") echo " <font color='red'>
<strong><sup>*</sup>required</strong></font>"; ?>
<br />

<label><b>Province*</b><br /></label><INPUT TYPE="text" name="province" value="<?php echo $province; ?>" />
<?php if ($formSubmit && $province == "") echo " <font color='red'>
<strong><sup>*</sup>required</strong></font>"; ?>
<br />

<label><b>Postal Code*</b><br /></label><INPUT TYPE="text" name="postalcode" value="<?php echo $postalcode; ?>" />
<?php if ($formSubmit && $postalcode == "") echo " <font color='red'>
<strong><sup>*</sup>required</strong></font>"; ?>
<br />

<label><b>Country*</b><br /></label><SELECT name="country"><OPTION VALUE=""></OPTION>
<OPTION VALUE="Canada" <?php if ($country=="Canada") echo "selected"; ?> >Canada</OPTION>
<OPTION VALUE="USA" <?php if ($country=="USA") echo "selected"; ?> >USA</OPTION>
</SELECT>
<?php if ($formSubmit && $country == "") echo " <font color='red'>
<strong><sup>*</sup>required</strong></font>"; ?>
<br />

<label><b>Phone*</b><br /></label><INPUT TYPE="text" name="phone" value="<?php echo $phone?>" />
<?php if ($formSubmit && $phone == "") echo " <font color='red'>
<strong><sup>*</sup>required</strong></font>"; ?>
<br />

<label><b>Email*</b><br /></label><INPUT TYPE="text" name="email" value="<?php echo $email; ?>" />
<?php if ($formSubmit && $email == "") echo " <font color='red'>
<strong><sup>*</sup>required</strong></font>"; ?>
<br />

<label><b>News Letter</b></label><br />
<input type="checkbox" name="newsletter" value="Yes" />
<br />

<INPUT TYPE="submit" name="form1" value="Submit" />
<INPUT TYPE="submit" name="clear" value="Clear"/>
    
<br />
<br />

    <?php
    if (!$errors && $formSubmit) {

    $sql="INSERT INTO registered_users 
    (title, firstname, lastname, street, city, province, postalcode, country, 
    phone, email, newsletter) 
    VALUES ('$title', '$fname', '$lname', '$street', '$city', '$province', 
    '$postalcode', '$country', '$phone', '$email', '$newsletter')";
    mysqli_query($conn, $sql);
    
    echo "$title $fname $lname of $street $city $province $postalcode $country has submitted a form. 
    Their email address is $email and their phone number is $phone.  Newsletter: ";
    if ($_GET['newsletter'] =='Yes'){
        echo "Yes";
    }
    else {
        echo "No";
    }

    $sql = "SELECT user_id, title, firstname, lastname, street, city,
                province, postalcode, country, phone, email, newsletter
                from registered_users";
    $result = $conn-> query($sql);

    echo "<br /><br />";
    echo '<table border="1" cellspacing="2">
                <tr>
                    <th>user_id</th>
                    <th>Title</th>
                    <th>First Name</th>
                    <th>Last Name</th>
                    <th>Street</th>
                    <th>City</th>
                    <th>Province</th>
                    <th>Postal Code</th>
                    <th>Country</th>
                    <th>Phone</th>
                    <th>Email</th>
                    <th>Newsletter</th>
                </tr>';

        
            while ($row = $result-> fetch_assoc()) {
            //while ($row = mysqli_fetch_assoc($results)) {
            echo "<tr><td>". $row["user_id"] ."</td>";
            echo "<td>". $row["title"] ."</td>";
            echo "<td>". $row["firstname"] ."</td>";
            echo "<td>". $row["lastname"] ."</td>";
            echo "<td>". $row["street"] ."</td>";
            echo "<td>". $row["city"] ."</td>";
            echo "<td>". $row["province"] ."</td>";
            echo "<td>". $row["postalcode"] ."</td>";
            echo "<td>". $row["country"] ."</td>";
            echo "<td>". $row["phone"] ."</td>";
            echo "<td>". $row["email"] ."</td>";
            echo "<td>". $row["newsletter"] ."</td>";
        }
        echo '</table>';

}
mysqli_close($conn);
    ?>
        </FORM>
    </BODY>
</HTML>