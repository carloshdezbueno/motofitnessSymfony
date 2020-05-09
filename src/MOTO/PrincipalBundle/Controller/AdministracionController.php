<?php

namespace MOTO\PrincipalBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use MOTO\PrincipalBundle\Form\EmpleadoType;
use MOTO\PrincipalBundle\Entity\Empleado;
use MOTO\PrincipalBundle\Form\EjercicioType;
use MOTO\PrincipalBundle\Entity\Ejercicio;
use MOTO\PrincipalBundle\Form\DietaType;
use MOTO\PrincipalBundle\Entity\Dieta;
use MOTO\PrincipalBundle\Form\TablaType;
use MOTO\PrincipalBundle\Entity\Tablaejercicios;
use MOTO\PrincipalBundle\Entity\Plato;
use MOTO\PrincipalBundle\Entity\Diadieta;
use MOTO\PrincipalBundle\Entity\Sesion;

//use Symfony\Component\Form\Extension\Core\Type\ChoiceType;

class AdministracionController extends Controller {

    public function principalAdministracionAction() {

        $request = $this->getRequest();
        $session = $request->getSession();

        $session->remove("dias");
        $session->remove("platos");
        $session->remove("vengoTabla");
        $session->remove("ejercicios");
        $session->remove("sesiones");
        $session->remove("vengoSesion");
        $session->remove("calorias");

        if ($session->get('resLogin') == "empleado") {

            $em = $this->getDoctrine()->getEntityManager();
            $consultaEmpleado = "select e from MOTOPrincipalBundle:Empleado e where e.numeroempleado=" . $session->get('dni');
            $queryEmpleado = $em->createQuery($consultaEmpleado);
            $empleados = $queryEmpleado->getResult();

            $dietas = "-";
            $tablas = "-";
            $empleadosAdmin = "-";

            if ($empleados[0] != null) {

                if ($empleados[0]->getPrivilegios() == 1) {
                    $empleadosAdmin = "true";
                }

                if ($empleados[0]->getEspecialidad() == 1) {
                    // Nutricion
                    $dietas = "true";
                } else if ($empleados[0]->getEspecialidad() == 2) {
                    // Entrenamiento
                    $tablas = "true";
                } else if ($empleados[0]->getEspecialidad() == 3) {
                    // Ambas
                    $tablas = "true";
                    $dietas = "true";
                }
            }

            return $this->render('MOTOPrincipalBundle:Administracion:principalAdministracion.html.twig', array("administrador" => "true", "dietas" => $dietas, "tablas" => $tablas, "empleados" => $empleadosAdmin));
        }

        // Si no es un empleado
        $nota = "No tienes permisos para acceder aquí";
        return $this->render('MOTOPrincipalBundle:Administracion:principalAdministracion.html.twig', array("nota" => $nota));
    }

    public function asignarDietaAction() {


        $request = $this->getRequest();
        $session = $request->getSession();

        $em = $this->getDoctrine()->getEntityManager();
        $consultaEmpleado = "select e from MOTOPrincipalBundle:Empleado e where e.numeroempleado=" . $session->get('dni');
        $queryEmpleado = $em->createQuery($consultaEmpleado);
        $empleados = $queryEmpleado->getResult();

        $clientesEmpleado = array();


        foreach ($empleados[0]->getDni() as $cli) {
            $clientesEmpleado[$cli->getDni()] = $cli;
        }

        // Hacer formulario con dos desplegables
        $formClientes = $this->createFormBuilder()
                ->add('cliente', 'choice', array(
                    'choices' => $clientesEmpleado
                ))
                ->add('dieta', 'entity', array(
                    'class' => 'MOTOPrincipalBundle:Dieta'
                ))
                ->getForm();
        $request = $this->getRequest();

        if ($request->getMethod() == 'POST') {

            $formClientes->bind($request);


            if ($formClientes->isValid()) {

                $em = $this->getDoctrine()->getEntityManager();

                $cliSelect = $formClientes->get("cliente")->getData();
                $dietSelect = $formClientes->get("dieta")->getData();

                $consultaCliente = "select c from MOTOPrincipalBundle:Cliente c where c.dni=" . $cliSelect;
                $queryCliente = $em->createQuery($consultaCliente);
                $clienteMod = $queryCliente->getResult();

                $clienteAModificar = $clienteMod[0];
                $clienteAModificar->setCoddieta($dietSelect);

                $em->persist($clienteAModificar);
                $em->flush();

                return $this->redirect($this->generateUrl('principal_administracion'));
            }
        }

        return $this->render('MOTOPrincipalBundle:Administracion:asignarDieta.html.twig', array("administrador" => "true", 'form' => $formClientes->createView(), 'error' => '-'));
    }

    public function crearDietaAction() {

        $error = "-";
        $request = $this->getRequest();
        $session = $request->getSession();

        if (!$session->has("dias")) {
            $session->set("dias", array());
        }

        $diasInsertados = $session->get("dias");

        $dieta = new Dieta();
        $form = $this->createForm(new DietaType(), $dieta);

        if ($request->getMethod() == 'POST') {
            $form->bind($request);

            if ($form->isValid()) {
                $em = $this->getDoctrine()->getEntityManager();

                foreach ($diasInsertados as $codDia) {
                    $consultaDia = "select d from MOTOPrincipalBundle:Diadieta d where d.coddia=" . $codDia;
                    $queryDia = $em->createQuery($consultaDia);
                    $dia = $queryDia->getResult();


                    $dieta->addCoddia($dia[0]);
                }

                try {
                    $em->persist($dieta);
                    $em->flush();
                } catch (Exception $ex) {
                    $error = "Error al crear dieta";
                    return $this->render('MOTOPrincipalBundle:Administracion:crearDieta.html.twig', array('form' => $form->createView(), 'error' => $error, 'diasInsertados' => count($diasInsertados)));
                }


                //Acaba la insercion
                $session->remove("dias");
                return $this->redirect($this->generateUrl('moto_principal_homepage'));
            }
        }

        return $this->render('MOTOPrincipalBundle:Administracion:crearDieta.html.twig', array('form' => $form->createView(), 'error' => $error, 'diasInsertados' => count($diasInsertados)));
    }

    public function crearDiaDietaAction() {

        $diasSemana = array(
            0 => 'Lunes',
            1 => 'Martes',
            2 => 'Miercoles',
            3 => 'Jueves',
            4 => 'Viernes',
            5 => 'Sabado',
            6 => 'Domingo'
        );

        $error = "-";
        $request = $this->getRequest();
        $session = $request->getSession();

        if (!$session->has("platos")) {
            $session->set("platos", array());
        }

        $platosInsertados = $session->get("platos");

        $caloriasTotales = $session->get("calorias", 0);

        $form = $this->createFormBuilder()
                ->add('macronutrientes', 'text')
                ->getForm();

        if ($request->getMethod() == 'POST') {
            $form->bind($request);

            if ($form->isValid()) {
                $em = $this->getDoctrine()->getEntityManager();
                $diaDieta = new Diadieta();



                //Añade los platos insertados en la otra pag
                foreach ($platosInsertados as $codplato) {
                    $consultaPlato = "select p from MOTOPrincipalBundle:Plato p where p.codplato=" . $codplato;
                    $queryPlato = $em->createQuery($consultaPlato);
                    $plato = $queryPlato->getResult();


                    $diaDieta->addCodplato($plato[0]);
                }

                $diaDieta->setMacronutrientes($form->get("macronutrientes")->getData());


                $diaDieta->setCalorias($session->get("calorias", 2000));
                $session->remove("calorias");

                $diaDieta->setDia($diasSemana[count($session->get("dias"))]);



                try {

                    $em->persist($diaDieta);
                    $em->flush();

                    $diasInsert = $session->get("dias");
                    $diasInsert[] = $diaDieta->getCoddia();
                    $session->set("dias", $diasInsert);
                } catch (Exception $ex) {
                    $error = "Error al crear el dia";
                }

                if ($error != "-") {
                    return $this->render('MOTOPrincipalBundle:Administracion:crearDiadieta.html.twig', array('form' => $form->createView(), 'error' => $error, 'platosInsertados' => count($platosInsertados), 'calorias' => $caloriasTotales));
                }

                //Acaba la insercion
                $session->remove("platos");
                return $this->redirect($this->generateUrl('crear_dieta'));
            }
        }

        return $this->render('MOTOPrincipalBundle:Administracion:crearDiadieta.html.twig', array('form' => $form->createView(), 'error' => $error, 'platosInsertados' => count($platosInsertados), 'calorias' => $caloriasTotales));
    }

    public function crearPlatoAction() {
        $error = "-";
        $request = $this->getRequest();
        $session = $request->getSession();

        $caloriasTotales = $session->get("calorias", 0);

        $plato = new Plato();


        $form = $this->createFormBuilder()
                ->add('nombre', 'text', array('required' => false))
                ->add('calorias', 'number', array('required' => false))
                ->add('tipocomida', 'text', array('required' => false))
                ->add('link', 'text', array('required' => false))
                ->add('platosExistentes', 'entity', array('class' => 'MOTOPrincipalBundle:Plato',
                    'required' => false,
                    'empty_value' => 'Selecciona uno si quieres añadirlo al dia'))
                ->getForm();
        if ($request->getMethod() == 'POST') {
            $form->bind($request);

            if ($form->isValid()) {
                $em = $this->getDoctrine()->getEntityManager();

                $platoExistente = $form->get('platosExistentes')->getData();

                if ($platoExistente) {


                    $caloriasTotales = $caloriasTotales + $platoExistente->getCalorias();
                    $session->set("calorias", $caloriasTotales);


                    $platosInsertados = $session->get("platos");
                    $platosInsertados[] = $platoExistente->getCodplato();
                    $session->set("platos", $platosInsertados);
                } else {
                    $plato = new Plato();

                    $plato->setNombre($form->get('nombre')->getData());
                    $plato->setCalorias($form->get('calorias')->getData());
                    $plato->setTipocomida($form->get('tipocomida')->getData());
                    $plato->setLink($form->get('link')->getData());


                    try {

                        $em->persist($plato);
                        $em->flush();
                        $caloriasTotales = $caloriasTotales + $plato->getCalorias();
                        $session->set("calorias", $caloriasTotales);


                        $platosInsertados = $session->get("platos");
                        $platosInsertados[] = $plato->getCodplato();
                        $session->set("platos", $platosInsertados);
                    } catch (\Exception $ex) {
                        $error = "Error al crear el plato, tienes que rellenar los campos o elegir un plato ya creado";
                    }

                    if ($error != "-") {
                        return $this->render('MOTOPrincipalBundle:Administracion:crearPlato.html.twig', array('form' => $form->createView(), 'error' => $error));
                    }
                }

                //Acaba la insercion
                return $this->redirect($this->generateUrl('crear_dia_dieta'));
            }
        }

        return $this->render('MOTOPrincipalBundle:Administracion:crearPlato.html.twig', array('form' => $form->createView(), 'error' => $error));
    }

    public function verDietaAction() {
        // Recuperar dietas
        $em = $this->getDoctrine()->getManager();

        $form = $this->createFormBuilder()
                ->add('dieta', 'entity', array(
                    'class' => 'MOTOPrincipalBundle:Dieta'
                ))
                ->getForm();

        $request = $this->getRequest();
        $session = $request->getSession();

        if ($request->getMethod() == 'POST') {
            $form->bind($request);

            if ($form->isValid()) {

                $dietaSelec = $form->get("dieta")->getData();

                return $this->render('MOTOPrincipalBundle:Administracion:verDieta.html.twig', array("administrador" => "true", 'dietaMostrar' => $dietaSelec));
            }
        }

        return $this->render('MOTOPrincipalBundle:Administracion:verDieta.html.twig', array("administrador" => "true", 'form' => $form->createView()));
    }

    public function asignarTablaClienteAction() {

        $request = $this->getRequest();
        $session = $request->getSession();

        $em = $this->getDoctrine()->getEntityManager();
        $consultaEmpleado = "select e from MOTOPrincipalBundle:Empleado e where e.numeroempleado=" . $session->get('dni');
        $queryEmpleado = $em->createQuery($consultaEmpleado);
        $empleados = $queryEmpleado->getResult();

        $clientesEmpleado = array();


        foreach ($empleados[0]->getDni() as $cli) {
            $clientesEmpleado[$cli->getDni()] = $cli;
        }


        $formClientes = $this->createFormBuilder()
                ->add('cliente', 'choice', array(
                    'choices' => $clientesEmpleado
                ))
                ->add('tablaejercicios', 'entity', array(
                    'class' => 'MOTOPrincipalBundle:Tablaejercicios'
                ))
                ->getForm();


        if ($request->getMethod() == 'POST') {

            $formClientes->bind($request);


            if ($formClientes->isValid()) {

                $cliSelect = $formClientes->get("cliente")->getData();
                $tabSelect = $formClientes->get("tablaejercicios")->getData();

                $consultaCliente = "select c from MOTOPrincipalBundle:Cliente c where c.dni=" . $cliSelect;
                $queryCliente = $em->createQuery($consultaCliente);
                $clienteMod = $queryCliente->getResult();

                $clienteAModificar = $clienteMod[0];
                $clienteAModificar->setCodtabla($tabSelect);

                $em->persist($clienteAModificar);
                $em->flush();

                return $this->redirect($this->generateUrl('principal_administracion'));
            }
        }

        return $this->render('MOTOPrincipalBundle:Administracion:asignarTablaCliente.html.twig', array("administrador" => "true", 'form' => $formClientes->createView(), 'error' => '-'));
    }

    public function nuevaTablaAction() {
        $error = "-";

        $request = $this->getRequest();
        $session = $request->getSession();


        if (!$session->has("sesiones")) {
            $session->set("sesiones", array());
        }

        $sesionesInsertados = $session->get("sesiones");

        $tabla = new Tablaejercicios();
        $form = $this->createForm(new TablaType(), $tabla);

        if ($request->getMethod() == 'POST') {
            $form->bind($request);

            if ($form->isValid()) {
                $em = $this->getDoctrine()->getEntityManager();

                foreach ($sesionesInsertados as $codSes) {
                    $consultaSesion = "select s from MOTOPrincipalBundle:Sesion s where s.codsesion=" . $codSes;
                    $querySesion = $em->createQuery($consultaSesion);
                    $sesion = $querySesion->getResult();

                    $tabla->addCodsesion($sesion[0]);
                }

                try {
                    $em->persist($tabla);
                    $em->flush();
                } catch (Exception $ex) {
                    $error = "Error al crear tabla de ejercicios";
                    return $this->render('MOTOPrincipalBundle:Administracion:nuevaTabla.html.twig', array('sesionesInsertadas' => count($sesionesInsertados), 'form' => $form->createView(), 'error' => $error));
                }

                $session->remove("sesiones");
                return $this->redirect($this->generateUrl('principal_administracion'));
            }
        }

        return $this->render('MOTOPrincipalBundle:Administracion:nuevaTabla.html.twig', array('sesionesInsertadas' => count($sesionesInsertados), 'form' => $form->createView(), 'error' => $error));
    }

    public function nuevaSesionAction() {

        $error = "-";

        $ant = $this->getRequest()->headers->get('referer');

        $hidd = "";
        $request = $this->getRequest();
        $session = $request->getSession();


        if (!$session->has("vengoTabla")) {
            if (strpos($ant, $this->generateUrl('nueva_tabla')) !== false) {
                $this->console_log("Vengo de tabla");
                $session->set("vengoTabla", true);
            } else {
                $this->console_log("NO Vengo de tabla");
                $session->set("vengoTabla", false);
            }
        }

        if ($session->get("vengoTabla") == false) {
            $hidd = "hidden=''";
        }

        if (!$session->has("ejercicios")) {
            $session->set("ejercicios", array());
        }

        $ejerciciosInsertados = $session->get("ejercicios");


        $form = $this->createFormBuilder()
                ->add('dia', 'text', array(
                    'required' => false))
                ->add('sesionesExistentes', 'entity', array('class' => 'MOTOPrincipalBundle:Sesion',
                    'required' => false,
                    'empty_value' => 'Selecciona uno si quieres añadirlo a la sesion'))
                ->getForm();

        if ($request->getMethod() == 'POST') {
            $form->bind($request);

            if ($form->isValid()) {
                $em = $this->getDoctrine()->getEntityManager();
                $sesionEj = new Sesion();

                if ($form->get("sesionesExistentes")->getData() != null) {
                    $sesionEj = $form->get("sesionesExistentes")->getData();
                } else {
                    //Añade los platos insertados en la otra pag
                    foreach ($ejerciciosInsertados as $codEj) {
                        $consultaEjercicio = "select e from MOTOPrincipalBundle:Ejercicio e where e.codejercicio=" . $codEj;
                        $queryEjercicio = $em->createQuery($consultaEjercicio);
                        $ejercicio = $queryEjercicio->getResult();
                        $this->console_log($codEj);

                        $sesionEj->addCodigoejercicio($ejercicio[0]);
                    }

                    $sesionEj->setDia($form->get("dia")->getData());

                    try {

                        $em->persist($sesionEj);
                        $em->flush();
                    } catch (\Exception $ex) {
                        $error = "Error al crear la sesion, prueba anadir ejercicios";
                        if ($hidd == "") {
                            $error .= " o elegir una existente";
                        }
                    }
                }



                if ($error != "-") {
                    return $this->render('MOTOPrincipalBundle:Administracion:nuevaSesion.html.twig', array('form' => $form->createView(), 'error' => $error, 'sesion' => $hidd, 'ejeciciosInsertados' => count($ejerciciosInsertados)));
                }



                if ($session->get("vengoTabla")) {
                    $sesInsertados = $session->get("sesiones");
                    $sesInsertados[] = $sesionEj->getCodsesion();
                    $session->set("sesiones", $sesInsertados);

                    $session->remove("vengoTabla");
                    $session->remove("ejercicios");
                    return $this->redirect($this->generateUrl('nueva_tabla'));
                } else {
                    $session->remove("vengoTabla");
                    $session->remove("ejercicios");
                    return $this->redirect($this->generateUrl('principal_administracion'));
                }


                //Acaba la insercion
                //return $this->redirect($this->generateUrl('principal_administracion'));
            }
        }

        return $this->render('MOTOPrincipalBundle:Administracion:nuevaSesion.html.twig', array('form' => $form->createView(), 'error' => $error, 'sesion' => $hidd, 'ejeciciosInsertados' => count($ejerciciosInsertados)));
    }

    public function nuevoEjercicioAction() {

        $ant = $this->getRequest()->headers->get('referer');

        $hidd = "";
        $request = $this->getRequest();
        $session = $request->getSession();

        if (!$session->has("vengoSesion")) {
            if (strpos($ant, $this->generateUrl('nueva_sesion')) !== false) {
                $this->console_log("Vengo de sesion");
                $session->set("vengoSesion", true);
            } else {
                $this->console_log("NO Vengo de sesion");
                $session->set("vengoSesion", false);
            }
        }

        if ($session->get("vengoSesion") == false) {
            $hidd = "hidden=''";
        }

        $error = "-";


        $ejercicio = new Ejercicio();
        $form = $this->createForm(new EjercicioType(), $ejercicio);

        if ($request->getMethod() == 'POST') {
            $form->bind($request);

            if ($form->isValid()) {
                $em = $this->getDoctrine()->getEntityManager();

                if ($form->get("ejExistentes")->getData() != null) {
                    $ejercicio = $form->get("ejExistentes")->getData();
                } else {
                    try {
                        $em->persist($ejercicio);
                        $em->flush();
                    } catch (\Exception $ex) {
                        $error = "Error al crear el ejercicio, tienes que rellenar los campos";

                        if ($hidd == "") {
                            $error .= " o elegir uno existente";
                        }

                        return $this->render('MOTOPrincipalBundle:Administracion:nuevoEjercicio.html.twig', array('form' => $form->createView(), 'error' => $error, 'sesion' => $hidd));
                    }
                }



                if ($session->get("vengoSesion")) {
                    $ejInsertados = $session->get("ejercicios");
                    $ejInsertados[] = $ejercicio->getCodejercicio();
                    $session->set("ejercicios", $ejInsertados);

                    $session->remove("vengoSesion");
                    return $this->redirect($this->generateUrl('nueva_sesion'));
                } else {
                    $session->remove("vengoSesion");
                    return $this->redirect($this->generateUrl('principal_administracion'));
                }
            }
        }

        return $this->render('MOTOPrincipalBundle:Administracion:nuevoEjercicio.html.twig', array('form' => $form->createView(), 'error' => $error, 'sesion' => $hidd));
    }

    public function nuevoEmpleadoAction() {

        $error = "-";
        $request = $this->getRequest();
        $session = $request->getSession();

        $empleado = new Empleado();
        $form = $this->createForm(new EmpleadoType(), $empleado);

        if ($request->getMethod() == 'POST') {
            $form->bind($request);

            if ($form->isValid()) {
                $em = $this->getDoctrine()->getEntityManager();

                try {
                    $em->persist($empleado);
                    $em->flush();
                } catch (Exception $ex) {
                    $error = "Ha habido un problema. ¿El DNI introducido ya existe?";
                    // Mostrar error
                    return $this->render('MOTOPrincipalBundle:Administracion:nuevoEmpleado.html.twig', array('form' => $form->createView(), 'error' => $error));
                }
                // Página principal
                return $this->redirect($this->generateUrl('moto_principal_homepage'));
            }
        }
        // Renderizar formulario
        return $this->render('MOTOPrincipalBundle:Administracion:nuevoEmpleado.html.twig', array('form' => $form->createView(), 'error' => $error));
    }

    public function gestionarEmpleadosAction() {
        
    }

    public function buscarClienteAction() {

        $request = $this->getRequest();
        $session = $request->getSession();

        $em = $this->getDoctrine()->getEntityManager();
        $consultaEmpleado = "select e from MOTOPrincipalBundle:Empleado e where e.numeroempleado=" . $session->get('dni');
        $queryEmpleado = $em->createQuery($consultaEmpleado);
        $empleados = $queryEmpleado->getResult();

        $clientesEmpleado = array();


        foreach ($empleados[0]->getDni() as $cli) {
            $clientesEmpleado[$cli->getDni()] = $cli;
        }

        // Desplegable de clientes
        $formClientes = $this->createFormBuilder()
                ->add('cliente', 'choice', array(
                    'choices' => $clientesEmpleado
                ))
                ->getForm();

        $request = $this->getRequest();
        $session = $request->getSession();

        if ($request->getMethod() == 'POST') {
            $formClientes->bind($request);

            $cliSelect = $formClientes->get("cliente")->getData();

            $consultaCliente = "select c from MOTOPrincipalBundle:Cliente c where c.dni=" . $cliSelect;
            $queryCliente = $em->createQuery($consultaCliente);
            $cliente = $queryCliente->getResult();

            $clienteElegido = $cliente[0];


            

            return $this->render('MOTOPrincipalBundle:Administracion:buscarCliente.html.twig', array('administrador' => 'true', 'cliente' => $clienteElegido, 'clienteobtenido' => $clienteElegido));
        }

        return $this->render('MOTOPrincipalBundle:Administracion:buscarCliente.html.twig', array('administrador' => 'true', 'form' => $formClientes->createView(), 'error' => '-'));
    }

    function console_log($data) {
        echo '<script>';
        echo "console.log('" . $data . "')";
        echo '</script>';
    }

}
