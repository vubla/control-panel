<?php
class productboostController extends BaseController {

    function standard(){
		  $this->vars->host = User::getHost($_SESSION['uid']);
        $this->vars->products_count = VPDO::getVdo(DB_PREFIX.$this->getWid())->fetchOne('SELECT count(*) FROM products');
        $this->view = 'productboost';
        
        if(isset($_GET['q']))
        {
        	   $link = API_URL.'/search/?q='.urlencode($_GET['q']).'&host='.urlencode($this->vars->host).'&param=q&json&enable=1';
        	   
        		$this->vars->products = json_decode(file_get_contents($link))->products;
        }
        else {
       	   $this->vars->products = $this->getProductList();
        }
        
        $this->vars->boosted_products = $this->getBoostedList();
        $this->vars->boosted = $this->getBoosted();
       // var_dump($this->vars);exit;
    }
    
    function save() {
        
    	  $vpdo = VPDO::getVdo(DB_PREFIX.$this->getWid());
	     $ids = array_keys($_POST['boost_start_y']);

    	  for($i = 0; $i < count($ids); $i++) {
    	  	
				$id = $ids[$i];
				
    	  		if($_POST['was_boosted'][$ids[$i]] == 1 && $_POST['boosted'][$ids[$i]] != 1) {
    	  			$vpdo->exec('UPDATE products_boost SET action = \'deleted\' WHERE product_id = ' . $vpdo->quote($id));
    	  		}
    	  		elseif($_POST['boosted'][$ids[$i]] == 1) {
    	  			$date_start = strtotime($_POST['boost_start_y'][$ids[$i]] . '-' . $_POST['boost_start_m'][$ids[$i]] . '-' . $_POST['boost_start_d'][$ids[$i]]);
    	  			$date_end = strtotime($_POST['boost_end_y'][$ids[$i]] . '-' . $_POST['boost_end_m'][$ids[$i]] . '-' . $_POST['boost_end_d'][$ids[$i]]);
    	  			$vpdo->exec('INSERT INTO products_boost(product_id,date_start,date_end) VALUES(' . $vpdo->quote($id) . ',' . $vpdo->quote($date_start) . ',' . $vpdo->quote($date_end) . ')');
    	  		}
    	  }
               $this->standard();
    	 // $this->redirect('productboost');
    }
    
    function getProductList() {
        $sql = 'SELECT * FROM products';
        return VPDO::getVdo(DB_PREFIX.$this->getWid())->getTableList($sql);
	 }
	 
	 function getBoosted() {

     echo    $sql = '
        		SELECT p.* 
				FROM products_boost p
				WHERE action NOT LIKE \'deleted\'
				AND date_end >= ' . strtotime(date("Y-m-d",time()) . " 00:00:00") . '
				AND NOT EXISTS (SELECT 1 FROM products_boost WHERE product_id = p.product_id AND id > p.id)';
                echo '<br>';
				
        return VPDO::getVdo(DB_PREFIX.$this->getWid())->getTableList($sql);	
	 }
	 
	 function getBoostedList() {

        echo $sql = '
        		SELECT p.* products,b.* 
				FROM products p, products_boost b
				WHERE p.id = b.product_id AND b.action NOT LIKE \'deleted\'
				AND date_end >= ' . strtotime(date("Y-m-d",time()) . " 00:00:00") . '
				AND NOT EXISTS (SELECT 1 FROM products_boost WHERE product_id = b.product_id AND id > b.id)';
				 echo '<br>';
        return VPDO::getVdo(DB_PREFIX.$this->getWid())->getTableList($sql);	
	 }
}

?>  
    