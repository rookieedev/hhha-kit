<?php 

namespace Rookieedev\HhhaKit\Database\Eloquent\Concerns;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Container\Container;

/**
 * Trait LogBasico
 *
 * Trait para registrar logs básicos de creación y actualización en modelos Eloquent.
 */
trait LogBasico 
{   
    /**
     * Indica si se debe registrar el log básico.
     *
     * @var bool
     */
    public bool $log_basico = true;

    /**
     * Nombre de la columna para el usuario que creó el registro.
     */
    const CREADO_POR_USUARIO = '';

    /**
     * Nombre de la columna para la IP desde la cual se creó el registro.
     */
    const CREADO_POR_IP = '';

    /**
     * Nombre de la columna para el usuario que actualizó el registro.
     */
    const ACTUALIZADO_POR_USUARIO = '';

    /**
     * Nombre de la columna para la IP desde la cual se actualizó el registro.
     */
    const ACTUALIZADO_POR_IP = '';

    /**
     * Registra los eventos para actualizar el log básico.
     *
     * @return void
     */
    public static function bootLogBasico()
    {
        static::creating(fn (Model $instancia) => $instancia->actualizarLogBasico($instancia) );
        static::updating(fn (Model $instancia) => $instancia->actualizarLogBasico($instancia) );
    }

    /**
     * Verifica si se debe registrar el log básico para la instancia dada.
     *
     * @param Model $instancia
     * @return bool
     */
    public function registrarLogBasico(Model $instancia): bool
    {
        return $instancia->log_basico;
    }

    /**
     * Actualiza los campos de log básico para la instancia dada.
     *
     * @param Model $instancia
     * @return void
     */
    public function actualizarLogBasico(Model $instancia)
    {
        if ($instancia->registrarLogBasico($instancia)) {

            $request = Container::getInstance()->make('request');

            if (! $instancia->exists ) {
                $instancia->setAttribute($instancia->columnaCreaUsuarioId(), $instancia->idUsuario());
                $instancia->setAttribute($instancia->columnaCreaIp(), $instancia->ipUsuario());
            }

            if ( $instancia->isDirty() ) {
                $instancia->setAttribute($instancia->columnaModUsuarioId(), $instancia->idUsuario());
                $instancia->setAttribute($instancia->columnaModIp(), $instancia->ipUsuario());
            }            
        }
    }

    /**
     * Obtiene el nombre de la columna para el usuario que creó el registro.
     *
     * @return string
     */
    public function columnaCreaUsuarioId()
    {
        return static::CREADO_POR_USUARIO;
    }

    /**
     * Obtiene el nombre de la columna para la IP desde la cual se creó el registro.
     *
     * @return string
     */
    public function columnaCreaIp(): string
    {
        return static::CREADO_POR_IP;
    }

    /**
     * Obtiene el nombre de la columna para el usuario que actualizó el registro.
     *
     * @return string
     */
    public function columnaModUsuarioId(): string
    {
        return static::ACTUALIZADO_POR_USUARIO;
    }

    /**
     * Obtiene el nombre de la columna para la IP desde la cual se actualizó el registro.
     *
     * @return string
     */
    public function columnaModIp(): string
    {
        return static::ACTUALIZADO_POR_IP;
    }

    /**
     * Obtiene el ID del usuario actual que realizó la solicitud.
     *
     * @return null El ID del usuario actual o null si no hay usuario autenticado.
     */
    public function idUsuario(): int
    {
        $request = Container::getInstance()->make('request');

        return $request->user()->id;
    }

    /**
     * Obtiene la dirección IP desde la cual se realizó la solicitud.
     *
     * @return string La dirección IP del cliente que realizó la solicitud.
     */
    public function ipUsuario(): string
    {
        $request = Container::getInstance()->make('request');

        return $request->ip();
    }
}