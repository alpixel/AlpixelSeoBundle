<?php

namespace Alpixel\Bundle\SEOBundle\Sitemap\Url;

/**
 * decorated url model.
 *
 * @author David Epely
 */
abstract class UrlDecorator implements UrlInterface
{
    protected $urlDecorated;
    protected $customNamespaces = array();

    /**
     * @param Url $urlDecorated
     */
    public function __construct(Url $urlDecorated)
    {
        $this->urlDecorated = $urlDecorated;
    }

    /**
     * @return array
     */
    public function getCustomNamespaces()
    {
        return array_merge($this->urlDecorated->getCustomNamespaces(), $this->customNamespaces);
    }
}
