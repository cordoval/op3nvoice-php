<?php

namespace OP3Nvoice;

use OP3Nvoice\Exceptions\InvalidJSONException;

class Metadata extends Subresource
{
    protected $subresource = 'o3v:metadata';

    /**
     * @param $id
     * @param $data
     * @param string $version
     * @return bool
     * @throws Exceptions\InvalidJSONException
     */
    public function update($id, $data, $version = '')
    {
        $resourceURI = $this->getSubresourceURI($id);

        $ob = json_decode($data);
        if($data != '' && $ob === null) {
            throw new InvalidJSONException();
        }

        $request = $this->client->put($resourceURI, array(), '', array('exceptions' => false));
        $request->setPostField('data', $data);
        $request->setPostField('version', $version);
        $response = $this->process($request);

        $this->detail = $response->json();

        return $response->isSuccessful();
    }
}