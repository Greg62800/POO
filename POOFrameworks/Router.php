<?php

namespace POO;


/**
 * @property  routes
 */
class Router
{

    private static $routes = [];

    public function __construct()
    {
    }

    public static function parser($url, $request)
    {
        $config = require ROOT . DS . 'config' . DS . 'App.php';
        $url = trim($url, '/');
        $match = false;
        foreach(Router::$routes as $v) {
            if(!$match && preg_replace($v['redirreg'], $url, $match)) {
                $url = $v['origin'];
                foreach($match as $k => $v) {
                    $url = str_replace("{$k}", $v, $url);
                }
                $match = true;
            }
        }

        $params = explode('/', $url);
        if(empty($params[4])) {
            $params[4] = $config['defaultController'];
        }
        $request->controller = $params[4];
        $request->action = isset($params[5]) ? $params[5] : 'index';

        $request->params = array_slice($params, 2);
        return true;
    }

    public static function connect($redir, $url)
    {
        $r = array();
        $r['params'] = array();
        $r['url'] = $url;

        $r['originreg'] = preg_replace('/([a-z0-9]+):([^\/]+)/','${1}:(?P<${1}>${2})',$url);
        $r['originreg'] = str_replace('/*','(?P<args>/?.*)',$r['originreg']);
        $r['originreg'] = '/^'.str_replace('/','\/',$r['originreg']).'$/';
        // MODIF
        $r['origin'] = preg_replace('/([a-z0-9]+):([^\/]+)/',':${1}:',$url);
        $r['origin'] = str_replace('/*',':args:',$r['origin']);

        $params = explode('/',$url);
        foreach($params as $k=>$v){
            if(strpos($v,':')){
                $p = explode(':',$v);
                $r['params'][$p[0]] = $p[1];
            }
        }

        $r['redirreg'] = $redir;
        $r['redirreg'] = str_replace('/*','(?P<args>/?.*)',$r['redirreg']);
        foreach($r['params'] as $k=>$v){
            $r['redirreg'] = str_replace(":$k","(?P<$k>$v)",$r['redirreg']);
        }
        $r['redirreg'] = '/^'.str_replace('/','\/',$r['redirreg']).'$/';

        $r['redir'] = preg_replace('/:([a-z0-9]+)/',':${1}:',$redir);
        $r['redir'] = str_replace('/*',':args:',$r['redir']);

        self::$routes[] = $r;
    }
}