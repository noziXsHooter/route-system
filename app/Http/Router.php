<?php 

namespace App\Http;

use \Closure;
use \Exception;

class Router{
    
    /**
     * Url completa do projeto
     *
     * @var string
     */
    private $url = '';

    /**
     * Prefixo de todas as rotas
     *
     * @var string
     */
    private $prefix = '';

    /**
     * Indice de rotas
     *
     * @var array
     */
    private $routes = [];

    /**
     * Instancia de Request
     *
     * @var Request
     */
    private $request;

        
    /**
     * Método responsavel por inciar a classe
     * @return string $url
     */
    public function __construct($url)
    {
        $this->request = new Request();
        $this->url = $url;
        $this->setPrefix();
    }

    /**
     * Método responsavel por inciar a classe
     * @return string $url
     */
    public function setPrefix()
    {
        //INFORMAÇOES DA URL ATUAL
        $parseUrl = parse_url($this->url);

        //DEFINE O PREFIXO
        $this->prefix = $parseUrl['path'] ?? '';
    }
    
    /**
     * Metodo responsavel por adicionar uma rota na classe
     *
     * @param  string $method
     * @param  string $route
     * @param  array$params
     */
    private function addRoute($method, $route, $params=[])
    {
        //VALIDAÇÃO DOS PARÂMETROS
        foreach ($params as $key => $value) {
            if($value instanceof Closure){
                $params['controller'] = $value;
                unset($params[$key]);
                continue;
            }
        }

        //PADRAO DE VALIDAÇAO DA URL
        $patternRoute = '/^'.str_replace('/', '\/',$route).'$/';

        //ADICIONA A ROTA DENTRO DA CLASSE
        $this->routes[$patternRoute][$method] = $params;

    }

    /**
     * Metodo responsavel por definir uma rota de GET
     *
     * @param  string $route
     * @param  array $params
     */
    public function get($route, $params=[])
    {
        return $this->addRoute('GET', $route, $params);
    }

    /**
     * Metodo responsavel por executar a rota atual
     * @return Response
     */
    public function run()
    {
        try {
            //OBTEM A ROTA ATUAL
            throw new Exception("Página não encontrada", 404);
        } catch (Exception $e) {
           return new Response($e->getCode(), $e->getMessage());
        }
    }
}

?>