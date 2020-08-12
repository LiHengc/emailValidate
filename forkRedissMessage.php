<?php

function fork(){
    #获取队列号
    $msg_key = ftok( __FILE__, 'a' );

    $pid = pcntl_fork();
    $short_url = "";
    $time_out = 5;
    $redis_facory = new Redis();
    $redis_facory->connect('127.0.0.1');
    if ($pid == -1){
        return [
            'status'=>false,
            'msg'=>'pcntl error'
        ];
    }else if ($pid){
    //        $processid = getmypid();
//        pcntl_waitpid($pid,$status,WNOHANG);
        echo "没有足赛";
        while($time_out){
            $time_out--;
            sleep(1);
            $message = $redis_facory->get($msg_key);
            if ($message){
                $short_url = $message;
                $time_out = 0;
            }
        }
        #删除队列
        $redis_facory->del($msg_key);
        if (!$short_url){
            return [
                'status'=>false,
                'msg'=>'time out'
            ];
        }else{
            return [
                'status'=>true,
                'msg'=>$short_url
            ];
        }
    }else{
        sleep(7);
        $short_url = 123;
        $redis_facory->set($msg_key,$short_url,300);
        die;
    }



}
var_dump(fork());
$product = [];
urlencode('http://www.amazon.'.
$this->site->suffix.'/dp/'.
$product->asin.'?m='.
$product->merchantID.''.
$product->parentAsin?'&th=1&psc=1':'');
