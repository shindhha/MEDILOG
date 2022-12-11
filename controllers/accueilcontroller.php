<?php
/**
 * yasmf - Yet Another Simple MVC Framework (For PHP)
 *     Copyright (C) 2019   Franck SILVESTRE
 *
 *     This program is free software: you can redistribute it and/or modify
 *     it under the terms of the GNU Affero General Public License as published
 *     by the Free Software Foundation, either version 3 of the License, or
 *     (at your option) any later version.
 *
 *     This program is distributed in the hope that it will be useful,
 *     but WITHOUT ANY WARRANTY; without even the implied warranty of
 *     MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 *     GNU Affero General Public License for more details.
 *
 *     You should have received a copy of the GNU Affero General Public License
 *     along with this program.  If not, see <https://www.gnu.org/licenses/>.
 */

namespace controllers;

use yasmf\View;
use services\UsersService;
use yasmf\HttpHelper;
/**
 * yasmf - Yet Another Simple MVC Framework (For PHP)
 *     Copyright (C) 2019   Franck SILVESTRE
 *
 *     This program is free software: you can redistribute it and/or modify
 *     it under the terms of the GNU Affero General Public License as published
 *     by the Free Software Foundation, either version 3 of the License, or
 *     (at your option) any later version.
 *
 *     This program is distributed in the hope that it will be useful,
 *     but WITHOUT ANY WARRANTY; without even the implied warranty of
 *     MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 *     GNU Affero General Public License for more details.
 *
 *     You should have received a copy of the GNU Affero General Public License
 *     along with this program.  If not, see <https://www.gnu.org/licenses/>.
 */

class AccueilController
{
  private $usersService;

    public function __construct()
    {
        $this->usersService = UsersService::getDefaultUsersService();
    }

    public function index($pdo) {      

      $view = new View("MEDILOG/views/accueil");

      return $view;
    }

    public function searchPage($pdo) {      

      $Designation = HttpHelper::getParam('Designation');
      $typeMedic = HttpHelper::getParam('typeMedic');
      $lab = HttpHelper::getParam('lab');

      $view = new View("MEDILOG/views/recherche");
      $stmt = $this->usersService->getContent($pdo);
      $view->setVar("tabTypes",$stmt[0]);
      $view->setVar("tabLab",$stmt[1]);

      $tab = $this->usersService->constructSQL($pdo,$lab,$typeMedic,$Designation);

      $view->setVar("tab",$tab);

      return $view;
    }

    public function ordoPage($pdo) {      

      $Designation = HttpHelper::getParam('Designation');
      $typeMedic = HttpHelper::getParam('typeMedic');
      $lab = HttpHelper::getParam('lab');
      $insertMedicament = HttpHelper::getParam('insertMedicament');
      $supprimer = HttpHelper::getParam('supprimer');

      if ($insertMedicament != null) {
        $this->usersService->insertMedicament($pdo,$insertMedicament);
      }

      if($supprimer != null) {
        $this->usersService->emptyOrdo($pdo);
      }

      $view = new View("MEDILOG/views/ordonnance");
      $stmt = $this->usersService->getContent($pdo);
      $view->setVar("tabTypes",$stmt[0]);
      $view->setVar("tabLab",$stmt[1]);
      $view->setVar("ordo",$stmt[2]);

      $tab = $this->usersService->constructSQL($pdo,$lab,$typeMedic,$Designation);

      $view->setVar("tab",$tab);

      return $view;
    }

}
