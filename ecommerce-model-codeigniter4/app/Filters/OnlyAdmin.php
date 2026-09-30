<?php
namespace App\Filters;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\Filters\FilterInterface;

class OnlyAdmin implements FilterInterface
{
    public function before (RequestInterface $request, $arguments = null)
    {
        if(!session()->get('logged_in')){
            return redirect()->to("login");
        } else if (session()->get('perfil_id')!='1') {
            session() ->setFlashdata('fail', 'Permisos denegados.');
            return redirect()->to("");
        }
    }
    public function after (RequestInterface $request, ResponseInterface $response, $arguments = null)
    {

    }
}