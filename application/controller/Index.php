<?php
namespace app\controller;
use app\controller\Crawler;

class Index
{

    public function index()
    {
		$search = input('get.search');
		$page = input('get.page',1);
		if (!$search) {
			return view();
		}
		$start_page = 'https://btso.pw/search/' . $search . '/page/' . $page;
		$link_rules = array('#https\://btso\.pw/magnet/detail/hash/#');
		$max_depth = 2;
		$page_conf = array(
		    'http_header' => array(
		        //如果本例子对于你来说运行不成功（发生了错误），那么请将下面的Header
		        //  替换成与你浏览器请求Header一样的内容，但是不要添加Accept-Encoding
		        //  这个Header
		        //If this example can not run successfully, please replace the Headers
		        //  below with the ones exactly you see from your browser. Remember
		        //  not to add Accept-Encoding header.
		        ':authority:btso.pw',
		        ':method:GET',
		        ':path:/search/SNIS-309',
		        ':scheme:https',
		        'accept:text/html,application/xhtml+xml,application/xml;q=0.9,image/webp,*/*;q=0.8',
		        'accept-language:zh-CN,zh;q=0.8',
		        'cookie:AD_adst_b_M_300x50=0; AD_exoc_b_M_300x50=0; AD_jav_b_M_300x50=0; AD_javu_b_M_300x50=0; AD_wav_b_M_300x50=0; AD_wwwp_b_M_300x50=0; AD_clic_b_POPUNDER=2; AD_wige_b_POPUNDER=1; btspread=1%7CSun%2C%2013%20Nov%202016%2012%3A31%3A58%20GMT; AD_jav_b_SM_B_728x90=1; AD_popa_b_POPUNDER=2; AD_exoc_b_POPUNDER=1; splashWeb-1959332-42=1; AD_gung_b_POPUNDER=1; _g.pop.swap=/search/%E8%97%8D%E5%B7%9D%E7%BE%8E%E5%A4%8F; _g.pop=1|Sat, 12 Nov 2016 14:07:37 GMT; AD_wwwp_b_POPUNDER=1; AD_enterTime=1478957583; AD_gala_b_SM_T_728x90=0; AD_jav_b_SM_T_728x90=0; AD_javu_b_SM_T_728x90=0; AD_adst_b_SM_T_728x90=1; AD_adca_b_POPUNDER=1; AD_wav_b_MD_T_728x90=1; AD_jav_b_MD_B_728x90=1; AD_prop_b_POPUNDER=1; AD_wav_b_SM_T_728x90=1; AD_javu_b_SM_B_728x90=4; AD_wav_b_SM_B_728x90=2; _gat=1; _ga=GA1.2.2013216822.1478953908; AD_wwwp_b_SM_T_728x90=4',
		        'referer:https://btso.pw/tags',
		        'upgrade-insecure-requests:1',
		        'user-agent:Mozilla/5.0 (Windows NT 10.0; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/45.0.2454.87 Safari/537.36 QQBrowser/9.2.5584.400',

		        //不要添加Accept-Encoding的Header
		        //Do not add Accept-Encoding Header
		        //'Accept-Encoding: gzip, deflate'
		    )
		);
		$param = [
			'start_page' => $start_page,
			'link_rules' => $link_rules,
			'max_depth' => $max_depth,
			'page_conf' => $page_conf
		];
		$jobs = $this->getJobs($param);
		$this->crawler($jobs);
    }

	public function search()
	{

	}

	public function crawler($jobs)
	{
		$Crawler = new Crawler();
		$Crawler->setFetchJobs($jobs);
		$Crawler->run();
	}

	public function getJobs($param)
	{
		return [
			'job' => [
				'start_page' => $param['start_page'],
		        'link_rules' => $param['link_rules'],
		        'max_depth' => $param['max_depth'],
		        'page_conf' => $param['page_conf']
			]
		];
	}

}
