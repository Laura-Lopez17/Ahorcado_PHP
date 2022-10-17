<?php
$frases = [
    "IES La Encanta",
    "La vida de Brian",
    "Java es divertido",
    "Matrix es una gran pelicula",
    "Ojo con el ajo",
    "Pirineos y Alpes",
    "Comunidad Valenciana",
    "Informatica es CS en ingles",
    "Africa y Europa",
    "Asia y America",
    "Chincheta",
    "Frigorifico",
    "Chimenea",
    "Rojales",
    "Rio Segura"
];

function generarFraseEnmascarada(string $frase): string
{
    $a = mb_str_split($frase); //pasa string a array
    $fraseEnmascarada = "";
    foreach ($a as $i => $valor) {
        if ($valor == " ") {
            $fraseEnmascarada .= " ";
        } else {
            $fraseEnmascarada .= "_";
        }
    }

    return $fraseEnmascarada;
}

$i = rand(0, count($frases) - 1); // genera un numero random
$frase = $frases[$i]; //genera una frase random
$enmascarada = generarFraseEnmascarada($frase);
$fraseArray = mb_str_split($frase, 1, "UTF-8");
$arrayEnmasc = mb_str_split($enmascarada, 1, "UTF-8");
$intentos = 6;


function showInfo($intentos)
{
    switch ($intentos) {
        case 6:
            echo <<<_END
                ____
                |    |
                |    
                |   
                |   
                |
               ---\n
            _END;
            break;
        case 5:
            echo <<<_END
                ____
                |    |
                |    O
                |   
                |   
                |
               ---\n
            _END;
            break;
        case 4:
            echo <<<_END
                ____
                |    |
                |    O
                |    |
                |   
                |
               ---\n
            _END;
            break;
        case 3:
            echo <<<_END
                ____
                |    |
                |    O
                |   /|
                |   
                |
               ---\n
            _END;
            break;
        case 2:
            echo <<<_END
                ____
                |    |
                |    O
                |   /|\
                |   
                |
               ---\n
            _END;
            break;
        case 1:
            echo <<<_END
                ____
                |    |
                |    O
                |   /|\
                |   /
                |
               ---\n
            _END;
            break;
        case 0:
            echo <<<_END
                ____
                |    |
                |    O
                |   /|\
                |   / \
                |
               ---\n
            _END;
            break;
    }
}


do {

    showInfo($intentos);
    echo implode("", $arrayEnmasc);
    echo "\n";
    echo "\n";
    $letra = readline("Dame una letra: ");
    $numLetras = 0;

    if (ctype_alpha($letra) && mb_strlen($letra) == 1) { //si es un numero o una frase te da error 
        foreach ($fraseArray as $i => $v) {
            if (mb_strtolower($letra) == mb_strtolower($v)) { //pasa a minusculas la letra
                $arrayEnmasc[$i] = $v; //sustituye la letra
                $numLetras++; //cuenta si es correcta la letra
            }
        }


        if ($numLetras == 0) {
            $intentos--;
            echo "Has fallado te quedan " . $intentos . " intentos\n";
        } else {
            echo implode("", $arrayEnmasc) . "\n";
            $resolver = readline("¿Quieres resolver?[S/N]");
            if ($resolver == "S" || $resolver == "s") {
                $resuelto = readline("Resuelve:");
                if ($resuelto == $frase) { //si la resuelto es igual que la frase has ganado
                    echo "HAS GANADO";
                    break;
                } else {
                    $intentos--;
                    showInfo($intentos);
                    echo "Has fallado te quedan " . $intentos . " intentos\n";
                }
            }
        }
    } else {
        echo "¡ERROR! No es una letra\n";
    }



    $guiones = array_filter($arrayEnmasc, fn ($car) => $car == "_");
} while (count($guiones) > 0 && $intentos > 0);

if ($intentos == 0) {
    showInfo($intentos);
    echo "Oooh... Has perdido.La frase era: $frase";
}
//MOSTRAR ULTIMA PIERNA Y MENSAJE DE HAS PERDIDO
