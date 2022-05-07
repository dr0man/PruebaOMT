<?php
namespace App\Controller\Admin\Accounting;

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
class AccountingController extends AbstractController
{
    /**
     * @Route("accounting", methods="GET", name="accounting_index")
     */
    public function index(): Response
    {
        return $this->render('admin/accounting/index.html.twig');
    }

}
