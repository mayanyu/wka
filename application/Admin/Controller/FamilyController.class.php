<?php

/**
 * 家族
 */
namespace Admin\Controller;
use Common\Controller\AdminbaseController;
class FamilyController extends AdminbaseController {
    function index(){
		$map['state']=array('neq',3);
		if($_REQUEST['start_time']!='')
		{
			$map['addtime']=array("gt",strtotime($_REQUEST['start_time']));
			$_GET['start_time']=$_REQUEST['start_time'];
		}	 
		if($_REQUEST['end_time']!='')
		{		 
			$map['addtime']=array("lt",strtotime($_REQUEST['end_time']));
			$_GET['end_time']=$_REQUEST['end_time'];
		}
		if($_REQUEST['start_time']!='' && $_REQUEST['end_time']!='' )
		{ 
			$map['addtime']=array("between",array(strtotime($_REQUEST['start_time']),strtotime($_REQUEST['end_time'])));
			$_GET['start_time']=$_REQUEST['start_time'];
			$_GET['end_time']=$_REQUEST['end_time'];
		}
		if($_REQUEST['keyword']!='')
		{
			$map['uid|name']=array("like","%".$_REQUEST['keyword']."%"); 
			$_GET['keyword']=$_REQUEST['keyword'];
		}		
			
    	$auth=M("family");
    	$count=$auth->where($map)->count();
    	$page = $this->page($count, 20);
    	$lists = $auth
			->where($map)
			->order("addtime DESC")
			->limit($page->firstRow . ',' . $page->listRows)
			->select();
		foreach($lists as $k=>$v){
			   $userinfo=M("users")->field("user_nicename")->where("id='$v[uid]'")->find();
			   $lists[$k]['userinfo']= $userinfo; 
		}			
    	$this->assign('lists', $lists);
    	$this->assign('formget', $_GET);
    	$this->assign("page", $page->show('Admin'));
    	
    	$this->display();
	}

    function profit(){
		$uid=intval($_GET['uid']);

		$map=array();
		
		$Family=M('family');
		$User_family=M("users_family");
		$ufamilyinfo=$User_family->where("uid={$uid}")->find();
		if($ufamilyinfo){
			$map['uid']=$uid;
		}else{
			$familyinfo=$Family->where("uid={$uid}")->find();
			$map['familyid']=$familyinfo['id'];
		}

    	$family_profit=M('family_profit');
    	$count=$family_profit->where($map)->count();
    	$page = $this->page($count, 20);
		$total_family=$family_profit->where($map)->sum("profit");
		$total_anthor=$family_profit->where($map)->sum("profit_anthor");
		if(!$total_family){
			$total_family=0;
		}
		if(!$total_anthor){
			$total_anthor=0;
		}
    	$lists = $family_profit
			->field("*")
			->where($map)
			->order("addtime DESC")
			->limit($page->firstRow . ',' . $page->listRows)
			->select();
			foreach($lists as $k=>$v){
				   $userinfo=M("users")->field("user_nicename")->where("id='$v[uid]'")->find();
				   $lists[$k]['userinfo']= $userinfo; 
			}			
    	$this->assign('total_family', $total_family);
    	$this->assign('total_anthor', $total_anthor);
    	$this->assign('lists', $lists);
    	$this->assign('formget', $_GET);
    	$this->assign("page", $page->show('Admin'));
    	
    	$this->display();
	}


    function cash(){
		$uid=intval($_GET['uid']);

		$User_family=M("users_family");
		$Cashrecord=M('users_cashrecord');
		$Users=M('users');
		$map=array();
		$map['uid']=$uid;
		$ufamilyinfo=$User_family->where("uid={$uid}")->find();
		if($ufamilyinfo){
			$map['addtime']=array('gt',$ufamilyinfo['addtime']);
		}

    	
		
    	$count=$Cashrecord->where($map)->count();
    	$page = $this->page($count, 20);
		$total=0;
    	$lists = $Cashrecord
			->where($map)
			->order("addtime DESC")
			->limit($page->firstRow . ',' . $page->listRows)
			->select();
			foreach($lists as $k=>$v){
				   $userinfo=$Users->field("user_nicename")->where("id='$v[uid]'")->find();
				   $lists[$k]['userinfo']= $userinfo; 
				   if($v['status']==1){
					   $total+=$v['money'];
				   }
			}			

    	$this->assign('total', $total);
    	$this->assign('lists', $lists);
    	$this->assign('formget', $_GET);
    	$this->assign("page", $page->show('Admin'));
    	
    	$this->display();
	}
	function edit()
	{
		$id=intval($_GET['id']);
		if($id){
			$family=M("family")->find($id);
			$this->assign('family', $family);						
		}else
		{				
			$this->error('数据传入失败！');
		}								  
		$this->display();
	}
	function edit_post()
	{
		if(IS_POST)
		{			
			$family=M("family");
			$id=I('id');
			$oldinfo=$family->field("state")->where("id={$id}")->find();
			$family->create();
			if($family->state==2 && $family->state !=$oldinfo['state']){
				$family->istip=1;
			}
			$result=$family->save(); 
			if($result!==false)
			{
				$this->success('修改成功');
			}
			else
			{
				$this->error('修改失败');
			}					 
		}		
	}
	function disable()
	{
		$id=intval($_GET['id']);
		if($id)
		{
			$result=M("family")->where("id=".$id)->setField("disable", "1");			
			if($result!==false)
			{
				$this->success('禁用成功');
			}
			else
			{
				$this->error('禁用失败');
			}			
		}else{				
			$this->error('数据传入失败！');
		}								  
		$this->display();		
	}
	function enable()
	{
		$id=intval($_GET['id']);
		if($id)
		{
			$result=M("family")->where("id=".$id)->setField("disable", "0");			
			if($result!==false)
			{
				$this->success('启用成功');
			}
			else
			{
				$this->error('启用失败');
			}			
		}else{				
			$this->error('数据传入失败！');
		}								  
		$this->display();		
	}
	function del()
	{
		$id=intval($_GET['id']);
		if($id)
		{
			$data=array(
				'state'=>3,
				'signout'=>2,
				'signout_istip'=>2,
			);
			$user_family=M("users_family")->where("familyid=".$id)->save($data);				
			$user_family=M("family_profit")->where("familyid=".$id)->delete();		
			$data2=array(
				'state'=>3,
			);
			$result=M("family")->where("id=".$id)->save($data2);			
			if($result!==false)
			{
				$this->success('删除成功');
			}
			else
			{
				$this->error('删除失败');
			}			
		}else{				
			$this->error('数据传入失败！');
		}								  
		$this->display();		
	}
	function users()
	{
		$map['state']=array('neq',3);
		if($_REQUEST['start_time']!='')
		{
			$map['addtime']=array("gt",strtotime($_REQUEST['start_time']));
			$_GET['start_time']=$_REQUEST['start_time'];
		}	 
		if($_REQUEST['end_time']!='')
		{		 
			$map['addtime']=array("lt",strtotime($_REQUEST['end_time']));
			$_GET['end_time']=$_REQUEST['end_time'];
		}
		if($_REQUEST['start_time']!='' && $_REQUEST['end_time']!='' )
		{ 
			$map['addtime']=array("between",array(strtotime($_REQUEST['start_time']),strtotime($_REQUEST['end_time'])));
			$_GET['start_time']=$_REQUEST['start_time'];
			$_GET['end_time']=$_REQUEST['end_time'];
		}
		if($_REQUEST['keyword1']!='')
		{
			$map['familyid']=$_REQUEST['keyword1']; 
			$_GET['keyword1']=$_REQUEST['keyword1'];
		}	
		if($_REQUEST['keyword2']!='')
		{
			$map['uid']=$_REQUEST['keyword2']; 
			$_GET['keyword2']=$_REQUEST['keyword2'];
		}
			
    	$auth=M("users_family");
    	$Users=M("users");
    	$Family=M("family");
    	$count=$auth->where($map)->count();
    	$page = $this->page($count, 20);
    	$lists = $auth
			->where($map)
			->order("addtime DESC")
			->limit($page->firstRow . ',' . $page->listRows)
			->select();
		foreach($lists as $k=>$v){
			$userinfo=$Users->field("user_nicename,divide_family")->where("id='$v[uid]'")->find();
			$lists[$k]['userinfo']= $userinfo; 
			$family=$Family->where("id='$v[familyid]'")->find();
			$lists[$k]['family']= $family; 
		}			
    	$this->assign('lists', $lists);
    	$this->assign('formget', $_GET);
    	$this->assign("page", $page->show('Admin'));    	
    	$this->display();
	}
	function users_edit()
	{
		$id=intval($_GET['id']);
		if($id){
			$user_family=M("users_family")->where("id={$id}")->find();
			$userinfo=M("users")->field("user_nicename,divide_family")->where("id=".$user_family['uid'])->find();
			$user_family['userinfo']=$userinfo;
			$family=M("family")->field("name,divide_family")->where("id=".$user_family['familyid'])->find();
			$user_family['family_nicename']=$family['name'];
			$user_family['family_devide']=$family['divide_family'];
			$this->assign("user_family", $user_family);						
		}else
		{				
			$this->error('数据传入失败！');
		}								  
		$this->display();
	}
	function users_edit_post()
	{
		if(IS_POST)
		{			
			$user_family=M("users_family");
			$user_family->create();
			$user_family=$user_family->save(); 
			if($user_family!==false)
			{
				$divide_family=$_POST['divide_family'];
				$uid=$_POST['uid'];
				M("users")->where("id={$uid}")->save(array('divide_family'=>$divide_family));
				$this->success('修改成功');
			}
			else
			{
				$this->error('修改失败');
			}					 
		}		
	}
	function users_del()
	{
		$id=intval($_GET['id']);
		if($id)
		{
			$data=array(
				'state'=>3,
				'signout'=>3,
				'signout_istip'=>3,
			);
			$result=M("users_family")->where("id=".$id)->save($data);			
			if($result!==false)
			{
				$this->success('删除成功');
			}
			else
			{
				$this->error('删除失败');
			}			
		}else{				
			$this->error('数据传入失败！');
		}								  
		$this->display();	
	}
	function users_add()
	{
		$this->display();	
	}
	function users_add_post()
	{
		if(IS_POST)
		{	
			$uid=$_REQUEST['uid'];
			$familyid=$_REQUEST['familyid'];
			if($uid!=""&&$familyid!="")
			{
				$users=M("users")->where("id=".$uid." and user_type=2")->find();
				if($users)
				{
					$family=M("family")->where("id=".$familyid)->find();
					if($family)
					{
						$user_family=M("users_family");
						$user_family->create();
						$user_family->state="2";
						$user_family->addtime=time();
						$result=$user_family->add(); 
						if($result!==false)
						{
							$this->success('添加成功');
						}else
						{
							$this->error('添加失败');
						}			
					}
					else
					{
						$this->error('该家族不存在');
					}
				}
				else
				{
					$this->error('该成员不存在');
				}
			}
			else
			{
				$this->error('成员ID与家族ID不能为空');
			}
		}		
	}
}