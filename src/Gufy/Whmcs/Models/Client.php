<?php namespace Gufy\Whmcs\Models;
use Validator;
class Client extends Base
{
  public function getAll($query=array())
  {
    return $this->execute('getclients',$query)
    ->clients
    ->client;
  }

  public function getFind($id)
  {
    $validator = Validator::make(['id'=>$id], [
      'id'=>'email'
    ]);
    if($validator->fails())
    $client = $this->execute('getclientsdetails',['clientid'=>$id]);
    else
    $client = $this->execute('getclientsdetails',['email'=>$id]);
    return $client;
  }

}
