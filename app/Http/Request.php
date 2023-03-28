<?php 

namespace App\Http;

class Request{

    /**
     * Método da requisição
     * @var string
     */
    private $httpRequest;

    /**
     * URI da página
     * @var string
     */
    private $uri;

    /**
     * Parametros do URL ($_GET)
     * @var array
     */
    private $queryParams = [];
    
    /**
     * Parametros do URL ($_POST)
     * @var array
     */
    private $postVars = [];

    /**
     * Cabeçalho da requisição
     * @var array
     */
    private $headers = [];

    public function __construct()
    {
        $this->httpRequest = $_SERVER['REQUEST_METHOD'] ?? '';
        $this->uri = $_SERVER['REQUEST_URI'] ?? '';
        $this->queryParams = $_GET ?? '';
        $this->postVars = $_POST ?? '';
        $this->headers = getallheaders() ?? '';
    }
    
    /**
     * Retorna o metodo da requisicao
     * @return string
     */
    public function getHttpMethod(){
        return $this->httpRequest;
    }

    /**
     * Retorna a uri da requisicao
     * @return string
     */
    public function getUri(){
        return $this->uri;
    }

    /**
     * Retorna os parametros da requisicao
     * @return array
     */
    public function getQueryParams(){
        return $this->queryParams;
    }

    /**
     * Retorna as variaveis POST da requisicao
     * @return array
     */
    public function getPostVars(){
        return $this->postVars;
    }    

    /**
     * Retorna os headers da requisicao
     * @return array
     */
    public function getHeaders(){
        return $this->headers;
    }      

}

?>