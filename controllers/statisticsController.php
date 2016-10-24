<?php
/**
 * This controller is for showing the main panel. 
 * 
 *
 */

class statisticsController extends BaseController {

    function standard(){
		//Consider migrating the following to BaseController
		foreach($_GET as $key => $value) {
			if(substr($key,0,8) == 'SESSION_') {
				$_SESSION[$key] = $value;
			}
		}
		
        $wid = VublaFramework::$user->wid();
        $stat = new WebshopStatisticsProvider($wid);
        if(isset($_GET['activate'])){
            Settings::setLocal('enabled',1, $wid);
        }
		$this->vars->isEnabled = Settings::get('enabled', $wid);
        $this->vars->number_of_search = $stat->getNumberOfSearches();
        
        $this->vars->last_crawled = $stat->getLastCrawled();
        
        
        $this->vars->products_count = $stat->getProductsCount(); 
		
		$this->vars->number_of_search_today = $stat->getNumberOfSearches(time() - 3600*24);
		
		$maxWords = Settings::get('standard_num_search_words');
	    if(isset($_SESSION['SESSION_show_all_words']) && $_SESSION['SESSION_show_all_words']) {
            $maxWords = null;
        } 
     
        $this->vars->words = $stat->getSearchWords($maxWords);
       
        $maxWords = Settings::get('standard_num_not_found');
		if(isset($_SESSION['SESSION_show_all_not_found']) && $_SESSION['SESSION_show_all_not_found']) {
		    $maxWords = null;
        } 
		$this->vars->searchesNotFound = $stat->getNotFoundSearches($maxWords);

	
		
		
		$maxRows = Settings::get('standard_mini_log_length');
        
        $this->vars->log = $stat->getSearchLog(0, null,$maxRows);
        	
		$this->vars->isBeeingCrawled = false;  /// FIX THIS
		
        $this->vars->searches_without_result = $stat->getSearchNotHits();
		$this->vars->hit_ratio = round(100-$this->vars->searches_without_result*100/$this->vars->number_of_search,1);
        
        $statProvider = new WebshopStatisticsProvider($wid);
		$this->vars->needStatistics = $statProvider->getNumberOfCrawls('full') < 2 || 
		($statProvider->getNumberOfRankedWords()*100)/$statProvider->getNumberOfWords() < Settings::get('ranked_search_threshold',$wid);
        $this->view = 'statistics';
    }

    function log(){
		//Consider migrating the following to BaseController
		foreach($_GET as $key => $value) {
			if(substr($key,0,8) == 'SESSION_') {
				$_SESSION[$key] = $value;
			}
		}
		$maxRows = (int)Settings::get('standard_log_length');
		if(isset($_SESSION['SESSION_show_entire_log']) && $_SESSION['SESSION_show_entire_log']) {
			$maxRows = null;
		} 
       
        $wid = VublaFramework::$user->wid();
        $stat = new WebshopStatisticsProvider($wid);
        $this->vars->log = $stat->getSearchLog(0, null,$maxRows);
		$this->view = 'searchlog';
    }
}

?>