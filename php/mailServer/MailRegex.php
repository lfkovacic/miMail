<?php 
class MailRegex{
    public function getHost(){
        return "/[a-z]*@([a-z]+\.[a-z]+)/";
    }
}