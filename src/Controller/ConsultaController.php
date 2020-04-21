<?php

namespace App\Controller;

use App\Entity\Consulta;
use App\Form\ConsultaType;
use App\Repository\ConsultaRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/consulta")
 */
class ConsultaController extends AbstractController
{
    /**
     * @Route("/", name="consulta_index", methods={"GET"})
     */
    public function index(ConsultaRepository $consultaRepository): Response
    {
        $consultas = $consultaRepository->findAll();
        $contenido = array('yes' => 0, 'no' => 0);
        $habilidades = array(
            'ingenio' => 0,
            'conocimientos_generales' => 0,
            'conocimientos_especificos' => 0,
            'redaccion' => 0,
            'comprension' => 0,
        );
        $preguntas = array(
            'calculos' => 0,
            'demostraciones' => 0,
            'opcion_multiple' => 0,
            'trucos' => 0,
            'olimpiada' => 0,
        );

        $temas = array(
            'calculo' => 0,
            'algebra_lineal' => 0,
            'algebra_abstracta' => 0,
            'combinatoria' => 0,
            'probabilidad' => 0,
            'teoria_numeros' => 0,
            'ecuaciones' => 0,
            'geometria_diferencial' => 0,
            'topologia' => 0,
            'fisica' => 0,
        );

        foreach ($consultas as $consulta) {
            if($consulta->getContenido() == true) $contenido['yes']++;
            else $contenido['no']++;

            // Habilidades
            if(in_array('Ingenio e inventiva', $consulta->getHabilidades())) $habilidades['ingenio']++;
            if(in_array('Conocimientos generales', $consulta->getHabilidades())) $habilidades['conocimientos_generales']++;
            if(in_array('Conocimientos de materias específicas', $consulta->getHabilidades())) $habilidades['conocimientos_especificos']++;
            if(in_array('Claridad en redacción de soluciones', $consulta->getHabilidades())) $habilidades['redaccion']++;
            if(in_array('Comprensión de la teoría', $consulta->getHabilidades())) $habilidades['comprension']++;

            // Preguntas
            if(in_array('Cálculos rutinarios', $consulta->getPreguntas())) $preguntas['calculos']++;
            if(in_array('Demostraciones sencillas', $consulta->getPreguntas())) $preguntas['demostraciones']++;
            if(in_array('Opción múltiple', $consulta->getPreguntas())) $preguntas['opcion_multiple']++;
            if(in_array('Trucos ingeniosos', $consulta->getPreguntas())) $preguntas['trucos']++;
            if(in_array('Preguntas tipo olimpiada', $consulta->getPreguntas())) $preguntas['olimpiada']++;

            // Temas
            if(in_array('Calculo', $consulta->getTemas())) $temas['calculo']++;
            if(in_array('Álgebra lineal', $consulta->getTemas())) $temas['algebra_lineal']++;
            if(in_array('Álgebra abstracta', $consulta->getTemas())) $temas['algebra_abstracta']++;
            if(in_array('Combinatoria', $consulta->getTemas())) $temas['combinatoria']++;
            if(in_array('Probabilidad', $consulta->getTemas())) $temas['probabilidad']++;
            if(in_array('Teoría de números', $consulta->getTemas())) $temas['teoria_numeros']++;
            if(in_array('Ecuaciones diferenciales', $consulta->getTemas())) $temas['ecuaciones']++;
            if(in_array('Geometría diferencial', $consulta->getTemas())) $temas['geometria_diferencial']++;
            if(in_array('Topología', $consulta->getTemas())) $temas['topologia']++;
            if(in_array('Física', $consulta->getTemas())) $temas['fisica']++;

        }

        return $this->render('consulta/index.html.twig', [
            'consultas' => $consultas,
            'contenido' => $contenido,
            'habilidades' => $habilidades,
            'preguntas' => $preguntas,
            'temas' => $temas,
        ]);
    }

    /**
     * @Route("/new", name="consulta_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $consultum = new Consulta();
        $form = $this->createForm(ConsultaType::class, $consultum);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($consultum);
            $entityManager->flush();

            return $this->redirectToRoute('consulta_index');
        }

        return $this->render('consulta/new.html.twig', [
            'consultum' => $consultum,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="consulta_show", methods={"GET"})
     */
    public function show(Consulta $consultum): Response
    {
        return $this->render('consulta/show.html.twig', [
            'consultum' => $consultum,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="consulta_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Consulta $consultum): Response
    {
        $form = $this->createForm(ConsultaType::class, $consultum);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('consulta_index');
        }

        return $this->render('consulta/edit.html.twig', [
            'consultum' => $consultum,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="consulta_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Consulta $consultum): Response
    {
        if ($this->isCsrfTokenValid('delete'.$consultum->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($consultum);
            $entityManager->flush();
        }

        return $this->redirectToRoute('consulta_index');
    }
}
