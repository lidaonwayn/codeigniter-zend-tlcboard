<?php

/**
 * Hashing library
 * @Author Tee++;
 * @Published 03/06/2009
 * @modifind taaum
 * @modifind_date 22/01/2011
 */
class Hashing {
	
		var $parent_dir;
        var $prefix;
        var $level;
        var $algorithm = 'adler32';
        var $make_dir = TRUE;
        // file tailer
        var $show_file = TRUE;
        var $extension = 'hash';
  
        function __construct($parent_dir,$prefix,$level=3,$make_dir = TRUE)
  		{
  			$this->parent_dir=$parent_dir;
  			$this->prefix=$prefix;
  			$this->level=$level;
  			$this->make_dir = $make_dir ;
  		}
        
        function do_hash($string)
        {
                $hashing = $this->hash_algorithm($string);
                $path = $this->parent_dir;
                if ($hash_dirs = $this->_path($hashing))
                {
                        $path .= '/'.$hash_dirs;
                        if ($this->make_dir)
                                $this->_makePathRecursive($path);
                }
  
                if ($this->show_file)
                {
                        $path .= '/'.$hashing.'.'.$this->extension;
                }
                return $path;
        }
  
        function hash_algorithm($string)
        {
                return hash($this->algorithm, $string);
        }
  
        function _path($string)
        {
                if ($this->level <= 0)
                {
                        return;
                }
  
                $directories = array();
                for ($i=1; $i<=$this->level; $i++)
                {
                        array_push($directories, $this->prefix.substr($string, 0, $i));
                }
                return implode('/', $directories);
        }
  
        function _makePathRecursive($dir)
        {
                if (!is_dir($dir))
                        mkdir($dir, 0777, TRUE);
  
                return TRUE;
        }
  
}


