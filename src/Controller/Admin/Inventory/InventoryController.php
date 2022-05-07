<?php
namespace App\Controller\Admin\Inventory;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/admin/")
 * @IsGranted("ROLE_ADMIN")
 * 
 * @author dRoman <roman3335@gmail.com>
 */
class InventoryController extends AbstractController
{
    /**
     * @Route("inventory", methods="GET", name="inventory_index")
     */
    public function index(): Response
    {
        return $this->render('admin/inventory/index.html.twig');
    }

}
