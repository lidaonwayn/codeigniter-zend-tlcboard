<?php

class Model_test extends MY_Model {

    function __construct()
    {
       parent::__construct();
    }

    function fetchAll()
    {
       $select = parent::select();
       $select->from('category')->order('cate_id DESC');
       return parent::fetchAll($select);
    }

    function fetch($id)
    {
     // if ($row = parent::cacheLoad('category'.$id))
     // {
         $select = parent::select();
         $select->from('category')->where('cate_id=?', $id);
         return parent::fetchRow($select);
      //   parent::cacheSave('category' . $id, $row);
     // }
    }

    function update($data, $id)
    {
       if (parent::update('category', $data, 'cate_id=' . $id))
      {
          parent::cacheRemove('category'.$id);
      }
      return true;
    }

    function delete($id)
    {
       if (parent::delete('category', 'cate_id=' . $id))
       {
          parent::cacheRemove('category' . $id);
       }
       return true;
    }

    function insert($data)
    {
       return parent::insert('category', $data);
    }
}

?>
