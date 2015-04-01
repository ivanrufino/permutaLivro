<?php
 if ( ! defined('BASEPATH')) exit('No direct script access allowed'); 

class Provider {
    public function getProvider_local($rede,$all=false) {
        $dados['Facebook'] = array('id' => '755823537846565', 'secret' => 'bb2ba923ee25e0ce2740803721a14e5f');
        $dados['Google'] = array('id' => '1099466398618-v9otoh2rtol7rpbaddtpfsivfsisvuj5.apps.googleusercontent.com', 'secret' => 'FP3aCzgfsNOp_YgJfP0bcLv4');
        $dados['Instagram']=array('id' => 'b96dc8b4b4eb4964bb522ca88246a1d7','secret' => '4b522ebaad9d47d28d1cdca83185d890');
        $dados['Windowslive'] = array('id' => '0000000048145D2E', 'secret' => 'tNg6gGXoeTNIkGc3JeUWhFhRppuCKVoB');
        $dados['Linkedin'] = array('id' => '78nipe5g2bgn5u', 'secret' => 'NN6BqkpINlUHNnav');
        $dados['Github'] = array('id' => 'ac3e705eb1a6fc9f017e', 'secret' => 'f23063916c478fa6f97374ac445204af993b880e');
        if ($all){
            return $dados;
        }
        return $dados[ucfirst($rede)];
    }
    public function getProvider($rede,$all=false) {
        $dados['Facebook'] = array('id' => '755823537846565', 'secret' => 'bb2ba923ee25e0ce2740803721a14e5f');
        $dados['Google'] = array('id' => '1099466398618-v9otoh2rtol7rpbaddtpfsivfsisvuj5.apps.googleusercontent.com', 'secret' => 'FP3aCzgfsNOp_YgJfP0bcLv4');
        $dados['Instagram']=array('id' => 'b96dc8b4b4eb4964bb522ca88246a1d7','secret' => '4b522ebaad9d47d28d1cdca83185d890');
        $dados['Windowslive'] = array('id' => '0000000048145D2E', 'secret' => 'tNg6gGXoeTNIkGc3JeUWhFhRppuCKVoB');
        $dados['Linkedin'] = array('id' => '78nipe5g2bgn5u', 'secret' => 'NN6BqkpINlUHNnav');
        $dados['Github'] = array('id' => 'ac3e705eb1a6fc9f017e', 'secret' => 'f23063916c478fa6f97374ac445204af993b880e');
        if ($all){
            return $dados;
        }
        return $dados[ucfirst($rede)];
    }
}
