<?php

namespace App\Formatter;

class RandomPersonFormatter
{
    /**
     * @param array $users
     * @return bool|string
     * @throws \Exception
     */
    public static function toXml(array $users)
    {
        $root = '<?xml version="1.0" encoding="UTF-8"?><Users/>';
        $xml  = new \simpleXMLElement($root);

        foreach ($users as $user)
        {
            $child = $xml->addChild('User');
            $child->addAttribute('title',$user['title']);
            $child->addAttribute('last_name',$user['last_name']);
            $child->addAttribute('first_name',$user['first_name']);
            $child->addAttribute('phone',$user['phone']);
            $child->addAttribute('email',$user['email']);
            $child->addAttribute('country',$user['country']);
        }

        return $xml->asXML();
    }
}
