<?php
class Breadcrumbs{
	var $bread = '';
	var $crumbs = array();
	var $href_param;
	var $seperator;
	var $home_text;
	var $home_link;

	function __construct($seperator="",$href_param=NULL,$home_link='/',$home_text = "Dashboard") {
       	$this->href_param = $href_param;
		$this->seperator = $seperator;	
		$this->home_text = $home_text;
		$this->home_link = $home_link;
		$this->crumbs[] = array('crumb'=>$this->home_text,'link'=>$this->home_link);
    }

	function addCrumb($this_crumb,$this_link = NULL){
		$in_crumbs = false;
		// first check that we haven't already got this link in the breadcrumb list.
		foreach($this->crumbs as $crumb){
			if($crumb['crumb'] == $this_crumb ){
				$in_crumbs = true;
			}
			if($crumb['link'] == $this_link &&  $this_link != ''){
				$in_crumbs = true;
			}
		}
		if($in_crumbs == false){
			$this->crumbs[] = array('crumb'=>$this_crumb,'link'=>$this_link);
		}
	}
	// call this to return your breadcrumb html
	function makeBread(){
		$sandwich = $this->crumbs;
		$slices = array();
		foreach($sandwich as $slice){
			if (isset($slice['link']) && $slice['link'] != '') {
				$slices[] = '<li><a href="'.base_url($slice['link']).'" '.$this->href_param.'>' . $slice['crumb'] . '</a></li>';
			} else {
				$slices[] = "<li class='active'>".$slice['crumb']."</li>";
			}	
		}
		$this->bread = join($this->seperator, $slices);
		return $this->bread;
	}
}
?>