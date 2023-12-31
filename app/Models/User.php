<?php

namespace App\Models;

use Kernel\Components\Model\AbstractModel;

class User extends AbstractModel
{
    public int $id;
    public string $name;
    public string $email;
    public string $password;
    public string $created_at;
}