<?php

namespace App\Controller;

use App\Form\TemperatureForm;
use App\Services\MKT\{MKTCreator, MKTFetcher};
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\{Request, Response};
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class KineticTemperatureController extends AbstractController
{
    private MKTCreator $mktCreator;

    private MKTFetcher $mktFetcher;
    
    /**
     * KineticTemperatureController constructor
     *
     * @param MKTCreator $mktCreator
     */
    public function __construct(
        MKTCreator $mktCreator,
        MKTFetcher $mktFetcher
    ) {
        $this->mktCreator = $mktCreator;
        $this->mktFetcher = $mktFetcher;
    }

    /**
     * @Route("/", name="index")
     * 
     * @param Request $request
     *
     * @return Response
     * @throws Exception
     */
    public function index(Request $request): Response
    {
        $form = $this->createForm(TemperatureForm::class);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $kineticTemp = $this->mktCreator->readFile($form->get('documents')->getData());
            $this->addFlash($kineticTemp['status'], $kineticTemp['message']);
        }
        
        return $this->render('mkt/index.html.twig', [
            'form' => $form->createView(),
            'mktList' => $this->mktFetcher->getAllMKT(),
        ]);
    }

    /**
     * @Route("/MKT/{id}", name="view", requirements={"id"="\d+"})
     * 
     * @param int $id
     * 
     * @return Response
     */
    public function view($id): Response
    {
        // dd($this->mktFetcher->getDataSet($id));
        return $this->render('mkt/view.html.twig', [
            'form' => [],
            'dataSetList' => $this->mktFetcher->getDataSet($id),
            'setName' => $this->mktFetcher->getMKT($id)->getDataSetName(),
        ]);
    }
}
