<?php
/**
 * Created by IntelliJ IDEA.
 * User: trakos
 * Date: 06.01.14
 * Time: 07:23
 */

namespace StarboundLog\Controller\Main;


use StarboundLog\Library\Mvc\MyAbstractController;
use StarboundLog\Library\Security\MyAuth;
use StarboundLog\Model\Database\Proxies\Proxy_planets_favorites;
use StarboundLog\Model\Database\Rows\Row_users_characters;
use StarboundLog\Model\Database\Tables\Table_planets;
use StarboundLog\Model\Database\Tables\Table_planets_favorites;
use StarboundLog\Model\Database\Tables\Table_users_characters;
use StarboundLog\Model\Forms\CharacterAddForm;
use StarboundLog\Model\Forms\CharacterEditForm;
use StarboundLog\Model\ViewData;
use Zend\View\Model\JsonModel;

class Profile extends MyAbstractController
{
    protected $characterTableUrl;
    protected $queueTableUrl;

    protected function init()
    {
        $this->characterTableUrl = $this->url()->fromRoute('main', array('controller' => 'profile', 'action' => 'characters'));
        $this->queueTableUrl = $this->url()->fromRoute('main', array('controller' => 'profile', 'action' => 'queue'));
    }

    public function favoritesAction()
    {

    }

    public function addToFavoritesAction()
    {
        $id = $this->params()->fromRoute('id', 0);
        if ($id) {
            $planet = Table_planets::get()->getRow($id);
            if ($planet) {
                Proxy_planets_favorites::get()->addFavorite($planet->planet_id);

                return new JsonModel(array(
                    'success' => true
                ));
            }
        }
        return new JsonModel(array(
            'success' => false
        ));
    }

    public function removeFromFavoritesAction()
    {
        $id = $this->params()->fromRoute('id', 0);
        if ($id) {
            $planet = Table_planets::get()->getRow($id);
            if ($planet && Proxy_planets_favorites::get()->hasFavorite($planet->planet_id)) {
                Proxy_planets_favorites::get()->removeFavorite($planet->planet_id);

                return new JsonModel(array(
                    'success' => true
                ));
            }
        }
        return new JsonModel(array(
            'success' => false
        ));
    }

    public function charactersAction()
    {
        return array(
            'characters' => Table_users_characters::get()->filterRows(array('character_user_id' => MyAuth::getIdentity()->user_id))
        );
    }

    public function addCharacterAction()
    {
        ViewData::$formCancelUrl = $this->characterTableUrl;
        $characterAddForm = new CharacterAddForm();
        $formResult       = $this->useAnnotationForm($characterAddForm, 'main', 'add-character', 'profile');

        if ($formResult->isPost && !$formResult->isValid) {
            $this->flashMessenger()->addErrorMessage('Form validation failed.');
        } else if ($formResult->isPost && $formResult->isValid) {
            $character = new Row_users_characters();
            $character->setCharacterUser(MyAuth::getIdentity());
            $character->character_name = $characterAddForm->name;
            $character->save();

            $this->flashMessenger()->addSuccessMessage('Character created!');
            return $this->redirect()->toUrl($this->characterTableUrl);
        }

        return array('form' => $formResult->form);
    }

    public function renameCharacterAction()
    {
        ViewData::$formCancelUrl = $this->characterTableUrl;
        $id            = $this->getRequest()->isPost() ? $this->params()->fromPost('id') : $this->params()->fromRoute('id', 0);
        $userCharacter = Row_users_characters::get($id);

        if (!$userCharacter || $userCharacter->character_user_id != MyAuth::getIdentity()->user_id) {
            $this->flashMessenger()->addErrorMessage('No character with given id found!');
            return $this->redirect()->toUrl($this->characterTableUrl);
        }

        $characterEditForm       = new CharacterEditForm();
        $characterEditForm->id   = $userCharacter->character_id;
        $characterEditForm->name = $userCharacter->character_name;
        $formResult              = $this->useAnnotationForm($characterEditForm, 'main', 'rename-character', 'profile');


        if ($formResult->isPost && !$formResult->isValid) {
            $this->flashMessenger()->addErrorMessage('Form validation failed.');
        } else if ($formResult->isPost && $formResult->isValid) {
            $userCharacter->character_name = $characterEditForm->name;
            $userCharacter->save();

            $this->flashMessenger()->addSuccessMessage('Character renamed!');

            return $this->redirect()->toUrl($this->characterTableUrl);
        } else if (!$formResult->isPost) {
            $formResult->form->get('id')->setValue($userCharacter->character_id);
            $formResult->form->get('name')->setValue($userCharacter->character_name);
        }

        return array('form' => $formResult->form);
    }

    public function removeCharacterAction()
    {
        $id = $this->params()->fromRoute('id', 0);
        if ($id) {
            $userCharacter = Table_users_characters::get()->filterRowsGetFirst(array(
                'character_user_id' => MyAuth::getIdentity()->user_id,
                'character_id'      => $id
            ));
            if ($userCharacter) {
                Table_users_characters::get()->deleteRow($userCharacter->character_id);
                return new JsonModel(array(
                    'success' => true
                ));
            }
        }
        return new JsonModel(array(
            'success' => false
        ));
    }

} 