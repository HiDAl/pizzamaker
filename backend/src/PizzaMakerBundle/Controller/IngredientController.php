<?php

namespace PizzaMakerBundle\Controller;

use FOS\RestBundle\Controller\FOSRestController;
use FOS\RestBundle\View\View;
use Symfony\Component\HttpKernel\Exception\HttpException;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

use PizzaMakerBundle\Entity\Ingredient;
use PizzaMakerBundle\Form\IngredientType;

class IngredientController extends FOSRestController {
    public function getIngredientAction(Ingredient $ingredient) {
        return $ingredient;
    }

    /**
    * retrieve all ingredients
    *
    * @return Ingredient[]
    */
    public function getIngredientsAction() {
        $ingredients = $this->getDoctrine()
              ->getRepository('PizzaMakerBundle:Ingredient')
              ->findAll();

        return $ingredients;
    }

    public function postIngredientAction(Request $request) {
        $ingredient = new Ingredient();

        $errors = $this->fillAndValidate($ingredient, $request);

        if (count($errors) > 0) {
            return new View(
                $errors,
                Response::HTTP_UNPROCESSABLE_ENTITY
            );
        }

        $this->persistAndFlush($ingredient);

        return new View($ingredient, Response::HTTP_CREATED);
    }

    public function putIngredientAction(Ingredient $ingredient, Request $request) {
        $id = $ingredient->getId();

        $errors = $this->fillAndValidate($ingredient, $request);

        if (count($errors) > 0) {
            return new View(
                $errors,
                Response::HTTP_UNPROCESSABLE_ENTITY
            );
        }

        $this->persistAndFlush($ingredient);

        return "";
    }


    private function fillAndValidate(Ingredient $ingredient, Request $request) {
        $form = $this->createForm(
            new IngredientType(),
            $ingredient,
            array(
                'method' => $request->getMethod()
            )
        );

        $form->handleRequest($request);

        $errors = $this->get('validator')->validate($ingredient);

        return $errors;
    }

    private function persistAndFlush(Ingredient $ingredient) {
        $manager = $this->getDoctrine()->getManager();
        $manager->persist($ingredient);
        $manager->flush();
    }

}
