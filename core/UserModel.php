<?php
namespace oo;
use oo\db\DbModel;
abstract class UserModel extends DbModel{
abstract public  function getDisplayName():string;
}