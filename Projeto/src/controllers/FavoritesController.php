<?php
namespace src\controllers;

use \core\Controller;
use \src\models\Usuario;
use \src\models\Favorite;
use \src\models\Review;
use \src\Config;

class FavoritesController extends Controller {

    public function add_favorite_api($ids) {
        $favorite = Favorite::addFavorite($ids['user'], $ids['project']);
    
        if ($favorite) {
            $this->returnJson(['success' => true]);
        } else {
            $this->returnJson(['success' => false]);
        }
    }

    public function remove_favorite_api($ids) {
        $favorite = Favorite::removeFavorite($ids['project'], $ids['user']);
    
        if ($favorite) {
            $this->returnJson(['success' => true]);
        } else {
            $this->returnJson(['success' => false]);
        }
    }

    public function check_favorite_api($ids) {
        $favorite = Favorite::checkFavorite((int)$ids['user'],(int)$ids['project']);
        if ($favorite) {
            $this->returnJson(['favorited' => true]);
        } else {
            $this->returnJson(['favorited' => false]);
        }
    }

    public function get_all_Favorites_api($id) {
        $userId = $id['id'];
        $projects = Favorite::getAllFavorites($userId);
        $this->returnJson($projects);
    }

    public function returnJson($array) {
        header("Content-Type: application/json");
        echo json_encode($array);
        exit;
    }
}