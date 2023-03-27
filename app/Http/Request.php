<?php 

namespace App\Http;

class Request{

    /**
     * Método da requisição
     *
     * @var string
     */
    private $httpRequest;

    /**
     * URI da página
     *
     * @var string
     */
    private $uri;

    /**
     * Parametros do URL ($_GET)
     *
     * @var array
     */
    private $queryParams = [];
    
    /**
     * Parametros do URL ($_POST)
     *
     * @var array
     */
    private $postVars = [];

    /**
     * Cabeçalho da requisição
     *
     * @var array
     */
    private $headers = [];

    public function __construct()
    {
        $this->httpRequest = $_SESSION['HTTP_REQUEST_METHOD'] ?? '';
        $this->uri = $_SESSION['REQUEST_URI'] ?? '';
        $this->queryParams = $_GET ?? '';
        $this->postVars = $_POST ?? '';
        $this->headers = getallheaders() ?? '';
    }
    
    /**
     * Retorna o metodo da requisicao
     *
     * @return void
     */
    public function getHttpMethod(){
        return $this->httpRequest;
    }

    /**
     * Retorna a uri da requisicao
     *
     * @return void
     */
    public function getUri(){
        return $this->uri;
    }

    /**
     * Retorna os parametros da requisicao
     *
     * @return void
     */
    public function getQueryParams(){
        return $this->queryParams;
    }

    /**
     * Retorna as variaveis POST da requisicao
     *
     * @return void
     */
    public function getPostVars(){
        return $this->postVars;
    }    

    /**
     * Retorna os headers da requisicao
     *
     * @return void
     */
    public function getHeaders(){
        return $this->headers;
    }      

}

?>