<?php
namespace App\Filters;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\Filters\FilterInterface;

class OnlyVisitantes implements FilterInterface
{
    public function before (RequestInterface $request, $arguments = null)
    {
        if(session()->get('logged_in')){
            session() ->setFlashdata('fail', 'Para loguearte o registrarte primero debes de cerrar la sesion activa...');
            return redirect()->to("");
        }
    }
    public function after (RequestInterface $request, ResponseInterface $response, $arguments = null)
    {

    }
}