<?php
/**
 * 合并加载JS和CSS文件
 *
 * @author brivio
 */
namespace Common\qscmstag;
defined('THINK_PATH') or exit();
class subject_companyTag {
    protected $params = array();
    protected $map = array();
    public function __construct($options) {
        $array = array(
            '列表名'           =>  'listname',
            '显示数目'          =>  'row',
            '专题公司id'          =>  'id'
        );
        foreach ($options as $key => $value) {
            $this->params[$array[$key]] = $value;
        }
        $this->map['subject_id'] = array('eq',intval($this->params['id']));
        $this->limit = isset($this->params['row'])?intval($this->params['row']):5;
        $this->limit>20 && $this->limit=20;
        $this->params['listname']=isset($this->params['listname'])?$this->params['listname']:"list";
    }
    public function run(){
        if($this->params['paged']){
            $total = M('SubjectCompany')->where($this->map)->count();
            $pager = pager($total, $this->limit);
            $page = $pager->fshow();
            $this->limit = $pager->firstRow.','.$pager->listRows;
            $page_params = $pager->get_page_params();
        }
        $subject_list = M('SubjectCompany')->where($this->map)->select();
        $uids =array();
        foreach ($subject_list as $key => $value) {
            $uids[] = $value['company_uid'];
        }
        if($uids){
            $company = M('CompanyProfile')->where(array('uid'=>array('in',$uids)))->order('refreshtime desc')->getfield('id,uid,audit,companyname,addtime,refreshtime,logo,short_name');
        }
        $cids = array();
        foreach ($company as $key=>$val) {
            //$company[$key] = M('CompanyProfile')->where(array('uid'=>$val['company_uid']))->find();
            $company[$key]['companyname'] = $val['companyname'];
            if ($val['logo'])
            {
                $company[$key]['logo']=attach($val['logo'],'company_logo');
            }
            else
            {
                $company[$key]['logo']=attach('no_logo.png','resource');
            }
            $company[$key]['company_url']=url_rewrite('QS_companyshow',array('id'=>$val['id']));
            $jobs_num = M('Jobs')->where(array('company_id'=>$val['id']))->count();
            $company[$key]['jobs_num'] = $jobs_num;
            $cids[] = $val['id'];
        }
        if($cids){
            $list_map['company_id'] = array('in',$cids);
            if(C('qscms_jobs_display')==1){
                    $list_map['audit'] = 1;
                }
            $jobs_list = M('Jobs')->field('id,jobs_name,minwage,maxwage,company_id')->where($list_map)->order('refreshtime desc')->select();
            foreach ($jobs_list as $k => $v) {
                    if(count($company[$v['company_id']]['jobs']) >= 4) continue;
                    $rows = $v;
                    $v['minwage'] = $v['minwage']%1000==0?($v['minwage']/1000):round($v['minwage']/1000,1);
                    $v['maxwage'] = $v['maxwage']?($v['maxwage']%1000==0?($v['maxwage']/1000):round($v['maxwage']/1000,1)):0;
                    $rows['jobs_url'] = url_rewrite('QS_jobsshow',array('id'=>$v['id']));
                    if($v['maxwage']==0){
                        $rows['wage_cn'] = '面议';
                    }else{
                        if($v['minwage']==$v['maxwage']){
                            $rows['wage_cn'] = $v['minwage'].'K/月';
                        }else{
                            $rows['wage_cn'] = $v['minwage'].'K-'.$v['maxwage'].'K/月';
                        }
                    }
                    if(C('apply.Subsite')){
                        $subsite_id = get_jobs_subsite_id($v);
                        $rows['jobs_url'] = url_rewrite('QS_jobsshow',array('id'=>$v['id']),$subsite_id);
                    }
                    $company[$v['company_id']]['jobs'][] = $rows;
            }
        }   
        $return['list'] = $company;
        return $return;
    }
}