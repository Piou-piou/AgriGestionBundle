<?php

namespace PiouPiou\AgriGestionBundle\Controller;

use PiouPiou\RibsAdminBundle\Entity\Module;
use PiouPiou\RibsAdminBundle\Service\AccessRights;
use PiouPiou\RibsAdminBundle\Service\Globals;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;

class NavigationBuilderController extends AbstractController
{
    /**
     * @param Globals $globals
     * @param AccessRights $access_rights
     * @return Response
     */
    public function getPageNavigation(Globals $globals, AccessRights $access_rights): Response
    {
        $module = $this->getDoctrine()->getRepository(Module::class)->findOneBy(["packageName" => "piou-piou/agri-gestion-bundle"]);
        $navigation = json_decode(file_get_contents($globals->getBaseBundlePath($module->getPackageName(), $module->getDevMode()) . "/Resources/json/navigation.json"), true);
        dump($navigation);
        $nav = [];
        foreach ($navigation["items"] as $item) {
            if ($access_rights->testRight($item["right"]) && isset($item["position"]) && $item["position"] === "top") {
                $nav[] = $item;
            }
        }

        return $this->render("@AgriGestion/admin/navigation.html.twig", ["navigation" => $nav]);
    }
}
