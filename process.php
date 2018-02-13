<?php
$user = 'root';
$pass = '';
$choice = $_GET['choice'];


try {
    $dbh = new PDO('mysql:host=localhost;dbname=brainiac', $user, $pass);

   if($choice === 'true'){

   	header('Content-type: application/json; charset=utf-8');

        ?>

        {
        <?php
        // beginning of the json loop following with the closing parameter
    foreach($dbh->query('SELECT * from products4 limit 30') as $row) {
        ?>  
              "kind": "content#product","channel": "online","contentLanguage": "EN","offerId": "<?php echo $row['id'] ?>","targetCountry": "US","condition": "New","brand": "CLEMKAKE TEST","gtin": "6478293098237","itemGroupId": "<?php echo $row['id'] ?>","link": "<?php echo $row['link'] ?>","mpn": "<?php echo $row['id'] ?>","price": {"currency": "USD","value": "<?php echo $row['price'] ?>" },"availability": "In stock","description": "<?php echo $row['description'] ?>","identifierExists": false,"title": "<?php echo $row['title'] ?>","imageLink": "<?php echo $row['image_link'] ?>","googleProductCategory": "<?php echo $row['google_product_category'] ?>",<?php
} // end of the json loop following with the closing parameter?>}  
<?php

} else {
     foreach($dbh->query('SELECT * from products4 limit 30') as $row) {
        ?>
        <li class="media p-list">
                        	
            <div class="media-left">
              <a href="#"> <img alt="64x64" class="media-object" data-src="holder.js/64x64" style="width: 64px; height: 64px;" src="<?php echo $row['image_link'] ?>"
                data-holder-rendered="true"> </a>
            </div>
	            <div class="media-body">
	              <h4 class="media-heading"><?php echo $row['title'] ?></h4>
	              <ol class="breadcrumb">
	                <li><a class="active"><?php echo $row['id'] ?></a> </li> </br>
	                <li><a href="#"><?php echo $row['price'] ?></a></li>
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








