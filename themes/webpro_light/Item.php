<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class Item extends CActiveRecord {

    public $image;

    // ... other attributes

    public function rules() {
        return array(
            array('image', 'file', 'types' => 'jpg, gif, png'),
        );
    }

}
