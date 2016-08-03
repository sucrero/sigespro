<?php
class Estado
{
    private $_codigo;
    private $_nombre;

    
    public function setPropiedades($codigo,$nombre)
    {
        $this->_codigo = $codigo;
        $this->_nombre = $nombre;
    }
    function buscar($sql,$acceso)
    {
        if(($consulta=$acceso->ejecutarSql($sql)))
        {
             if($acceso->registros>0)
             {
                $consulta=$acceso->devolver_recordset();
                $this->setPropiedades($consulta['idestado'],$consulta['descripestado']);
                return true;
             }
             else
             {
                return false;
             }
        }
    }
    
    function mostrar($sql,$acceso)
    {
        if(($consulta=$acceso->ejecutarSql($sql)))
            {
                    return $consulta;
            }
    }
}