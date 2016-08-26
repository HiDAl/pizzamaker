<?php

namespace PizzaMakerBundle\Controller;

use FOS\RestBundle\Controller\FOSRestController;
use FOS\RestBundle\View\View;
use Symfony\Component\HttpKernel\Exception\HttpException;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

use PizzaMakerBundle\Entity\Pizza;
use PizzaMakerBundle\Form\PizzaType;
use PizzaMakerBundle\Entity\Ingredient;

class PizzaController extends FOSRestController {
    public function getPizzaAction(Pizza $pizza) {
        return $pizza;
    }

    /**
    * retrieve all pizzas
    *
    * @return Pizza[]
    */
    public function getPizzasAction() {
        error_log('asdasd');
        $pizzas = $this->getDoctrine()
              ->getRepository('PizzaMakerBundle:Pizza')
              ->findAll();

        return $pizzas;
    }

    public function postPizzaAction(Request $request) {
        $pizza = new Pizza();

        $errors = $this->fillAndValidate($pizza, $request);

        if (count($errors) > 0) {
            return new View(
                $errors,
                Response::HTTP_UNPROCESSABLE_ENTITY
            );
        }

        $this->persistAndFlush($pizza);

        return new View($pizza, Response::HTTP_CREATED);
    }

    public function putPizzaAction(Pizza $pizza, Request $request) {
        $id = $pizza->getId();

        $errors = $this->fillAndValidate($pizza, $request);

        if (count($errors) > 0) {
            return new View(
                $errors,
                Response::HTTP_UNPROCESSABLE_ENTITY
            );
        }

        $this->persistAndFlush($pizza);

        return "";
    }

    public function deletePizzaAction(Pizza $pizza) {
        $manager = $this->getDoctrine()->getManager();
        $manager->remove($pizza);
        $manager->flush();
    }

    private function fillAndValidate(Pizza $pizza, Request $request) {
        $form = $this->createForm(
            new PizzaType(),
            $pizza,
            array(
                'method' => $request->getMethod()
            )
        );

        $form->handleRequest($request);

        $errors = $this->get('validator')->validate($pizza);

        return $errors;
    }

    private function persistAndFlush(Pizza $pizza) {
        $manager = $this->getDoctrine()->getManager();
        $manager->persist($pizza);
        $manager->flush();
    }

}
