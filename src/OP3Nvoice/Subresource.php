<?php

namespace OP3Nvoice;

abstract class Subresource extends Client
{
    /**
     * @param $id
     * @return mixed
     */
    protected function getSubresourceURI($id)
    {
        $request = $this->client->get($id, array(), array('exceptions' => false));
        $response = $this->process($request);

        $bundle = $response->json();

        return $bundle['_links'][$this->subresource]['href'];
    }

    /**
     * @param $id
     * @return array|bool|float|int|string
     */
    public function load($id)
    {
        $resourceURI = $this->getSubresourceURI($id);

        return parent::load($resourceURI);
    }

    /**
     * @param $id
     * @return bool
     */
    public function delete($id)
    {
        $resourceURI = $this->getSubresourceURI($id);

        return parent::delete($resourceURI);
    }
}