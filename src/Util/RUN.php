<?php

declare(strict_types=1);

namespace Rookieedev\HhhaKit\Util;

class RUN
{
    /**
     * Valida un RUT independientemente del formato en el que se proporciona.
     *
     * Este método recibe una cadena que representa un RUT en cualquier formato y lo valida.
     * Se elimina cualquier caracter que no sea un número o la letra 'K' (o 'k'), luego se realiza la validación.
     *
     * @param string $cadena La cadena que representa el RUT en cualquier formato.
     * @return object|null Un objeto con el resultado de la validación del RUT. Si el RUT es válido, se devuelve un objeto con el resultado de la validación. Si no es válido, se devuelve null.
     */
    public static function formatoDesconocido(string $cadena): object|null
    {
        $cadenaLimpia = preg_replace('/[^0-9Kk]/', '', $cadena);       

        return ( new self() )->validarRUN($cadenaLimpia);
    }

    /**
     * Método protegido para validar un número de RUN.
     *
     * Este método toma un número de RUN limpio (solo dígitos y posiblemente 'K' o 'k') y su dígito verificador,
     * y verifica si el dígito verificador coincide con el dígito verificador calculado.
     * Si coincide, devuelve un objeto que representa el número de RUN completo, de lo contrario, devuelve null.
     *
     * @param string $cadena El número de RUN limpio (solo dígitos y 'K' o 'k').
     * @return object|null Un objeto que representa el número de RUN completo si es válido, o null si no lo es.
     */
    protected function validarRUN($cadena): object|null
    {       
        $cadena      = strtoupper($cadena);
        $numero      = substr($cadena, 0, -1);
        $verificador = substr($cadena, -1);

        if ( $verificador == self::obtenerDigitoVerificador($numero) ) {
            $objeto = self::formatear($numero, $verificador);

            return $objeto;
        }

        return null;
    }

    /**
     * Método estático para formatear un número de RUN.
     *
     * Este método toma un número de RUN y su dígito verificador y devuelve un objeto que proporciona métodos
     * para obtener el número completo, parcial y el dígito verificador.
     *
     * @param int $numero El número de RUN sin el dígito verificador.
     * @param string $verificador El dígito verificador del número de RUN.
     * @return object Un objeto que proporciona métodos para formatear el número de RUN.
     */
    public static function formatear(int $numero, string $verificador): object
    {
        return new class($numero, $verificador) {

            public function __construct($numero, $verificador)
            {
                $this->numero      = $numero;
                $this->verificador = $verificador;
            }

            public function soloNumero()
            {
                return $this->numero;
            }

            public function soloVerificador()
            {
                return $this->verificador;
            }

            public function completo()
            {
                return number_format($this->numero, 0, ',', '.').'-'.$this->verificador;
            }

            public function parcial()
            {
                return $this->numero.'-'.$this->verificador;
            }

        };
    }

    /**
     * Método estático para obtener el dígito verificador de un número de RUN chileno.
     *
     * @param int $numero El número de RUN sin el dígito verificador.
     * @return string El dígito verificador calculado.
     */
    public static function obtenerDigitoVerificador(int $numero): string
    {
        $s = 1;

        for($m=0; $numero!=0; $numero/=10){
            $s= ($s+$numero%10*(9-$m++%6))%11;
        }

        return chr($s?$s+47:75);
    }
}
