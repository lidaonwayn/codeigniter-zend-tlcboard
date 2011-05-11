<?php

class Test extends MY_Controller {

       function __construct()
       {
            parent::__construct();
       }

     function test_debug()
    {
        $this->load->library('firephp');
        $myvariable = array (
          'language' => 'PHP',
          'database' => 'MySQL',
          'blogging platform' => 'WordPress',
          'post' => 'CodeIgniter and FirePHP',
        );
        $this->firephp->log($myvariable);
    }

    function test_zend()
    {
        $this->load->library('firephp');
         $this->load->library('Zend');
         $this->zend->load('Zend/Feed/Reader');

        $feed = new Zend_Feed_Reader();
        $all_feeds = $feed->import('http://my.bugdevelopers.com/?feed=rss2');
        $feeds = array();
        $i = 0;
        foreach($all_feeds as $fd)
        {
            $feeds[$i]['title'] = $fd->getTitle();
            $feeds[$i]['created'] = $fd->getDateCreated();
            $feeds[$i]['description'] = $fd->getDescription();
            $i++;

        }
        $this->firephp->log($feeds);
       // $this->load->view('feed',array('feeds' => $feeds)
    }

    function test_smarty()
    {
        $this->load->library('parser');
        $data['title'] = "The Smarty parser works!";
        $data['body']  = "This is body text to show that the Smarty Parser works!";
        
        // Load the template from the views directory
        $this->parser->parse("test/smartytest.tpl", $data);
    }

    function test_zenddb()
    {
        $this->load->library('firephp');
         $this->load->library('Zend');
         $this->zend->load('Zend/Db');
         $db = Zend_Db::factory('Pdo_Mysql', array(
            'host'     => '127.0.0.1',
            'username' => 'root',
            'password' => 'aum1234',
            'dbname'   => 'tlccms'
        ));
         $sql = 'SELECT * FROM member_center WHERE user_id = ?';
       // $this->firephp->log($db);

        $this->firephp->log($db->fetchAll($sql, 2));
        $this->firephp->log($db->getServerVersion());
    }

    function test_zendcache()
    {
        $this->load->library('firephp');
         $this->load->library('Zend');
         $this->zend->load('Zend/Db');
         $this->zend->load('Zend/Cache');
         $this->load->model('model_test', 'test');
         $db = Zend_Db::factory('Pdo_Mysql', array(
            'host'     => '127.0.0.1',
            'username' => 'root',
            'password' => 'aum1234',
            'dbname'   => 'tlccms'
        ));

        $frontendOpts = array(
		    'caching' => true,
		    'lifetime' => 1800,
		    'automatic_serialization' => true
		);
 
		$backendOpts = array(
    		'servers' =>array(
		        array(
		        'host' => '127.0.0.1',
		        'port' => 11211
		        )
    		),
    		'compression' => true
		);
        
          $cache = Zend_Cache::factory(
            'Core',
            'Memcached',
            $frontendOpts,
            $backendOpts
        );

		$status="no cache";
        //Check to see if the $topStories are cached and look them up if not
         // $cache->remove('topStories');
        if(!$topStories = $cache->load('topStories')){
            //Look up the $topStories
            $status="data in cache";
           	$data = $this->test->fetch(200);

            //Save to the cache, so we don't have to look it up next time
            $cache->save($data, 'topStories');
        }
        $this->firephp->log($cache->load('topStories'));
        $this->firephp->log($status);
     }

    function test_zenddelicious()
    {
        $this->load->library('firephp');
        $this->load->library('Zend');
        $this->zend->load('Zend/Service/Delicious');

        $delicious = new Zend_Service_Delicious('taaum', 'utc17m');
        //$delicious->getTags()
        var_dump($delicious->getTags());
        //exit;
        //$this->firephp->log($delicious->getTags());
//       foreach ($posts as $post) {
//            echo "<br />";
//            echo "Title: {$post->getTitle()}\n";
//            echo "Url: {$post->getUrl()}\n";
//        }
    }

   function test_upgrade()
    {
       $this->load->helper('form');
       $this->load->helper('url');
        //echo form_open('/');
        echo form_open(base_url());
    }

    function test_facebook()
    {
		$this->load->library('firephp');
        $this->load->library('parser');
		$this->load->library('fb_connect',array('appId' => $this->config->item('fb_app_id'),
                            'secret' => $this->config->item('fb_secret_key'),
                            'cookie' => true));
        $data['appID'] = $this->config->item('fb_app_id');
        $data['sess'] = $this->fb_connect->getSession();
        $data['login_url'] = $data['logout_url'] = "";

        if($data['sess'])
        {
            $data['logout_url'] = $this->fb_connect->getLogoutUrl();
            $data['users'] = $this->fb_connect->api('/me');
            //var_dump($data['users']);
           // exit;
        } else
        {
            $data['login_url'] = $this->fb_connect->getLoginUrl();
        }
        $data['json_sess']=json_encode($data['sess']);
		$this->firephp->log($data);

        $this->parser->parse("test/facebook_connect.tpl", $data);
        //$this->load->view('facebook_connect',$data);
    }
    
    function test_tinymce()
    {
        $this->load->library('firephp');
         $this->firephp->log(config_item('assets_path').'js/jquery-1.5.1.min.js');

        $this->load->view('tiny_mce', config_item('assets_path'));
    }

    function test_modelzend()
  {
     $this->load->library('firephp');
    $this->load->model('model_test', 'test');
    $data = $this->test->fetch(200);
    $this->firephp->log($data);
    var_dump($data);
  }

   function test_cachetwolevel(){
   	
   	 	$this->load->library('firephp');
        $this->load->library('Zend');
        $this->zend->load('Zend/Db');
        $this->zend->load('Zend/Cache');
        $this->load->model('model_test', 'test');

        $frontendOpts = array(
		    'caching' => true,
		    'lifetime' => 1800,
		    'automatic_serialization' => true
		);
 
		$fastbackendOpts = array(
    		'servers' =>array(
		        array(
		        'host' => '127.0.0.1',
		        'port' => 11211
		        )
    		),
    		'compression' => true
		);
		
        $options = array( 
        			'slow_backend' => 'Apc', 
        			'fast_backend' => 'Memcached', 
        			'slow_backend_options' => array(), 
        			'fast_backend_options' => $fastbackendOpts, 
        			'stats_update_factor' => 10, 
        			'slow_backend_custom_naming' => false, 
        			'fast_backend_custom_naming' => false, 
        			'slow_backend_autoload' => false, 
        			'fast_backend_autoload' => false, 
        			'auto_refresh_fast_cache' => false 
        			);

        $cache = Zend_Cache::factory(
            'Core',
            'Two Levels',
        	$frontendOpts,
            $options

        );


        //Check to see if the $topStories are cached and look them up if not
         // $cache->remove('topStories');
        if(!$topStories = $cache->load('topStories')){
            //Look up the $topStories

            $this->firephp->log("data in db");
           	$data = $this->test->fetch(200);

            //Save to the cache, so we don't have to look it up next time
            $cache->save($data, 'topStories');
        }
        $this->firephp->log($topStories);
        
   }
   
   function test_zendsession(){
   		$this->load->library('firephp');
   		$this->load->library('Zend');
        $this->zend->load('Zend/Session');
        $defaultNamespace = new Zend_Session_Namespace('Default');
 
		if (isset($defaultNamespace->numberOfPageRequests)) {
		    // this will increment for each page load.
		    $defaultNamespace->numberOfPageRequests++;
		} else {
		    $defaultNamespace->numberOfPageRequests = 1; // first time
		}
		 var_dump("Page requests this session: ".$defaultNamespace->numberOfPageRequests);
		$this->firephp->log("Page requests this session: ".$defaultNamespace->numberOfPageRequests);	        
	}
	
    function test_testget()
    {
         parse_str($_SERVER['QUERY_STRING'],$_GET);
         $this->firephp->log($this->uri->segment(1));
         $this->firephp->log($_GET);
    }

    function securimage_show()
    {  	
       	$this->load->library('securimage/securimage');
        $this->load->library('firephp');
		$img = new Securimage();
                $img->code_length = rand(4,5);
                $img->image_width = 200;
                $img->image_height = 80;
                $img->perturbation = 0.85;
		$img->show(); // alternate use: $img->show('/path/to/background.jpg');

    }
 
    function securimage_play()
    {  	
    	$this->load->library('securimage/securimage');
       	$img    = new Securimage();
		$img->audio_format = (isset($_GET['format']) && in_array(strtolower($_GET['format']), array('mp3', 'wav')) ? strtolower($_GET['format']) : 'mp3');
		//$img->setAudioPath('/path/to/securimage/audio/');
		$img->outputAudioFile();
    }
}



