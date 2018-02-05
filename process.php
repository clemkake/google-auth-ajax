<?php
$user = 'root';
$pass = 'souris_123';
$choice = $_GET['choice'];


try {
    $dbh = new PDO('mysql:host=localhost;dbname=brainiac', $user, $pass);

   if($choice === 'true'){

   	header('Content-type: application/json; charset=utf-8');


    foreach($dbh->query('SELECT * from products limit 30') as $row) {
        ?>
              "kind": "content#product",
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
			    "value": "<?php echo $row['price'] ?>",
			  },
			  "availability": "In stock",
			  "description": "<?php echo $row['Item description'] ?>",
			  "identifierExists": "false",
			  "title": "<?php echo $row['Item title'] ?>",
			  "imageLink": "<?php echo $row['image link'] ?>",
			  "googleProductCategory": "<?php echo $row['Item category'] ?>",
		
        <?php
}
   
} else {
     foreach($dbh->query('SELECT * from products limit 30') as $row) {
        ?>
        <li class="media p-list">
                        	
            <div class="media-left">
              <a href="#"> <img alt="64x64" class="media-object" data-src="holder.js/64x64" style="width: 64px; height: 64px;" src="<?php echo $row['image link'] ?>"
                data-holder-rendered="true"> </a>
            </div>
	            <div class="media-body">
	              <h4 class="media-heading"><?php echo $row['Item title'] ?></h4>
	              <ol class="breadcrumb">
	                <li><a class="active"><?php echo $row['ID'] ?></a> </li> </br>
	                <li><a href="#">$ <?php echo $row['price'] ?></a></li>
	              </ol>
	            </div>

	         <div class="media-right">
             <i class="glyphicons-remove-sign"> </i> 
            </div>
         </li> 
        <?php
}
   
}
    $dbh = null;
} catch (PDOException $e) {
    print "Error!: " . $e->getMessage() . "<br/>";
    die();
}
?>








