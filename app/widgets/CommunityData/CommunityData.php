<?php

use Movim\Widget\Base;

use Respect\Validation\Validator;

class CommunityData extends Base
{
    public function load()
    {
        $this->registerEvent('disco_request_handle', 'onDiscoRequest', 'community');
    }

    public function onDiscoRequest($packet)
    {
        list($origin, $node) = $packet->content;

        if ((substr($node, 0, 30) != 'urn:xmpp:microblog:0:comments/')) {
            $this->rpc('MovimTpl.fill', '#community_data', $this->prepareData($origin, $node));
        }
    }

    public function prepareData($origin, $node)
    {
        $view = $this->tpl();
        $info = \App\Info::where('server', $origin)
                         ->where('node', $node)
                         ->first();

        $view->assign('info', $info);
        $view->assign('num', $info ?
            ($info->items > 0)
                ? $info->items
                : \App\Post::where('server', $origin)
                       ->where('node', $node)
                       ->count()
            : 0);

        return $view->draw('_communitydata');
    }

    public function display()
    {
        $this->view->assign('server', $this->get('s'));
        $this->view->assign('node', $this->get('n'));
    }
}
