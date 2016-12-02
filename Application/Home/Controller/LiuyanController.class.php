<?php
namespace Home\Controller;
use Think\Controller;
class LiuyanController extends Controller {
    public function index(){
    	$liu = M('liuyan');
    	$data = $liu->order('id asc')->select();
    	$this->assign('data',$data);
    	// var_dump($data);
        $this->display();
    }
    public function add(){
    	if(empty($_POST['title']) || empty($_POST['author']) || empty($_POST['addtime']) || empty($_POST['ip']) || empty($_POST['content'])){
    		echo 0;
    	}else{
    		$liu = M('liuyan');
	    	$j = $liu->add($_POST);
	    	$data = $liu->where('id='.$j)->select();
	    	echo json_encode($data);
    	}
    }
    public function del(){
    	$del = $_POST['sid'];
    	// echo $del;
    	if(empty($del)){
    		echo 0;
    	}else{
    		$liu = M('liuyan');
	    	$j = $liu->delete($del);
	    	echo $j;
    	}
    }
}