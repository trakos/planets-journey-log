<?php

namespace StarboundLog\Controller\Main;


use StarboundLog\Library\Mvc\MyAbstractController;
use StarboundLog\Library\Security\MyAuth;
use StarboundLog\Model\Database\Proxies\Proxy_planets;
use StarboundLog\Model\Database\Proxies\Proxy_planets_visits;
use StarboundLog\Model\Database\Proxies\Proxy_users;
use StarboundLog\Model\Database\Rows\Row_characters_planets;
use StarboundLog\Model\Database\Rows\Row_planets_visits;
use StarboundLog\Model\Database\Rows\Row_users_characters;
use StarboundLog\Model\Database\Tables\Table_planets_visits;
use StarboundLog\Model\Database\Tables\Table_users_characters;
use StarboundLog\Model\Forms\AddPlanetVisitForm;
use Zend\Form\Element;

class Planets extends MyAbstractController
{
    public function allAction()
    {
    }

    public function myAction()
    {
    }

    /** @noinspection SpellCheckingInspection */
    public function addAction()
    {
        $form       = new AddPlanetVisitForm();
        $formResult = $this->useAnnotationForm($form, 'main', 'add', 'planets');

        if ($formResult->isPost && !$formResult->isValid) {
            $this->flashMessenger()->addErrorMessage('Form validation failed.');
        } else if ($formResult->isPost && $formResult->isValid) {

            $planet = Proxy_planets::get()->getPlanet(
                $form->versionId,
                $form->planetSector,
                $form->planetX,
                $form->planetY,
                $form->planetNumber,
                $form->planetMoon
            );
            $visit  = Proxy_planets_visits::get()->getVisit($planet->planet_id);
            if ($visit) {
                $this->flashMessenger()->addErrorMessage('Planet already visited and commented!');
            } else {

                $character = null;
                if ($form->character) {
                    $character = Row_users_characters::get($form->character);
                    if ($character->character_user_id != MyAuth::getIdentity()->user_id) {
                        $character = null;
                    }
                }

                if ($form->character && !$character) {
                    $this->flashMessenger()->addErrorMessage('Character not found!');
                } else {
                    // jeśli w ogóle nie podano który character, albo jeśli znaleziono ten character i był obecnie zalogowanego usera
                    $visit                  = new Row_planets_visits();
                    $visit->visit_biome_id  = $form->biomeId;
                    $visit->visit_comment   = $form->visitComment;
                    $visit->visit_created   = (new \DateTime())->format(T_DATETIME_FORMAT_MYSQL);
                    $visit->visit_name      = $form->planetName;
                    $visit->visit_planet_id = $planet->planet_id;
                    $visit->visit_rating    = $form->planetRating;
                    $visit->visit_shared    = $form->visitShared;
                    $visit->visit_tier      = $form->planetTier;
                    $visit->visit_user_id   = MyAuth::getIdentity()->user_id;
                    if ($character) {
                        $characterVisit                      = new Row_characters_planets();
                        $characterVisit->chapla_character_id = $form->character;
                        $characterVisit->chapla_notes        = $form->characterComment;
                        $characterVisit->chapla_planet_id    = $planet->planet_id;
                        $characterVisit->save();
                    }
                    $visit->save();
                    $this->flashMessenger()->addSuccessMessage('Planet added!');
                    return $this->redirect()->toRoute('main');
                }
            }
        }

        return array('form' => $formResult->form);
    }

    public function showAction()
    {

    }
} 