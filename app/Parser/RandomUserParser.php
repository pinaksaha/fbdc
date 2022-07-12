<?php

namespace App\Parser;

class RandomUserParser
{
    /**
     * @var string
     */
    private $data;

    /**
     * @param $data
     */
    public function __construct($data)
    {
        $this->data = $data;
    }

    /**
     * @return bool
     */
    public function isValidJson()
    {
        json_decode($this->data);
        return json_last_error() === JSON_ERROR_NONE;
    }

    /**
     * @return array
     * @throws \Exception
     */
    public function parse()
    {
        //check if its valid JSON
        if(!$this->isValidJson())
        {
            throw new \Exception("[RandomUserParser] Invalid JSON [".json_last_error() .']');
        }

        $collect = [];
        $users = json_decode($this->data,true);
        $users =  $users['results'];

        foreach ($users as $user)
        {
            $collect[$user['name']['last']] =[
                'title' => $user['name']['title'],
                'last_name' => $user['name']['first'],
                'first_name' => $user['name']['last'],
                'phone' => $user['phone'],
                'email' => $user['email'],
                'country' =>$user['location']['country']
            ];
        }
        $keys = array_keys($collect);
        rsort($keys);
        $sorted = [];
        foreach ($keys as $key){
            $sorted[] = $collect[$key];
        }

        return $sorted;
    }

}
