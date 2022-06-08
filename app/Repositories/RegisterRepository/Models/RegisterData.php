<?php

namespace App\Repositories\RegisterRepository\Models;

use App\Base\ModelBase;

class RegisterData extends ModelBase {
    var $name;
    var $email;
    var $password;
    var $current_password;
}
