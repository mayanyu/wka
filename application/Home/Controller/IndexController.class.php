<?php
// +----------------------------------------------------------------------
// | ThinkCMF [ WE CAN DO IT MORE SIMPLE ]
// +----------------------------------------------------------------------
// | Copyright (c) 2013-2014 http://www.thinkcmf.com All rights reserved.
// +----------------------------------------------------------------------
// | Author: Dean <zxxjjforever@163.com>
// +----------------------------------------------------------------------
namespace Home\Controller;
use Common\Controller\HomebaseController; 
/**
 * 首页
 */
class IndexController extends HomebaseController {
	
    //首页
	public function index() {
		$config=$this->config;
if($config['maintain_switch']==1){
   $this->assign('jumpUrl',__APP__);
   $this->error(nl2br($config['maintain_tips']));
}
		$prefix= C("DB_PREFIX");
		$this->assign("current",'index');	
		$uid=session("uid");
		/* 轮播 */
		$slide=M("slide")->where("slide_status='1' and slide_cid='1'")->order("listorder asc")->select();
		$this->assign("slide",$slide);	
		/* 右侧广告 */
		$ads=M("ads")->where("sid='1'")->order("orderno asc")->limit(7)->select();
		$this->assign('ads',$ads);
		$redis =connectionRedis();	
		/* 推荐 */
		$recommend=M("users_live l")
					->field("l.user_nicename,l.avatar,l.thumb,l.uid,l.stream")
					->join("left join {$prefix}users u on u.id=l.uid")
					->where("l.islive='1' and u.isrecommend='1'")
					->order("u.ishot desc,u.votestotal desc")
					->limit(5)
					->select();
		foreach($recommend as $k=>$v){
	 		if($v['thumb']=="")
			{
				$recommend[$k]['thumb']=$v['avatar'];
			} 
			$nums=$redis->hlen('userlist_'.$v['stream']);
			$recommend[$k]['nums']=$nums;
		}
		$redis->close();
		$this->assign("recommend",$recommend);

		/* 热门 */
		$hot=M("users_live l")
					->field("l.user_nicename,l.avatar,l.uid,l.thumb,l.stream,l.title,l.city,l.islive")
					->join("left join {$prefix}users u on u.id=l.uid")
					->where("l.islive='1' and u.ishot='1'")
					->order("u.isrecommend desc,l.starttime desc")
					->limit(10)
					->select();
		 foreach($hot as $k=>$vi){
			if($vi['thumb']=="")
			{
				$hot[$k]['thumb']=$vi['avatar'];
			}
		} 
		$this->assign("hot",$hot);			 
		
		/* 上午直播 */
		$where1['id'] = array("in", "11827, 11828");
		$where2['uid'] = array("in", "11827, 11828");
		$swlive=M("users")
					->field("id,user_nicename,avatar")
					->where($where1)
					->limit(10)
					->select();
		$swlive_living=M("users_live")->field("uid,avatar,user_nicename,thumb,stream,title,city,islive, topicid")->where($where2)->order("showid desc")->limit(15)->select();
		foreach($swlive as $k=>$vo){
			$swlive[$k]['thumb']=$vo['avatar'];
			$swlive[$k]['uid']=$vo['id'];
			
			foreach($swlive_living as $l=>$lo){
				if($vo['id']==$lo['uid']){
					if($lo['islive']=='1'){
						$swlive[$k]['islive']='1';
					}
					else{
						$swlive[$k]['islive']='0';
					}
				}
			}
		}
		$this->assign("swlive",$swlive);
		/* 下午直播 */
		$where1['id'] = array("in", "11829, 11830, 11831");
		$where2['uid'] = array("in", "11829, 11830, 11831");
		$xwlive=M("users")
					->field("id,user_nicename,avatar")
					->where($where1)
					->limit(10)
					->select();
		$xwlive_living=M("users_live")->field("uid,avatar,user_nicename,thumb,stream,title,city,islive, topicid")->where($where2)->order("showid desc")->limit(15)->select();
		foreach($xwlive as $k=>$vo){
			$xwlive[$k]['thumb']=$vo['avatar'];
			$xwlive[$k]['uid']=$vo['id'];
			
			foreach($xwlive_living as $l=>$lo){
				if($vo['id']==$lo['uid']){
					if($lo['islive']=='1'){
						$xwlive[$k]['islive']='1';
					}
					else{
						$xwlive[$k]['islive']='0';
					}
				}
			}
		}
		$this->assign("xwlive",$xwlive);
		/* 正在直播 */ 
		$live=M("users_live")->field("uid,avatar,user_nicename,thumb,stream,title,city,islive")->where("islive='1'")->order("showid desc")->limit(15)->select();
		$live_tmp = array();
		$filter = [11827, 11828, 11829, 11830, 11831];
		foreach($live as $k=>$vo){
			if($vo['thumb']=="")
			{
				$live[$k]['thumb']=$vo['avatar'];
			}
			if(!in_array($vo['uid'], $filter)){
				array_push($live_tmp, $vo);
			}
		}
		$this->assign("live",$live_tmp);
		/* 主播排行榜 */
	  $anchorlist=M("users_liverecord")->field("uid,sum(nums) as light")->order("light desc")->group("uid")->limit(10)->select();
		foreach($anchorlist as $k=>$v){
			$anchorlist[$k]['userinfo']=getUserInfo($v['uid']);
			/* 判断 当前用户是否关注 */
			if($uid>0){
				$isAttention=isAttention($uid,$v['uid']);
				$anchorlist[$k]['isAttention']=$isAttention;
			}else{
				$anchorlist[$k]['isAttention']=0;
			}
			
		}
		$this->assign("anchorlist",$anchorlist);
		/* 精彩回放 */
		$where1['id'] = array("in", "11959,11960,11961,11962,11963");
		$record=M("users")
					->field("id,user_nicename,avatar")
					->where($where1)
					->limit(10)
					->select();
		foreach($record as $k=>$vo){
			$record[$k]['thumb']=$vo['avatar'];
			$record[$k]['uid']=$vo['id'];
		}
		$this->assign("record",$record);
		
		$config=M("config")->where("id='1'")->find();
		/* 才艺直播 */
		// $live_show_ids=$config['live_show'];
		// $where1['id'] = array("in", $live_show_ids);
		// $where2['uid'] = array("in", $live_show_ids);
		// $live_show=M("users")
		// 			->field("id,user_nicename,avatar")
		// 			->where($where1)
		// 			->limit(10)
		// 			->select();
		// $live_show_living=M("users_live")->field("uid,avatar,user_nicename,thumb,stream,title,city,islive, topicid")->where($where2)->order("showid desc")->limit(15)->select();
		// 
		// foreach($live_show as $k=>$vo){
		// 	$live_show[$k]['thumb']=$vo['avatar'];
		// 	$live_show[$k]['uid']=$vo['id'];
		// 	if($vo['id']==11845||$vo['id']==11846||$vo['id']==11847||$vo['id']==11848){
		// 		$live_show[$k]['islive'] = '1';
		// 	}
		// 	foreach($live_show_living as $l=>$lo){
		// 		if($vo['id']==$lo['uid']){
		// 			if($lo['islive']=='1'){
		// 				$live_show[$k]['islive']='1';
		// 			}
		// 			else{
		// 				$live_show[$k]['islive']='0';
		// 			}
		// 		}
		// 	}
		// }
		// $this->assign("live_show",$live_show);
		/* 才艺回放 */
		// $live_record_ids=$config['live_record'];
		// $where1['id'] = array("in", $live_record_ids);
		// $live_record=M("users")
		// 			->field("id,user_nicename,avatar")
		// 			->where($where1)
		// 			->limit(10)
		// 			->select();
		// foreach($live_record as $k=>$vo){
		// 	$live_record[$k]['thumb']=$vo['avatar'];
		// 	$live_record[$k]['uid']=$vo['id'];
		// }
		// $this->assign("live_record",$live_record);
		$this->assign("title", "首页");
    	$this->display();
    }	
	
	//直播
	public function live(){
		$this->assign("title", "精彩直播");
		$this->display();
	}
	
	//回放
	public function record(){
		$this->assign("title", "精彩回放");
		$this->display();
	}
  
	public function game(){
		$this->assign("title", "游戏");
		$this->display();
	}
	
		public function de(){
		$this->assign("title", "优游互动");
		$this->display();
	}
  
  
}


