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
use StarboundLog\Model\Forms\PlanetsFilterForm;
use Zend\Db\Adapter\Driver\Pdo\Result;
use Zend\Db\ResultSet\ResultSet;
use Zend\Db\Sql\Select;
use Zend\Form\Element;
use Zend\Paginator\Adapter\DbSelect;
use Zend\Paginator\Paginator;

class Planets extends MyAbstractController
{
    protected  function sanitizeVersions($versionGroup)
    {
        $versions = explode(",", $versionGroup);
        $versionsSanitized = []; foreach ($versions as $version) $versionsSanitized[] = intval($version);
        return implode(",", $versionsSanitized);
    }

    public function allAction()
    {
        $page         = $this->params()->fromRoute('id', 1);
        $itemsPerPage = 5;

        $form       = new PlanetsFilterForm();
        $formResult = $this->useAnnotationForm($form, 'main', 'all', 'planets', 'main', array('id' => 1));

        $select = new Select(Proxy_planets_visits::get()->getTableName());
        $select->join('planets', 'planet_id = visit_planet_id');
        $select->join('systems', 'system_id = planet_system_id');
        if (!$form->versionGroupId) {
            $form->versionGroupId = 6;
        }
        $select->where(sprintf('system_version_id IN (%s)', $this->sanitizeVersions($form->versionGroupId)));
        if ($form->biomeId != 0) {
            $select->where(['visit_biome_id' => $form->biomeId]);
        }
        if ($form->planetTier != 0) {
            $select->where(['visit_tier' => $form->planetTier]);
        }

        $paginator = new Paginator(new DbSelect($select, Proxy_planets_visits::get()->getDbAdapter(), new ResultSet(ResultSet::TYPE_ARRAYOBJECT, new Row_planets_visits())));
        $paginator->setCurrentPageNumber($page)
            ->setItemCountPerPage($itemsPerPage)
            ->setPageRange(7);

        return array(
            'planets'   => $paginator->getCurrentItems(),
            'paginator' => $paginator,
            'form'      => $formResult->form
        );
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
                    // jeśli w ogóle nie podano który character, albo jeśli znaleziono ten character (i był obecnie zalogowanego usera)
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