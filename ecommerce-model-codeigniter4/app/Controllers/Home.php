<?php

namespace App\Controllers;
Use App\Models\productos_model;
Use App\Models\categorias_model;
use CodeIgniter\Controller;

class Home extends BaseController
{
    public function index()
    {   
        $masVendidos = new productos_model();
        $data['mas_vendidos'] = $masVendidos->where('eliminado', 'NO')->orderBy('unidadesVendidas', 'DESC')->limit(20)->findAll();

        $frutosSecos = new productos_model();
        $data['frutosSecos'] = $frutosSecos->where('categoria_id', '2')->where('eliminado', 'NO')->orderBy('unidadesVendidas', 'DESC')->findAll();
        
        $harinasyfeculas = new productos_model();
        $data['harinasYFeculas'] = $harinasyfeculas->where('categoria_id', '7')->where('eliminado', 'NO')->orderBy('unidadesVendidas', 'DESC')->findAll();

        $semillasylegumbres = new productos_model();
        $data['semillasYLegumbres'] = $semillasylegumbres->where('categoria_id', '15')->where('eliminado', 'NO')->orderBy('unidadesVendidas', 'DESC')->findAll();

        $suplementos = new productos_model();
        $data['suplementos'] = $suplementos->where('categoria_id', '9')->where('eliminado', 'NO')->orderBy('unidadesVendidas', 'DESC')->findAll();

        $categoriasModel = new categorias_model();
        $data['categorias'] = $categoriasModel->orderBy('descripcion', 'ASC')->findAll();
        
        $data['titulo']='NutriFood: Inicio';
        echo view('\header', $data);
        echo view('\principal');
        echo view('\footer');
    }

    public function quienesSomos()
    {
        $data['titulo']='Quienes Somos';
        echo view('\header', $data);
        echo view('\quienesSomos');
        echo view('\footer');
    }

    public function contacto()
    {
        $data['titulo']='Contacto';
        echo view('\header', $data);
        echo view('\contacto');
        echo view('\footer');
    }

    public function consultas()
    {
        $data['titulo']='Consultas';
        echo view('\header', $data);
        echo view('\consultas');
        echo view('\footer');
    }

    public function comercializacion()
    {
        $data['titulo']='Comercialización';
        echo view('\header', $data);
        echo view('\comercializacion');
        echo view('\footer');
    }

    public function terminosYusos()
    {
        $data['titulo']='Terminos y Condiciones';
        echo view('\header', $data);
        echo view('\terminosYusos');
        echo view('\footer');
    }
}
