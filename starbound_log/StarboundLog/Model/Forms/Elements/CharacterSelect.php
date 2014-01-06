<?php

namespace StarboundLog\Model\Forms\Elements;


use StarboundLog\Library\Security\MyAuth;
use Trks\Singletons\TrksDbAdapter;
use Zend\Form\Element\Select;

class CharacterSelect extends Select
{
    public function __construct($name = null, $options = array())
    {
        $options['value_options'] = $this->fetchValueOptions();
        parent::__construct($name, $options);
    }

    protected function fetchValueOptions()
    {
        $characters = [];
        if (MyAuth::hasIdentity()) {
            $q = 'SELECT character_id, character_name FROM users_characters WHERE character_user_id = ?';
            $a = [ MyAuth::getIdentity()->user_id ];
            $characters = TrksDbAdapter::get()->fetchAll($q, $a);
            $characters = array_column($characters, 'character_name', 'character_id');
        }
        $characters[0] = '» none «';
        return $characters;
    }
} 