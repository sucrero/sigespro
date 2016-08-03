<?php
class Parroquia
{
    private $_id;
    private $_idmunicipio;
    private $_nombre;

    public function setPropiedades($id,$idmunicipio,$nombre)
    {
        $this->_id = $id;
        $this->_idmunicipio = $idmunicipio;
        $this->_nombre = $nombre;
    }
    public function buscar($sql,$acceso)
    {
        if(($consulta=$acceso->ejecutarSql($sql)))
        {
             if($acceso->registros>0)
             {
                $consulta=$acceso->devolver_recordset();
                $this->setPropiedades($consulta['idparroquia'],$consulta['idmunicipio'],$consulta['descripparroquia']);
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