<?php

namespace MOTO\PrincipalBundle\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class AdministracionControllerTest extends WebTestCase
{
    public function testPrincipaladministracion()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/principalAdministracion');
    }

    public function testAsignardieta()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/asignarDieta');
    }

    public function testCreardieta()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/crearDieta');
    }

    public function testVerdieta()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/verDieta');
    }

    public function testAsignartablacliente()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/asignarTablaCliente');
    }

    public function testNuevatabla()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/nuevaTabla');
    }

    public function testNuevoejercicio()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/nuevoEjercicio');
    }

    public function testNuevoempleado()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/nuevoEmpleado');
    }

    public function testGestionarempleados()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/gestionarEmpleados');
    }

    public function testBuscarcliente()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/buscarCliente');
    }

}
