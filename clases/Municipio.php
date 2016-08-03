<?php
class Municipio
{
    private $_id;
    private $_idestado;
    private $_nombre;

    public function setPropiedades($id,$idestado,$nombre)
    {
        $this->_id = $id;
        $this->_idestado = $idestado;
        $this->_nombre = $nombre;
    }
    public function buscar($sql,$acceso)
    {
        if(($consulta=$acceso->ejecutarSql($sql)))
        {
             if($acceso->registros>0)
             {
                $consulta=$acceso->devolver_recordset();
                $this->setPropiedades($consulta['idmunicipio'],$consulta['idestado'],$consulta['descripmunicipio']);
                return true;
             }
             else
             {
                return false;
             }
        }
    }
    
    public function mostrar($sql,$acceso)
    {
        if(($consulta=$acceso->ejecutarSql($sql)))
            {
                    return $consulta;
            }
    }
    
    }