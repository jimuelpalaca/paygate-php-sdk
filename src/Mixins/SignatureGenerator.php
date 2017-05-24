<?php namespace CoreProc\Paynamics\Paygate\Mixins;

use CoreProc\Paynamics\Paygate\ClientInterface;

trait SignatureGenerator
{
    public function generateRequestSignature(ClientInterface $client)
    {
        $signString = $this->mid .
            $this->request_id .
            $this->ip_address .
            $this->notification_url .
            $this->response_url .
            $this->fname .
            $this->lname .
            $this->mname .
            $this->address1 .
            $this->address2 .
            $this->city .
            $this->state .
            $this->country .
            $this->zip .
            $this->email .
            $this->phone .
            $this->client_ip .
            $this->amount .
            $this->currency .
            $this->secure3d;

        $cert = $client->getMerchantKey();

        return hash('sha512', $signString . $cert);
    }
}