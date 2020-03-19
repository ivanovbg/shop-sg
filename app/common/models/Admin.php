<?php
namespace SG\Models;

use SG\Helpers\Cache;

class Admin extends Model{

    public function initialize(){
        $this->setSource('admins');
    }
}