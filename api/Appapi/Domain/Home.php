<?php

class Domain_Home {

    public function getSlide() {
        $rs = array();
        $model = new Model_Home();
        $rs = $model->getSlide();
        return $rs;
    }
		
	public function getHot($p) {
        $rs = array();

        $model = new Model_Home();
        $rs = $model->getHot($p);
				
        return $rs;
    }
		
	public function getFollow($uid,$p) {
        $rs = array();
				
        $model = new Model_Home();
        $rs = $model->getFollow($uid,$p);
				
        return $rs;
    }
		
	public function getNew($lng,$lat,$p) {
        $rs = array();

        $model = new Model_Home();
        $rs = $model->getNew($lng,$lat,$p);
				
        return $rs;
    }
		
	public function search($uid,$key,$p) {
        $rs = array();

        $model = new Model_Home();
        $rs = $model->search($uid,$key,$p);
				
        return $rs;
    }
	
	public function getGameLive($p) {
        $rs = array();

        $model = new Model_Home();
        $rs = $model->getGameLive($p);
				
        return $rs;
    }
	
	public function getNearby($uid,$lng,$lat,$p) {
        $rs = array();

        $model = new Model_Home();
        $rs = $model->getNearby($uid,$lng,$lat,$p);
				
        return $rs;
    }
	public function getprivatelive($lng,$lat,$p) {
        $rs = array();

        $model = new Model_Home();
        $rs = $model->getprivatelive($lng,$lat,$p);
				
        return $rs;
    }	
	
}
