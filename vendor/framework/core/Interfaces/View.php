<?php 

namespace Framework\Interfaces;

interface View 
{
    public function render($template, $params = array());
}