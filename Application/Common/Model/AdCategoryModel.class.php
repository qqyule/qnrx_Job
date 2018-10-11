<?php 
namespace Common\Model;
use Think\Model;
class AdCategoryModel extends Model{
	protected $_validate = array(
		array('categoryname,alias,type_id','identicalNull','',0,'callback'),
		array('type_id,width,height,floating_left,floating_right,floating_top','identicalEnum','',0,'callback'),
		array('alias','1,80','{%ad_category_length_error_alias}',0,'length'),
	);
	protected $_auto = array (
		array('admin_set',0),
		array('theme','_theme',3,'callback'),
		array('org','Home'),
	);
	protected function _theme(){
		return C('qscms_template_dir');
	}
	/**
	 * [ad_cate_cache 广告位缓存]
	 */
	public function ad_cate_cache($tpl,$subsite=0){
		if(C('apply.Subsite')){
			$subsite_list = D('Subsite')->get_subsite_domain();
			$tpl = $subsite_list[$subsite]['s_tpl']?:C('qscms_template_dir');
			$cache = '_'.$subsite;
			$domain = $subsite_list[$subsite]['s_domain']?:str_replace('http://','',C('qscms_site_domain'));
			$path = APP_PATH.C('DEFAULT_MODULE').'/View/'.$tpl.'/Config/'.$domain.'/';
			$where['subsite_id'] = $subsite;
		}else{
			$tpl = $tpl?:C('qscms_template_dir');
			$path = APP_PATH.C('DEFAULT_MODULE').'/View/'.$tpl.'/Config/';
		}
		$where['theme'] = $tpl;
		$time_cache = S('_ads_'.$tpl.$cache)?:0;
		$time = filemtime($path.'config_ads.php')?:1;
		if($time_cache < $time){
			if(!$adcate = F('config_ads','',$path)){
				$path = APP_PATH.C('DEFAULT_MODULE').'/View/'.$tpl.'/Config/';
				$adcate = F('config_ads','',$path);
			}
			if($adcate){
				foreach (C('apply') as $key => $val) {
					if(false !== $temp = F($key.'/Install/config_ads','',APP_PATH)){
						$adcate = array_merge($adcate,$temp);
					}
				}
				foreach ($adcate as $key => $val) {
					$val['theme'] = $tpl;
					isset($where['subsite_id']) && $val['subsite_id'] = $subsite;
					$list[] = $val;
				}
				M('AdCategory')->where($where)->delete();
				$reg = $this->addAll($list);
				$this->_after_insert();
			}
		}
		$adcate = $this->where($where)->getfield('alias,id,org,type_id,categoryname,width,height,float,floating_left,floating_right,floating_top,ad_num,admin_set');
		F('ad_cate_list_'.$tpl.$cache,$adcate);
		return $adcate;
	}
	/**
	 * [ads_init 当前主题下广告位配置信息]
	 */
	public function ads_init($tpl){
		if(C('apply.Subsite')){
			$path = APP_PATH.C('DEFAULT_MODULE').'/View/'.$tpl.'/Config/'.str_replace('http://','',C('qscms_site_domain')).'/';
			$cache = '_0';
		}else{
			$path = APP_PATH.C('DEFAULT_MODULE').'/View/'.$tpl.'/Config/';
		}
		if(!$adcate = F('config_ads','',$path)){
			$path_temp = APP_PATH.C('DEFAULT_MODULE').'/View/'.$tpl.'/Config/';
			$adcate = F('config_ads','',$path_temp)?:array();
		}
		if($ads = F('ad_cate_list_'.$tpl.$cache)){
			foreach ($ads as $key => $val) {
				unset($ads[$key]['id']);
			}
		}
		if(!$this->array_diff_all($adcate,$ads)){
			if(false === $apply = F('apply_list')) $apply = D('Apply')->apply_cache();
			foreach ($apply as $key => $val) {
				if(false !== $temp = F($key.'/Install/config_ads','',APP_PATH)){
					$adcate = array_merge($adcate,$temp);
				}
			}
			F('config_ads',$adcate,$path);
		}
		return true;
	}
	/**
	 * [array_diff_all 多维数组比较]
	 * @param  [type] $a [数组一]
	 * @param  [type] $b [数组二]
	 * @return [type]    [扫完回true/false]
	 */
	protected function array_diff_all($a,$b){
		if(count($a) != count($b)) return false;
		foreach ($a as $key => $val) {
			if(is_array($val)){
				if(!$this->array_diff_all($a[$key],$b[$key])) return false;
			}else{
				if($a[$key] != $b[$key]) return false;
			}
		}
		return true;
	}
	/**
	 * [_after_insert 新增数据后生成广告位]
	 */
	protected function _after_insert($data, $options){
		if(C('apply.Subsite')){
			$ad_data = $this->field('id',true)->where()->select();
	    	foreach ($ad_data as $key => $val) {
	    		$adcate[$val['subsite_id']]['theme'] = $val['theme'];
	    		$adcate[$val['subsite_id']]['ads'][$val['alias']] = $val;
	    	}
	    	$subsite_list = D('Subsite')->get_subsite_domain();
	    	foreach ($adcate as $key => $val) {
	    		$path = C('DEFAULT_MODULE').'/View/'.$val['theme'].'/Config/'.$subsite_list[$key]['s_domain'];
	    		F($path.'/config_ads',$val['ads'],APP_PATH);
		        $time = filemtime(APP_PATH.$path.'/config_ads.php');
		        S('_ads_'.$val['theme'].'_'.$key,$time);
	    	}
		}else{
			$path = APP_PATH.C('DEFAULT_MODULE').'/View/'.C('qscms_template_dir').'/Config/';
			$ad_data = $this->field('id',true)->where(array('theme'=>C('qscms_template_dir')))->select();
	    	foreach ($ad_data as $key => $val) {
	    		$adcate[$val['alias']] = $val;
	    	}
	        F('config_ads',$adcate,$path);
	        $time = filemtime($path.'config_ads.php');
	        S('_ads_'.C('qscms_template_dir'),$time);
		}
	}
	/**
	 * [_after_update 修改数据后生成广告位]
	 */
	protected function _after_update($data, $options){
		$this->_after_insert();
	}
	/**
     * 后台有更新则删除缓存
     */
    protected function _before_write($data, $options) {
    	if(C('apply.Subsite')){
    		$subsite_list = D('Subsite')->get_subsite_domain();
    		foreach ($subsite_list as $key => $val) {
    			F('ad_cate_list_'.$val['s_tpl'].'_'.$val['s_id'], NULL);
    		}
		}
        F('ad_cate_list_'.C('qscms_template_dir'), NULL);
    }
    /**
     * 后台有删除也删除缓存
     */
    protected function _after_delete($data,$options){
    	$this->_after_insert();
        $this->_before_write();
    }
}
?>