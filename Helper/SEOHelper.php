<?php


namespace Alpixel\Bundle\SEOBundle\Helper;

use Sonata\SeoBundle\Seo\SeoPageInterface;
use Symfony\Component\HttpFoundation\RequestStack;
use Symfony\Component\Routing\Router;
use Symfony\Component\Routing\RouterInterface;


/**
 * @author Benjamin HUBERT <benjamin@alpixel.fr>
 */
class SEOHelper
{

    private $requestStack;
    private $enabledLocales;
    private $seoHelper;
    private $router;

    public function __construct(
        RequestStack $requestStack,
        $enabledLocales,
        SeoPageInterface $seoHelper,
        RouterInterface $router
    ) {
        $this->requestStack = $requestStack;
        $this->enabledLocales = $enabledLocales;
        $this->seoHelper = $seoHelper;
        $this->router = $router;
    }

    public function generateAlternateLangLinks($extraParams = [])
    {
        $request = $this->requestStack->getMasterRequest();
        $route = $request->attributes->get('_route');

        foreach ($this->enabledLocales as $locale) {
            $this->seoHelper->addLangAlternate(
                $this->router->generate(
                    $route,
                    array_merge(
                        $request->attributes->get('_route_params'),
                        [
                            '_locale' => $locale,
                        ],
                        $extraParams
                    ),
                    Router::ABSOLUTE_URL
                ),
                $locale
            );
        }
    }


}