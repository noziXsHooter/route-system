<?php 

namespace App\Http;

class Response{

    
    /**
     * Código HTTP
     *
     * @var int
     */
    private $httpCode = 200;

    /**
     * Cabeçalho do Response
     *
     * @var array
     */
    private $headers = [];

    /**
     * Tipo de conteudo que esta sendo retornado
     *
     * @var string
     */
    private $contentType = 'text/html';

    /**
     * Conteudo do Response
     *
     * @var mixed
     */
    private $content;

    
    /**
     * Metodo responsavel por inciar a classe e definir os valores
     * @param  int $httpCode
     * @param  mixed $content
     * @param  string $contentType
     */
    public function __construct($httpCode, $content, $contentType = 'text/html')
    {
        $this->httpCode = $httpCode;
        $this->content = $content;
        $this->contentType = $contentType;
        $this->setContentType($contentType);
    }

    /**
     * Metodo responsavel por alterar o contentType do responde
     * @param string $contentType 
     */
    public function setContentType($contentType)
    {
        $this->contentType = $contentType;
        $this->addHeader('Content-Type', $contentType);
    }
        
    /**
     * Metodo responsavel por adicionar um registro no cabeçalho de response
     *
     * @param  mixed $key
     * @param  mixed $value
     */
    public function addHeader($key, $value)
    {
        $this->headers[$key] = $value;
    }

    /**
     * Metodo responsavel por enviar os headers para o navegador
     */
    public function sendHeaders()
    {
        //Define o codigo de STATUS
        http_response_code($this->httpCode);

        //Enviar HEADERS
        foreach ($this->headers as $key => $value) {
            header($key.': '.$value);
        }

    }

    /**
     * Metodo responsavel por enviar a resposta para o usuario
     */
    public function sendResponse()
    {
        //ENVIAR OS HEADERS
        $this->sendHeaders();

        //IMPRIME O CONTEUDO
        switch ($this->contentType) {
            case 'text/html':
               echo $this->content;
                break;
            
            default:
                # code...
                break;
        }
    }
}

?>