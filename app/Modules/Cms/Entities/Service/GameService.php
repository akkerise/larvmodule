<?php

namespace App\Modules\Cms\Entities\Service;

use App\Modules\Cms\Repositories\Game\GameRepository;
use App\Modules\Cms\Entities\Model\Game;

class GameService
{

    protected $game;

    public function __construct(GameRepository $game)
    {
        $this->game = $game;
    }

    public function findId($gameId){
        return $this->game->find($gameId);
    }

    public function store(array $input)
    {
        try {
            \DB::beginTransaction();
            $result = $this->game->store($input);
            \DB::commit();
        } catch (\Exception $e) {
            logger()->error(sprintf('create game fails. data: %s, exception: %s', json_encode($input), $e->getMessage()));
            \DB::rollBack();
            $result = false;
        }
        logger()->debug('#', ['result' => (bool)$result]);
        return $result;
    }

    public function update(Game $game, array $input)
    {
        try {
            \DB::beginTransaction();
            $result = $this->game->update($game, $input);
            \DB::commit();
        } catch (\Exception $e) {
            logger()->error(sprintf('update operator fails. id: %d, data: %s, exception: %s', $game->id, json_encode($input), $e->getMessage()));
            \DB::rollBack();
            $result = false;
        }
        logger()->debug('#', ['result' => (bool)$result, 'id' => $game->id]);
        return $result;
    }


    public function del(Game $game){
        try {
            \DB::beginTransaction();
            $result = $this->game->delete($game);
            \DB::commit();
            $result = true;
        } catch (\Exception $e) {
            logger()->error(sprintf('delete operator fails. id: %d, data: %s, exception: %s', $game->id, json_encode($id), $e->getMessage()));
            \DB::rollBack();
            $result = false;
        }
        logger()->debug('#', ['result' => (bool)$result]);
        return $result;
    }

    /**
     * get list game with user
     * @return collection
     */
    public function listGamesUsers()
    {
        $result = $this->game->listGamesUsers();
        logger()->debug('#', ['result' => $result]);
        return $this->game->listGamesUsers();
    }

    /**
     * Find by id
     *
     * @param int $id
     * @return \Illuminate\Database\Eloquent\Collection|\Illuminate\Database\Eloquent\Model
     */
    public function findOrFail(int $id)
    {
        $result = $this->game->findOrFail($id);
        logger()->debug('#', ['result' => $result->count()]);
        return $result;
    }

    /**
     * Find by id
     *
     * @param int $id
     * @return \Illuminate\Database\Eloquent\Collection|\Illuminate\Database\Eloquent\Model
     */
    public function listStatus()
    {
        $result = $this->game->listStatus();
        logger()->debug('#', ['result' => $result->count()]);
        return $result;
    }

    /*
     * Find by condition
     * @param array condition
     * @return model
     */

    public function findByCondition(array $condition = []){
        return $this->game->findBy($condition);
    }

}
