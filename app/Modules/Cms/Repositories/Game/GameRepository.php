<?php

namespace App\Modules\Cms\Repositories\Game;

use App\Common\Repos\EloquentRepository;
use App\Modules\Cms\Entities\Model\Game;

class GameRepository
{
    use EloquentRepository;

    protected $_model;


    public function __construct(Game $game)
    {
        $this->_model = $game;
    }

    /**
     * get list game with user
     * @return collection
     */
    public function listGamesUsers()
    {
        return $this->_model
            ->join('h5_users', 'h5_games.user_id', '=', 'h5_users.id')
            ->select(['h5_games.id AS game_id', 'h5_games.name', 'h5_games.status', 'h5_games.logo', 'h5_games.slug', 'h5_users.email'])
            ->get();
    }

    public function listStatus()
    {
        return $this->_model->select('h5_games.status')->distinct('status')->get();
    }

    public function findBy(array $condition = [])
    {
        return $this->_model->where($condition)->get();
    }

    public function del($id)
    {
        return $this->_model->find($id)->delete();
    }
}
