<?php

/**
 * This file is part of the Accard package.
 *
 * (c) University of Pennsylvania
 *
 * For the full copyright and license information, please view the
 * LICENSE file that was distributed with this source code.
 */
namespace Accard\Bundle\WebBundle\EventListener;

use Knp\Menu\ItemInterface;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Accard\Bundle\WebBundle\MenuEvents;
use Accard\Bundle\WebBundle\Event\MenuBuilderEvent;

/**
 * Frontend menu subscriber.
 *
 * Creates the default secondary menu structure for the frontend menus.
 *
 * @author Frank Bardon Jr. <bardonf@upenn.edu>
 */
class FrontendMenuSubscriber implements EventSubscriberInterface
{
    /**
     * Create secondary sidebar items.
     *
     * @param MenuBuilderEvent $event
     */
    public function createSidebarItems(MenuBuilderEvent $event)
    {
        $menu = $event->getMenu();
        $route = str_replace('accard_frontend_', '', $event->getRequest()->attributes->get('_route'));
        $baseRoute = explode('_', $route)[0];

        $repositories = $menu->getChild('repositories');
        $patient = $this->createSimpleItem($event, $repositories, 'patient', 'patient_index', 'patients');

        if ('patient' === $baseRoute) {
            $patient->setCurrent(true);
        } elseif ('import' === $baseRoute) {
            $import = $menu->getchild('import');
            $import->setCurrent(true);
        }
    }

    /**
     * Create simple menu item.
     *
     * @param MenuBuilderEvent $event
     * @param ItemInterface $menu
     * @param string $name
     * @param string $route
     * @param string $label
     * @return ItemInterface
     */
    private function createSimpleItem(MenuBuilderEvent $event, ItemInterface $menu, $name, $route, $label)
    {
        $route = 'accard_frontend_'.$route;
        $label = 'accard.menu.frontend.'.$label;

        return $menu->addChild($name, array('route' => $route))->setLabel($event->translate($label));
    }

    /**
     * {@inheritdoc}
     */
    public static function getSubscribedEvents()
    {
        return array(
            MenuEvents::FRONTEND_SIDEBAR => array('createSidebarItems', 999),
        );
    }
}
