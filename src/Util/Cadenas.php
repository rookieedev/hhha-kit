<?php 
namespace Modules\Oncologia\Helpers;

class Cadenas 
{
    /**
     * Pasa todos los textos a mayuscula en un array
     *
     * @param  array $array
     *
     * @return array
     */
    public static function mayusculaRecursiva($array)
    {
        foreach ($array as $clave => $valor) {
            $array[$clave] = is_array($valor) ? self::mayusculaRecursiva($valor) : mb_strtoupper($valor, 'UTF-8');
        }
        
        return $array;
    }

    /**
     * Validar el formato json de una cadena
     *
     * @param  string $json
     *
     * @return bool
     */
    public static function validarFormatoJson($json)
    {
        try {
            json_decode($json);
        } catch (\JsonException $e) {
            return false;
        }  

        return true;
    }

    /**
     * Remplazar caraceteres especiales en cadena
     *
     * @param  string $cadena
     *
     * @return string
     */
    public static function remplazarCaracteresEnCadena(string $cadena) 
    {
        $entidades = [
            '&AMP;'    => '&', '&NBSP;'    => ' ', '&GT;'     => '>', '&LT;'    => '<', '&QUOT;'   => '"', '&APOS;'   => "'", '&COPY;'   => '©', '&REG;'   => '®', '&TRADE;'  => '™', '&ETH;'    => 'ð', '&THORN;'  => 'þ',
            '&YEN;'    => '¥', '&Eacute;'  => 'É', '&eacute;' => 'é', '&euro;'  => '€', '&ndash;'  => '–', '&mdash;'  => '—', '&hellip;' => '…', '&bull;'  => '•', '&laquo;'  => '«', '&raquo;'  => '»', '&lsaquo;' => '‹',
            '&rsaquo;' => '›', '&ldquo;'   => '“', '&rdquo;'  => '”', '&bdquo;' => '„', '&lsquo;'  => '‘', '&rsquo;'  => '’', '&sbquo;'  => '‚', '&cent;'  => '¢', '&pound;'  => '£', '&curren;' => '¤', '&yuml;'   => 'ÿ',
            '&iexcl;'  => '¡', '&iquest;'  => '¿', '&ordm;'   => 'º', '&ordf;'  => 'ª', '&not;'    => '¬', '&sup1;'   => '¹', '&sup2;'   => '²', '&sup3;'  => '³', '&frac14;' => '¼', '&frac12;' => '½', '&frac34;' => '¾',
            '&middot;' => '·', '&para;'    => '¶', '&sect;'   => '§', '&micro;' => 'µ', '&plusmn;' => '±', '&times;'  => '×', '&divide;' => '÷', '&cent;'  => '¢', '&euro;'   => '€', '&pound;'  => '£', '&yen;'    => '¥',
            '&sect;'   => '§', '&laquo;'   => '«', '&raquo;'  => '»', '&lsquo;' => '‘', '&rsquo;'  => '’', '&ldquo;'  => '“', '&rdquo;'  => '”', '&bdquo;' => '„', '&dagger;' => '†', '&Dagger;' => '‡', '&permil;' => '‰',
            '&hellip;' => '…', '&oline;'   => '‾', '&frasl;'  => '⁄', '&prime;' => '′', '&Prime;'  => '″', '&lsaquo;' => '‹', '&rsaquo;' => '›', '&oline;' => '‾', '&weierp;' => '℘', '&image;'  => 'ℑ','&real;'    => 'ℜ',
            '&trade;'  => '™', '&alefsym;' => 'ℵ', '&larr;'   => '←',
        ];

        foreach($entidades as $codificado => $decodificado) {
            $cadena = str_ireplace($codificado, $decodificado, $cadena);
        }

        return $cadena;
    }

    /**
     * Borrar estilos y clases de etiqueta
     *
     * @param  string $cadena
     *
     * @return string
     */
    public static function quitarClasesEstilosEnCadena(string $cadena)
    {
        $cadena = preg_replace('/(<[^>]+) class=".*?"/i', '$1', $cadena);
        $cadena = preg_replace('/(<[^>]+) style=".*?"/i', '$1', $cadena);

        return $cadena;
    }


}