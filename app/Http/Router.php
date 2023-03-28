<?php 

namespace App\Http;

use \Closure;
use \Exception;
use \ReflectionFunction;

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
     * @param  array $params
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

        //VARIAVEIS DA ROTA
        $params['variables'] = [];

        //PADRAO DE VALIDAÇÂO DAS VARIAVEIS DAS ROTAS
        $patternVariable = '/{(.*?)}/';
        if(preg_match_all($patternVariable,$route,$matches)){
            $route = preg_replace($patternVariable, '(.*?)',$route);
            $params['variables'] = $matches[1];
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
     * Metodo responsavel por definir uma rota de POST
     *
     * @param  string $route
     * @param  array $params
     */
    public function post($route, $params=[])
    {
        return $this->addRoute('POST', $route, $params);
    }

        /**
     * Metodo responsavel por definir uma rota de PUT
     *
     * @param  string $route
     * @param  array $params
     */
    public function put($route, $params=[])
    {
        return $this->addRoute('PUT', $route, $params);
    }

        /**
     * Metodo responsavel por definir uma rota de DELETE
     *
     * @param  string $route
     * @param  array $params
     */
    public function delete($route, $params=[])
    {
        return $this->addRoute('DELETE', $route, $params);
    }

    /**
     * Metodo responsavel por retornar a uri desconsiderando o prefixo
     * @return  string
     */
    private function getUri()
    {
        //URI
        $uri = $this->request->getUri();
        $xUri = strlen($this->prefix) ? explode($this->prefix, $uri) : [$uri];

        //RETORNA URI SEM PREFIXO
        return end($xUri);
    }

    /**
     * Metodo responsavel por retornar os dados da rota atual
     * @return  array
     */
    private function getRoute()
    {
        //URI
        $uri = $this->getUri();

        //METHOD
        $httpMethod = $this->request->getHttpMethod();

        //VALIDA AS ROTAS
        foreach ($this->routes as $patternRoute => $methods) {
            //VERIFICA SE A URI BATE COM O PADRAO
            if(preg_match($patternRoute, $uri, $matches)){
                //VERIFICA O METODO
                if(isset($methods[$httpMethod])){
                    //REMOVE A PRIMEIRA POSIÇÃO
                    unset($matches[0]);

                    //CHAVES DAS VARIAVEIS
                    $keys = $methods[$httpMethod]['variables'];
                    $methods[$httpMethod]['variables'] = array_combine($keys, $matches);
                    $methods[$httpMethod]['variables']['request'] = $this->request;


                    //RETORNA OS PARAMETROS DA ROTA
                    return $methods[$httpMethod];
                }

                throw new Exception("Método não permitido", 405);
            }
        }

        //URL NAO ENCONTRADA
        throw new Exception("URL não encontrada", 404);
    }

    /**
     * Metodo responsavel por executar a rota atual
     * @return Response
     */
    public function run()
    {
        try {

            $route = $this->getRoute();

            //VERIFICA O CONTROLADOR
            if(!isset($route['controller'])){
                throw new Exception("A URL não pôde ser processada", 500);
            }
            //ARGUMENTOS DA FUNÇÃO
            $args = [];

            //REFLECTION
            $reflection = new ReflectionFunction($route['controller']);
            foreach ($reflection->getParameters() as $parameter) {
                $name = $parameter->getName();
                $args[$name] = $route['variables'][$name] ?? '';
            }

            //RETORNA EXECUÇÃO dA FUNÇÃO
            return call_user_func_array($route['controller'],$args);

        } catch (Exception $e) {
           return new Response($e->getCode(), $e->getMessage());
        }
    }
}

?>