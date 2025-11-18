<?php

namespace PortalDeEmpleo2\Helpers;
use PortalDeEmpleo2\Model\Alumno;
use PortalDeEmpleo2\Model\Empresa;
use PortalDeEmpleo2\Model\Oferta;
use PortalDeEmpleo2\Model\FamiliaProfesional;

class Converted{

    public static function jsonToAlumno(string $json){

    }

    public static function alumnoToJson(Alumno $alumno){
        //$alumnoJson =
        return [
            'id' => $alumno->getId(),
            'correo' => $alumno->getCorreo(),
            'rol' => $alumno->getRol(),
            'foto' => $alumno->getFoto(),
            'nombre' => $alumno->getNombre(),
            'apellidos' => $alumno->getApellidos(),
            'direccion' => $alumno->getDireccion(),
            'cv' => $alumno->getCv()
        ];

        //return json_encode($alumnoJson, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);
    }

    public static function empresaToJson(Empresa $empresa){
        return [
            'id' => $empresa->getId(),
            'correo' => $empresa->getCorreo(),
            'rol' => $empresa->getRol(),
            'foto' => $empresa->getFoto(),
            'nombre' => $empresa->getNombre(),
            'direccion' => $empresa->getDireccion(),
            'telefonoContacto' => $empresa->getNumPersonaContacto()
        ];
    }

    public static function ofertaToJson(Oferta $oferta){
        return [
            'id' => $oferta->getId(),
            'fechaInicio' => $oferta->getFechaInicio(),
            'fechaFin' => $oferta->getFechaFin(),
            'descripcion' => $oferta->getDescripcion(),
            'empresaId' => $oferta->getEmpresaId()
        ];
    }


    public static function alumnosToJson(array $alumnos){
        $alumnosJson = [];
        foreach ($alumnos as $alumno) {
            $alumnosJson[] = [
                'id' => $alumno->getId(),
                'correo' => $alumno->getCorreo(),
                'rol' => $alumno->getRol(),
                'foto' => $alumno->getFoto(),
                'nombre' => $alumno->getNombre(),
                'apellidos' => $alumno->getApellidos(),
                'direccion' => $alumno->getDireccion(),
                'cv' => $alumno->getCv()
            ];
        }
        return json_encode($alumnosJson, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);
    }

    public static function ofertasToJson(array $ofertas){
        $ofertasJson = [];
        foreach($ofertas as $oferta){
            $ciclosOferta = [];
            foreach($oferta->getCiclos() as $ciclo){
                $ciclosOferta[] = [
                    'nombre' => $ciclo->getNombre() . " (" . $ciclo->getNivel() . ")" 
                ];
            }

            $ofertasJson[] = [
                'id' => $oferta->getId(),
                'fechaInicio' => $oferta->getFechaInicio(),
                'fechaFin' => $oferta->getFechaFin(),
                'descripcion' => $oferta->getDescripcion(),
                'empresaId' => $oferta->getEmpresaId(),
                'ciclos' => $ciclosOferta
            ];
        }
        return json_encode($ofertasJson, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);
    }

    public static function ciclosToJson(array $ciclos){
        $ciclosJson = [];
        foreach($ciclos as $ciclo){
            $ciclosJson[] = [
                'id'        => $ciclo->getId(),
                'nombre'    => $ciclo->getNombre(),
                'nivel'     => $ciclo->getNivel(),
                'familiaId' => $ciclo->getFamiliaId()
            ];
        }
        return json_encode($ciclosJson, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);
    }

    public static function solicitudesToJson(array $solicitudes){
        $solicitudesJson = [];
        foreach($solicitudes as $solicitud){
            $solicitudesJson[] = [
                'id'        => $solicitud->getId(),
                'fecha'     => $solicitud->getFecha(),
                'estado'    => $solicitud->getEstado(),
                'alumnoId'  => $solicitud->getAlumnoId(),
                'ofertaId'  => $solicitud->getOfertaId()
            ];
        }
        return json_encode($solicitudesJson, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);
    }

    public static function familiasToJson(array $familias){
        $familiasJson = [];
        foreach($familias as $familia){
            $familiasJson[] = [
                'id'        => $familia->getId(),
                'nombre'    => $familia->getNombre()
            ];
        }
        return json_encode($familiasJson, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);;
    }

    public static function familiaToJson(FamiliaProfesional $familia){
        return[
            'id'        => $familia->getId(),
            'nombre'    => $familia->getNombre()
        ];
    }

    public static function codificarPassw($contraseña){
        $contraseña = password_hash($contraseña, PASSWORD_DEFAULT);
        return $contraseña;
    }

    public static function fotoCuadrada($file){
        $rutaTmp = $file['tmp_name'];
        $info = getimagesize($rutaTmp);
        $mime = $info['mime'];

        // Crear imagen desde el tipo
        if($mime === 'image/jpeg'){
            $img = imagecreatefromjpeg($rutaTmp);
            // Corregir orientación EXIF si existe
            $exif = @exif_read_data($rutaTmp);
            if(!empty($exif['Orientation'])){
                switch($exif['Orientation']){
                    case 3:
                        $img = imagerotate($img, 180, 0);
                        break;
                    case 6:
                        $img = imagerotate($img, -90, 0);
                        break;
                    case 8:
                        $img = imagerotate($img, 90, 0);
                        break;
                }
            }
        } elseif($mime === 'image/png'){
            $img = imagecreatefrompng($rutaTmp);
        } else {
            return false; // tipo no soportado
        }

        // Recortar a cuadrado
        $w = imagesx($img);
        $h = imagesy($img);
        $size = min($w, $h);
        $x = ($w - $size)/2;
        $y = ($h - $size)/2;

        $cuadrada = imagecreatetruecolor($size, $size);

        // Mantener transparencia si PNG
        if($mime === 'image/png'){
            imagealphablending($cuadrada, false);
            imagesavealpha($cuadrada, true);
        }

        imagecopyresampled($cuadrada, $img, 0, 0, $x, $y, $size, $size, $size, $size);
        imagedestroy($img);

        return $cuadrada;
    }

}

?>