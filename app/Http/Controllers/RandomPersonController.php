<?php

namespace App\Http\Controllers;

use App\Formatter\RandomPersonFormatter;
use App\Gateway\RandomUserGateway;
use App\Parser\RandomUserParser;
use GuzzleHttp\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class RandomPersonController extends Controller
{
    /**
     * @param $numberOfUsers
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Http\JsonResponse|\Illuminate\Http\Response
     */
    public function getUsersXml($numberOfUsers = 1)
    {
        if(empty($numberOfUsers))
        {
            $numberOfUsers = 1;
        }
        if(!intval($numberOfUsers))
        {
            return response()->json([
                'error' => "number of users must be an integer"
            ],400);
        } else {
            try{
                $client = new Client();
                $gateway = new RandomUserGateway($client);
                $users = $gateway->getRandomUser($numberOfUsers);
                $parser = new RandomUserParser($users);
                $xml = RandomPersonFormatter::toXml($parser->parse());
                return response($xml,200,[
                    'Content-Type' => 'application/xml'
                ]);
            }
            catch (\GuzzleHttp\Exception\GuzzleException $exception)
            {
                Log::error("[RandomPersonController][getUsersXml][GuzzleException]". $exception->getMessage(),[
                    'exception' => $exception
                ]);
                return response()->json([
                    'error' => "Something Went wrong [". $exception->getMessage().']'
                ],400);
            }
            catch (\Throwable $exception) {
                Log::error("[RandomPersonController][getUsersXml]". $exception->getMessage(),[
                    'exception' => $exception
                ]);
                return response()->json([
                    'error' => "Something Went wrong [". $exception->getMessage().']'
                ],400);
            }

        }
    }
}
