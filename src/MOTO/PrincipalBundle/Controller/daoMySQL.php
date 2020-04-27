<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

function getConnection() {
    $conex = mysqli_connect('localhost', 'root', '') or die(mysqli_error($conex));
    mysqli_select_db($conex, "motofitness") or die(mysqli_error($conex));

    return $conex;
}

function login($user, $pwd) {
    $conex = getConnection();


    $query = "SELECT dni, clave
            FROM cliente 
            WHERE (dni LIKE '$user') and 
                (clave LIKE '$pwd')";
    $res_valid = mysqli_query($conex, $query)
            or die(mysqli_error($conex));
    if ((mysqli_num_rows($res_valid) == 0) || !$user || !$pwd) {
        $query = "SELECT numeroempleado, clave, especialidad
        FROM empleado 
        WHERE (numeroempleado LIKE '$user') and 
            (clave LIKE '$pwd')";
        $res_valid = mysqli_query($conex, $query)
                or die(mysqli_error($conex));
        if ((mysqli_num_rows($res_valid) == 0) || !$user || !$pwd) {
            $_SESSION['resLogin'] = "Usuario o clave incorrectos";
            header('location: login.php');
        } else {
            $reg_usuario = mysqli_fetch_array($res_valid);
            $_SESSION['numeroempleado'] = $reg_usuario['numeroempleado'];
            $_SESSION['especialidad'] = $reg_usuario['especialidad'];
            $_SESSION['resLogin'] = "empleado";
            mysqli_close($conex);
            return;
        }
    } else {
        $reg_usuario = mysqli_fetch_array($res_valid);
        $_SESSION['dni'] = $reg_usuario['dni'];
        $_SESSION['resLogin'] = "cliente";
        mysqli_close($conex);
        return;
    }
}



function getTodosDatosEmp($nEmp) {
    $conex = getConnection();
    $query = "SELECT nombre, especialidad, dni, telefono, email, direccion, clave, privilegios
                FROM `empleado` 
                WHERE numeroempleado = '$nEmp' ";
    $res_valid = mysqli_query($conex, $query)
            or die(mysqli_error($conex));

    if ($reg_usuario = mysqli_fetch_array($res_valid)) {

        $datos['nombre'] = $reg_usuario['nombre'];
        $datos['especialidad'] = $reg_usuario['especialidad'];
        $datos['dni'] = $reg_usuario['dni'];
        $datos['telefono'] = $reg_usuario['telefono'];
        $datos['email'] = $reg_usuario['email'];
        $datos['direccion'] = $reg_usuario['direccion'];
        $datos['clave'] = $reg_usuario['clave'];
        $datos['privilegios'] = $reg_usuario['privilegios'];
    } else {
        $datos['nombre'] = "";
        $datos['especialidad'] = "";
        $datos['dni'] = "";
        $datos['telefono'] = "";
        $datos['email'] = "";
        $datos['direccion'] = "";
        $datos['clave'] = "";
        $datos['privilegios'] = "";
    }
    mysqli_close($conex);
    return $datos;
}

function getDatosEmp($nEmp) {

    $conex = getConnection();
    $query = "SELECT nombre, telefono, email
                FROM `empleado` 
                WHERE numeroempleado = '$nEmp' ";
    $res_valid = mysqli_query($conex, $query)
            or die(mysqli_error($conex));
    $datos = "";
    if ($reg_usuario = mysqli_fetch_array($res_valid)) {

        $datos = $reg_usuario['nombre'] . ", Su informacion email es: " . $reg_usuario['email'];
    }

    mysqli_close($conex);
    return $datos;
}

function getPreparadores($dni) {

    $conex = getConnection();

    $query = "SELECT numeroempleado
        FROM lineaempleado
        WHERE dni = '$dni'";
    $res_valid = mysqli_query($conex, $query)
            or die(mysqli_error($conex));


    while ($reg_usuario = mysqli_fetch_array($res_valid)) {
        if (getEspecialidad($reg_usuario['numeroempleado']) == '1') {
            $preparador['nutricional'] = $reg_usuario['numeroempleado'];
        } else if (getEspecialidad($reg_usuario['numeroempleado']) == '2') {
            $preparador['fisico'] = $reg_usuario['numeroempleado'];
        } else if (getEspecialidad($reg_usuario['numeroempleado']) == '3') {
            $preparador['nutricional'] = $reg_usuario['numeroempleado'];
            $preparador['fisico'] = $reg_usuario['numeroempleado'];
            mysqli_close($conex);
            return $preparador;
        }
    }


    mysqli_close($conex);
    return $preparador;
}

function getEmpleados() {
    $conex = getConnection();

    $query = "SELECT numeroempleado, nombre
        FROM empleado 
        ORDER BY numeroempleado";
    $res_valid = mysqli_query($conex, $query)
            or die(mysqli_error($conex));
    while ($reg_usuario = mysqli_fetch_array($res_valid)) {
        $empleados[$reg_usuario['numeroempleado']] = $reg_usuario['numeroempleado'] . " - " . $reg_usuario['nombre'];
    }

    mysqli_close($conex);
    return $empleados;
}

function insertEmpleado($esp, $name, $dni, $telef, $email, $dir, $clave, $privilegios) {
    $conex = getConnection();
    $query = "INSERT INTO `empleado` (`especialidad`, `nombre`, `dni`, `telefono`, `email`, `direccion`, `clave`, `privilegios`) VALUES ('$esp', '$name', '$dni', '$telef', '$email', '$dir', '$clave', '$privilegios') ";

    $res_valid = mysqli_query($conex, $query)
            or die(mysqli_error($conex));
    mysqli_close($conex);
    return $res_valid;
}

function updateEmpleado($nemp, $esp, $nombre, $dni, $telef, $email, $direccion, $pwd, $privilegios) {
    $conex = getConnection();
    $query = "UPDATE `empleado` 
             SET    `especialidad` = '$esp', 
                    `nombre` = '$nombre', 
                    `dni` = '$dni', 
                    `telefono` = '$telef', 
                    `email` = '$email', 
                    `direccion` = '$direccion', 
                    `clave` = '$pwd', 
                    `privilegios` = '$privilegios' 
             WHERE  `empleado`.`numeroempleado` = $nemp ";

    $res_valid = mysqli_query($conex, $query)
            or die(mysqli_error($conex));
    mysqli_close($conex);
    return $res_valid;
}

function deleteEmp($nemp) {
    $conex = getConnection();
    $query = "DELETE FROM `empleado` WHERE `empleado`.`numeroempleado` = $nemp ";

    $res_valid = mysqli_query($conex, $query)
            or die(mysqli_error($conex));
    mysqli_close($conex);
    return $res_valid;
}

function deleteLineaEmp($nemp) {
    $conex = getConnection();
    $query = "DELETE FROM `lineaempleado` WHERE `lineaempleado`.`numeroempleado` = $nemp ";

    $res_valid = mysqli_query($conex, $query)
            or die(mysqli_error($conex));
    mysqli_close($conex);
    return $res_valid;
}

function getPrivilegios($numEmp) {
    $conex = getConnection();

    $query = "SELECT privilegios
        FROM empleado 
        WHERE numeroempleado = '$numEmp'";
    $res_valid = mysqli_query($conex, $query)
            or die(mysqli_error($conex));

    $reg_usuario = mysqli_fetch_array($res_valid);

    mysqli_close($conex);
    return $reg_usuario['privilegios'];
}

function getEspecialidad($nEmp) {
    $conex = getConnection();

    $query = "SELECT especialidad
        FROM empleado 
        WHERE (numeroempleado LIKE '$nEmp')";
    $res_valid = mysqli_query($conex, $query)
            or die(mysqli_error($conex));

    $reg_usuario = mysqli_fetch_array($res_valid);

    mysqli_close($conex);
    return $reg_usuario['especialidad'];
}

function getPlan($user) {
    $conex = getConnection();


    $query = "SELECT codplan
            FROM cliente 
            WHERE (dni LIKE '$user')";

    $res_valid = mysqli_query($conex, $query)
            or die(mysqli_error($conex));
    if ((mysqli_num_rows($res_valid) != 0)) {
        $plan = mysqli_fetch_array($res_valid);
        mysqli_close($conex);

        if ($plan['codplan'] == '1') {
            $planuser = 'nutricion';
        } else if ($plan['codplan'] == '2') {
            $planuser = 'entrenamiento';
        } else if ($plan['codplan'] == '3') {
            $planuser = 'pro';
        }

        return $planuser;
    } else {
        mysqli_close($conex);
        return null;
    }
}

function getProgreso($dni) {

    $conex = getConnection();


    $query = "SELECT fecha, peso, medidas, imagen
            FROM `progreso` 
            WHERE dni = '$dni'
            ORDER BY `progreso`.`fecha` DESC ";

    $result = mysqli_query($conex, $query)
            or die(mysqli_error($conex));
    if ((mysqli_num_rows($result) != 0)) {
        $tabla = "";

        while ($fila = mysqli_fetch_array($result)) {

            $tabla = $tabla . "<tr>
            <th>" . $fila['fecha'] . "</th>
            <td>" . $fila['peso'] . "</td>
            <td>" . $fila['medidas'] . "</td>
            <td><img src='" . $fila['imagen'] . "' width='256' height='200' /></td>
          </tr>";
        }
        mysqli_close($conex);
        return $tabla;
    } else {
        mysqli_close($conex);
        return "";
    }
}

function getDietas($user) {
    $tab = "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";

    $conex = getConnection();

    $query = "SELECT c.dni, d.semana, dd.calorias, dd.macronutrientes, dd.dia, co.nombre as nombreco, p.nombre, p.link
            FROM dieta d, lineadieta ld, diadieta dd, lineadia ln, comida co, lineacomida lc, plato p, cliente c
            WHERE c.dni = '$user'
            AND   c.coddieta = d.coddieta
            AND   d.coddieta = ld.coddieta
            AND   ld.coddia = dd.coddia
            AND   dd.coddia = ln.coddia
            AND   ln.codcomida = co.codcomida
            AND   co.codcomida = lc.codcomida
            AND   lc.codplato = p.codplato
            ORDER BY dd.coddia, co.codcomida";

    $result = mysqli_query($conex, $query)
            or die(mysqli_error($conex));
    if ((mysqli_num_rows($result) != 0)) {
        //$plan=mysqli_fetch_array($res_valid);

        $dieta = "";
        $diaantit = "";
        $comidaantit = "";
        $primit = 1;
        while ($fila = mysqli_fetch_array($result)) {


            if ($fila['dia'] != $diaantit) {
                $dieta = $dieta . "
                                    <h3>" . $fila['dia'] . "</h3>
                                    <p>$tab Calorias:&nbsp;" . $fila['calorias'] . "</p>";
                $diaantit = $fila['dia'];
                $comidaantit = "";
            }
            if ($fila['nombreco'] != $comidaantit) {
                $dieta = $dieta . "
                                    <h4>$tab" . $fila['nombreco'] . ":</h4>";
                $comidaantit = $fila['nombreco'];
            }

            $dieta = $dieta . "<p>$tab $tab Plato:&nbsp;" . $fila['nombre'] . "</p>
                                    <p>$tab $tab Link:&nbsp;" . $fila['link'] . "</p>";
        }
        mysqli_close($conex);
        return $dieta;
    } else {
        mysqli_close($conex);
        return "";
    }
}

function getDieta($coddieta) {
    $tab = "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";

    $conex = getConnection();


    $query = "SELECT d.semana, dd.calorias, dd.macronutrientes, dd.dia, co.nombre as nombreco, p.nombre, p.link
            FROM dieta d, lineadieta ld, diadieta dd, lineadia ln, comida co, lineacomida lc, plato p
            WHERE d.coddieta = $coddieta
            AND   d.coddieta = ld.coddieta
            AND   ld.coddia = dd.coddia
            AND   dd.coddia = ln.coddia
            AND   ln.codcomida = co.codcomida
            AND   co.codcomida = lc.codcomida
            AND   lc.codplato = p.codplato";

    $result = mysqli_query($conex, $query)
            or die(mysqli_error($conex));
    if ((mysqli_num_rows($result) != 0)) {
        //$plan=mysqli_fetch_array($res_valid);

        $dieta = "";
        $diaantit = "";
        $comidaantit = "";
        $primit = 1;
        while ($fila = mysqli_fetch_array($result)) {


            if ($fila['dia'] != $diaantit) {
                $dieta = $dieta . "
                                    <h3>" . $fila['dia'] . "</h3>
                                    <p>$tab Calorias:&nbsp;" . $fila['calorias'] . "</p>";
                $diaantit = $fila['dia'];
                $comidaantit = "";
            }
            if ($fila['nombreco'] != $comidaantit) {
                $dieta = $dieta . "
                                    <h4>$tab" . $fila['nombreco'] . ":</h4>";
                $comidaantit = $fila['nombreco'];
            }

            $dieta = $dieta . "<p>$tab $tab Plato:&nbsp;" . $fila['nombre'] . "</p>
                                    <p>$tab $tab Link:&nbsp;" . $fila['link'] . "</p>";
        }
        mysqli_close($conex);
        return $dieta;
    } else {
        mysqli_close($conex);
        return "";
    }
}

function insertProgreso($img, $peso, $medidas, $fecha, $dni) {



    $conex = getConnection();


    $query = "INSERT INTO `progreso` (`codProgreso`, `imagen`, `peso`, `medidas`, `fecha`, `dni`) "
            . "VALUES (NULL, '" . $img . "', '" . $peso . "', '" . $medidas . "', '" . $fecha . "', '" . $dni . "') ";
    $result = mysqli_query($conex, $query)
            or die(mysqli_error($conex));
    mysqli_close($conex);
}

function selectpreparador($especialidad) {


    $conex = getConnection();

    $query = "SELECT numeroempleado FROM empleado WHERE especialidad = '$especialidad' OR especialidad = '3'";


    $result = mysqli_query($conex, $query)
            or die(mysqli_error($conex));

    $numeroempleado = "";
    $antit = 99999999999999999999;

    while ($fila = mysqli_fetch_array($result)) {
        $query2 = "SELECT COUNT(*) AS res FROM lineaempleado WHERE numeroempleado = '" . $fila['numeroempleado'] . "' ";


        $result2 = mysqli_query($conex, $query2)
                or die(mysqli_error($conex));
        $fila2 = mysqli_fetch_array($result2);

        if ($fila2['res'] < $antit) {

            $numeroempleado = $fila['numeroempleado'];
            $antit = $fila2['res'];
        }
    }

    mysqli_close($conex);
    return $numeroempleado;
}

function insertCliente($dni, $nombre, $email, $direccion, $telef, $objetivo, $pwd) {

    $conex = getConnection();
    $query = "INSERT INTO `cliente` (`dni`, `nombre`, `email`, `direccion`, `telefono`, `objetivo`, `clave`, `coddieta`, `codtabla`) 
                            VALUES ('$dni', '$nombre', '$email', '$direccion', '$telef', '$objetivo', '$pwd', NULL, NULL) ";

    $result = mysqli_query($conex, $query)
            or die(mysqli_error($conex));
    mysqli_close($conex);
    return $result;
}

function asignarprep($dni, $numempleado) {
    $conex = getConnection();
    $query = "INSERT INTO `lineaempleado` (`dni`, `numeroempleado`) 
                            VALUES ('$dni', '$numempleado') ";
    $result = mysqli_query($conex, $query)
            or die(mysqli_error($conex));
    mysqli_close($conex);
    return $result;
}

function nuevoEjercicio($nombre, $series, $repeticiones, $peso, $link) {
    $conex = getConnection();

    //$query = "INSERT INTO `ejercicio` (`codejercicio`, `nombre`, `series`, `repeticiones`, `peso`, `link`) VALUES (NULL, '$nombre', '$series', '$repeticiones', '$peso', '$link')";

    $query = "INSERT INTO `ejercicio` (`codejercicio`, `nombre`, `series`, `repeticiones`, `peso`, `link`) VALUES (NULL, '$nombre', '$series', '$repeticiones', '$peso', '$link')";

    $result = mysqli_query($conex, $query)
            or die(mysqli_error($conex));

    mysqli_close($conex);

    return $result;
}

function insertPlan($dni, $tipoplan, $dispo, $observaciones, $plan) {

    $fecha_actual = date('Y-m-d');
    $fecha = date("Y-m-d", strtotime($fecha_actual . "+ 1 month"));

    print("$plan");
    $conex = getConnection();
    $query = "UPDATE `cliente` "
            . "SET `disponibilidad` = '$dispo', `observaciones` = '$observaciones', `vencimiento` = '$fecha', `codplan` = '$plan' WHERE `cliente`.`dni` = '$dni' ";

    $result = mysqli_query($conex, $query)
            or die(mysqli_error($conex));
    mysqli_close($conex);
    return $result;
}

function insertPlato($nombre, $link, $cal) {
    $conex = getConnection();

    $query = "INSERT INTO `plato` (`codplato`, `nombre`, `link`, `calorias`) VALUES (NULL, '$nombre', '$link', $cal)";

    $result = mysqli_query($conex, $query)
            or die(mysqli_error($conex));
    $id = mysqli_insert_id($conex);
    
    mysqli_close($conex);
    return $id;
}

function getCalPlato($clave) {
    $conex = getConnection();

    $query = "SELECT calorias FROM `plato` WHERE codplato = $clave";

    $result = mysqli_query($conex, $query)
            or die(mysqli_error($conex));
    if ($fila = mysqli_fetch_array($result)) {

        $cal = $fila['calorias'];
    }
    
    mysqli_close($conex);
    return $cal;
}

function getPlatos() {

    $conex = getConnection();

    $query = "SELECT * FROM `plato` ";

    $result = mysqli_query($conex, $query)
            or die(mysqli_error($conex));
    while ($fila = mysqli_fetch_array($result)) {

        $platos[$fila['codplato']] = $fila['nombre'];
    }

    return $platos;
}

function insertComida($nombre) {


    $conex = getConnection();

    $query = "INSERT INTO `comida` (`codcomida`, `nombre`) VALUES (NULL, '$nombre') ";
    $result = mysqli_query($conex, $query)
            or die(mysqli_error($conex));

    $id = mysqli_insert_id($conex);

    return $id;
}

function bindComidaPlato($idComida, $idPlato) {

    $conex = getConnection();

    $query = "INSERT INTO `lineacomida` (`codcomida`, `codplato`) VALUES ('$idComida', '$idPlato')  ";
    $result = mysqli_query($conex, $query)
            or die(mysqli_error($conex));
    return $result;
}

function getComidas() {

    $conex = getConnection();

    $query = "SELECT * FROM `comida` ";

    $result = mysqli_query($conex, $query)
            or die(mysqli_error($conex));
    while ($fila = mysqli_fetch_array($result)) {

        $comidas[$fila['codcomida']] = $fila['nombre'];
    }

    return $comidas;
}

function insertDia($calorias, $macros, $dia) {


    $conex = getConnection();

    $query = "INSERT INTO `diadieta` (`coddia`, `calorias`, `macronutrientes`, `dia`) "
            . "VALUES (NULL, '$calorias', '$macros', '$dia') ";
    $result = mysqli_query($conex, $query)
            or die(mysqli_error($conex));

    $id = mysqli_insert_id($conex);

    return $id;
}

function bindDiaComida($idDia, $idComida) {

    $conex = getConnection();

    $query = "INSERT INTO `lineadia` (`coddia`, `codcomida`) VALUES ('$idDia', '$idComida') ";
    $result = mysqli_query($conex, $query)
            or die(mysqli_error($conex));
    return $result;
}

function getDias() {

    $conex = getConnection();

    $query = "SELECT * FROM `diadieta` ";

    $result = mysqli_query($conex, $query)
            or die(mysqli_error($conex));
    while ($fila = mysqli_fetch_array($result)) {

        $dias[$fila['coddia']] = "Codigo: " . $fila['coddia'] . " - " . $fila['dia'];
    }

    return $dias;
}

function insertDieta($semana) {


    $conex = getConnection();

    $query = "INSERT INTO `dieta` (`coddieta`, `semana`) VALUES (NULL, '$semana') ";
    $result = mysqli_query($conex, $query)
            or die(mysqli_error($conex));

    $id = mysqli_insert_id($conex);

    return $id;
}

function bindDietaComida($idDieta, $idDia) {

    $conex = getConnection();

    $query = "INSERT INTO `lineadieta` (`coddieta`, `coddia`) VALUES ('$idDieta', '$idDia') ";
    $result = mysqli_query($conex, $query)
            or die(mysqli_error($conex));
    return $result;
}

function getClientes($numempleado) {

    $conex = getConnection();

    $query = "SELECT * FROM `lineaempleado` WHERE numeroempleado = $numempleado ";

    $result = mysqli_query($conex, $query)
            or die(mysqli_error($conex));
    while ($fila = mysqli_fetch_array($result)) {

        $clientes[$fila['dni']] = $fila['dni'];
    }

    return $clientes;
}

function getTodasDietas() {

    $conex = getConnection();

    $query = "SELECT * FROM `dieta` ";

    $result = mysqli_query($conex, $query)
            or die(mysqli_error($conex));

    while ($fila = mysqli_fetch_array($result)) {

        $dietas[$fila['coddieta']] = "Codigo: " . $fila['coddieta'] . " Nombre: " . $fila['semana'];
    }

    return $dietas;
}
function getNomDietas($coddieta) {

    $conex = getConnection();

    $query = "SELECT * FROM `dieta` WHERE coddieta = $coddieta";

    $result = mysqli_query($conex, $query)
            or die(mysqli_error($conex));

    while ($fila = mysqli_fetch_array($result)) {

        $dieta =$fila['semana'];
    }

    return $dieta;
}

function bindDietaCliente($cliente, $dieta) {

    $conex = getConnection();

    $query = "UPDATE `cliente` SET `coddieta` = '$dieta' WHERE `cliente`.`dni` = '$cliente'";
    $result = mysqli_query($conex, $query)
            or die(mysqli_error($conex));
    return $result;
}

function getObservaciones($dni) {

    $conex = getConnection();

    $query = "SELECT `disponibilidad`, `observaciones` FROM `cliente` WHERE dni = '$dni'";

    $result = mysqli_query($conex, $query)
            or die(mysqli_error($conex));
    $resultado = "<p style='color: #FF0000;'>Usuario no encontrado</p>";
    
    if ($fila = mysqli_fetch_array($result)) {
        if (trim($fila['observaciones']) == "") {
            $resultado = "<p>Disponibilidad del cliente $dni: " . $fila['disponibilidad'] . " dias</p>";
        } else {
            $resultado = "<p>Observaciones del cliente $dni: " . $fila['observaciones'] . "</p><p>Disponibilidad del cliente $dni: " . $fila['disponibilidad'] . " dias</p>";
        }
    }
    return $resultado;
}

function getTablas($dni) {


    $tab = "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";

    $conex = getConnection();


    $query = "SELECT ej.nombre, ej.series, ej.repeticiones, ej.link, t.tipo, s.dia
            FROM tablaejercicios t, lineatabla lt, sesion s, entrenamiento e, ejercicio ej, cliente c
            WHERE c.dni = '$dni'
            AND   c.codtabla = t.codtabla
            AND t.codtabla = lt.codtabla
            AND lt.codsesion = s.codsesion
            AND s.codsesion = e.codigosesion
            AND e.codigoejercicio = ej.codejercicio";
    $result = mysqli_query($conex, $query)
            or die(mysqli_error($conex));

    $tabla = "";
    $diaantit = "";
    $sesionantit = "";
    $primit = 1;
    while ($fila = mysqli_fetch_array($result)) {

        if ($primit == 1) {
            $tabla = $tabla . "
                                <h3>Tabla de &nbsp;" . $fila['tipo'] . "</h3>";
            $primit = 2;
        }

        if ($fila['dia'] != $diaantit) {
            $tabla = $tabla . "
                                <h3> $tab" . $fila['dia'] . "</h3>";

            $diaantit = $fila['dia'];
            $sesionantit = "";
        }

        $tabla = $tabla . "<p>$tab $tab <b>Nombre:</b>&nbsp;" . $fila['nombre'] . "</p>
                                <p>$tab $tab Series x Reps:&nbsp;" . $fila['series'] . "&nbsp;x&nbsp;" . $fila['repeticiones'] . "</p>"
                . "         <p>$tab $tab Link:" . $fila['link'] . " ";
    }

    return $tabla;
}

function getEjercicios() {
    $conex = getConnection();

    $query = "SELECT codejercicio, nombre FROM ejercicio ";

    $result = mysqli_query($conex, $query)
            or die(mysqli_error($conex));


    while ($fila = mysqli_fetch_array($result)) {

        $ejercicios[$fila['codejercicio']] = "Codigo: " . $fila['codejercicio'] . " - " . $fila['nombre'];
    }

    mysqli_close($conex);

    return $ejercicios;
}

function insertTabla($fecha, $tipo) {
    $conex = getConnection();

    $query = "INSERT INTO `tablaejercicios` (`codtabla`, `fecha`, `tipo`) VALUES (NULL, '$fecha', '$tipo')";

    $result = mysqli_query($conex, $query)
            or die(mysqli_error($conex));

    $idNuevo = mysqli_insert_id($conex);

    mysqli_close($conex);


    return $idNuevo;
}

function bindSesion($codSesion, $codTabla) {
    $conex = getConnection();

    $query = "INSERT INTO `lineatabla` (`codtabla`, `codsesion`) VALUES ('$codTabla', '$codSesion')";

    $result = mysqli_query($conex, $query)
            or die(mysqli_error($conex));

    mysqli_close($conex);

    return $result;
}

function insertEjercicio($nombre, $series, $repes, $peso, $link) {
    $conex = getConnection();

    $query = "INSERT INTO `ejercicio` (`codejercicio`, `nombre`, `series`, `repeticiones`, `peso`, `link`) "
            . "VALUES (NULL, '$nombre', '$series', '$repes', '$peso', '$link') ";

    $result = mysqli_query($conex, $query)
            or die(mysqli_error($conex));

    mysqli_close($conex);

    return $result;
}

function insertSesion($dia) {


    $conex = getConnection();

    $query = "INSERT INTO `sesion` (`codsesion`, `dia`) VALUES (NULL, '$dia') ";

    $result = mysqli_query($conex, $query)
            or die(mysqli_error($conex));

    $idNuevo = mysqli_insert_id($conex);

    mysqli_close($conex);
    return $idNuevo;
}

function bindEntrenamientoSesion($codejercicio, $codsesion) {

    $conex = getConnection();

    $query = "INSERT INTO `entrenamiento` (`codigoejercicio`, `codigosesion`) VALUES ('$codejercicio', '$codsesion') ";

    $result = mysqli_query($conex, $query)
            or die(mysqli_error($conex));

    mysqli_close($conex);

    return $result;
}

function getSesiones() {


    //SELECT * FROM `sesion` 

    $conex = getConnection();

    $query = "SELECT * FROM `sesion` ";

    $result = mysqli_query($conex, $query)
            or die(mysqli_error($conex));


    while ($fila = mysqli_fetch_array($result)) {

        $sesiones[$fila['codsesion']] = "Codigo: " . $fila['codsesion'] . " - " . $fila['dia'];
    }

    mysqli_close($conex);

    return $sesiones;
}

function bindSesionesTabla($idTabla, $idSesion) {
    $conex = getConnection();

    $query = "INSERT INTO `lineatabla` (`codtabla`, `codsesion`)"
            . " VALUES ('$idTabla', '$idSesion') ";

    $result = mysqli_query($conex, $query)
            or die(mysqli_error($conex));

    mysqli_close($conex);

    return $result;
}

function getTodasTablas() {

    $conex = getConnection();

    $query = "SELECT * FROM `tablaejercicios` ";

    $result = mysqli_query($conex, $query)
            or die(mysqli_error($conex));

    while ($fila = mysqli_fetch_array($result)) {

        $tablas[$fila['codtabla']] = "Codigo: " . $fila['codtabla'] . " Fecha: " . $fila['fecha'] . " Tipo: " . $fila['tipo'];
    }

    return $tablas;
}

function bindTablaCliente($dni, $tabla) {

    $conex = getConnection();

    $query = "UPDATE `cliente` SET `codtabla` = '$tabla' "
            . "WHERE `cliente`.`dni` = '$dni' ";

    $result = mysqli_query($conex, $query)
            or die(mysqli_error($conex));

    mysqli_close($conex);

    return $result;
}

function modificarPlan($dni, $plan) {
    $conex = getConnection();

    $query = "UPDATE `cliente`"
            . " SET codplan = '$plan'"
            . " WHERE `dni` = '$dni' ";

    $result = mysqli_query($conex, $query)
            or die(mysqli_error($conex));

    mysqli_close($conex);

    return $result;
}
