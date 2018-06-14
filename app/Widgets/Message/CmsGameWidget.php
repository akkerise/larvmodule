<?php

namespace App\Widgets\Message;

use Arrilot\Widgets\AbstractWidget;

class CmsGameWidget extends AbstractWidget
{
    /**
     * The configuration array.
     *
     * @var array
     */
    protected $config = [
        'msg' => []
    ];

    /**
     * Treat this method as a controller action.
     * Return view() or other content to display.
     */
    public function run()
    {
        return view('widgets.message.cms_game_widget', [
            'config' => $this->config,
        ]);
    }
}
