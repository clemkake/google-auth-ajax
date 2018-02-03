<?php
$user = 'root';
$pass = '';


header('Content-type: application/json; charset=utf-8');

try {
    $dbh = new PDO('mysql:host=localhost;dbname=brainiac', $user, $pass);
    ?> 
       {  
    <?php

    foreach($dbh->query('SELECT * from products limit 30') as $row) {
        ?>
          	  "channel": "online",
			  "contentLanguage": "EN",
			  "offerId": "<?php echo $row['ID'] ?>",
			  "targetCountry": "US",
			  "condition": "New",
			  "brand": "CLEMKAKE TEST",
			  "gtin": "6478293098237",
			  "itemGroupId": "<?php echo $row['ID'] ?>",
			  "link": "<?php echo $row['Final URL'] ?>",
			  "mpn": "<?php echo $row['ID'] ?>",
			  "price": {
			    "currency": "USD",
			    "value": "20"
			  },
			  "availability": "In stock",
			  "description": "<?php echo $row['Item description'] ?>",
			  "identifierExists": false,
			  "title": "<?php echo $row['Item title'] ?>",
			  "imageLink": "<?php echo $row['Image URL'] ?>",
			  "googleProductCategory": "<?php echo $row['Item category'] ?>",
		
        <?php
}
   ?> 
    } 
<?php
    $dbh = null;
} catch (PDOException $e) {
    print "Error!: " . $e->getMessage() . "<br/>";
    die();
}
?>





