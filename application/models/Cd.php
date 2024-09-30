<?php
class Application_Model_Cd extends Zend_Db_Table_Abstract
{
    protected $_name = 'cds';


    public function fetchAllCds()
    {
        return $this->fetchAll();
    }

    public function createCd($data)
    {
        // first, We verify if the cd exists
        $where = $this->getAdapter()->select()->from($this->_name)->where('title = ?', $data['title'])->where('artist = ?', $data['artist']);
        $resCondition = $this->getAdapter()->fetchRow($where);
        if ($resCondition) {
            return 'exists';
        }
        return $this->insert($data);
    }
}
