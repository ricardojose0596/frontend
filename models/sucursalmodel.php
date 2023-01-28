<?php

class SucursalModel extends Model implements IModel{

    private $codSucursal;
    private $estado;
    private $ciudad;
    private $direccion;
    private $estatus;

    public function __construct(){
        parent::__construct();

        $this->estado   = '';
        $this->ciudad   = '';
        $this->direccion = '';
        $this->estatus = '';
    }

    //========================CRUD SUCURSAL===================================

    //Registrar Sucursal

    public function save(){
        try{
            $query = $this->prepare('INSERT INTO sucursal(estado, ciudad, direccion, estatus) VALUES(:estado, :ciudad, :direccion, :estatus)');
            $query->execute([
                'estado'         => $this->estado, 
                'ciudad'         => $this->ciudad,
                'direccion'      => $this->direccion,
                'estatus'        => $this->estatus,
                ]);
            return true;
        } catch(PDOException $e){
            echo $e;
            return false;
        }
    }

    //Mostrar Registro de Sucursal

    public function getAll(){

        $items = [];

        try{
            $query = $this >query('SELECT * FROM sucursal');

            while($p = $query->fetch(PDO::FETCH_ASSOC)){
                $item = new SucursalModel();
                $item->setcodSucursal($p['codSucursal']);
                $item->setestado($p['estado']);
                $item->setciudad($p['ciudad']);
                $item->setdireccion($p['direccion']);
                $item->setestatus($p['estatus']);

                array_push($items, $item);
            }
            return $items;

        }catch(PDOException $e){
            echo $e;
        }
    }

    // Buscar depende de codSucursal

    public function get($codSucursal){
        try{
            $query = $this >prepare('SELECT * FROM sucursal WHERE codSucursal = :codSucursal');
            $query->execute([ 'codSucursal' => $codSucursal]);
            $medicina = $query->fetch(PDO::FETCH_ASSOC);

                $this->setcodSucursal($sucursal['codSucursal']);
                $this->setestado($sucursal['estado']);
                $this->setciudad($sucursal['ciudad']);
                $this->setdireccion($sucursal['direccion']);
                $this->setestatus($sucursal['estatus']);            
                return this;

        }catch(PDOException $e){
            return false;
        }
    }

    //Eliminar depende de codSucursal

    public function delete($codcodSucursal){
        try{
            $query = $this->prepare('DELETE FROM sucursal WHERE codSucursal = :codSucursal');
            $query->execute([ 'codSucursal' => $codSucursal]);
            return true;
        }catch(PDOException $e){
            echo $e;
            return false;
        }
    } 

    //Actualizar sucursal
    
    public function update(){
        try{
            $query = $this->prepare('UPDATE sucursal SET estado = :estado, ciudad = :ciudad, direccion = :direccion, WHERE codSucursal = :codSucursal');
            $query->execute([
                'codSucursal'        => $this->codSucursal,
                'estado'            => $this->estado, 
                'ciudad'       => $this->ciudad,
                'direccion'   => $this->direccion,
                'estatus'            => $this->estatus,
                ]);
            return true;
        }catch(PDOException $e){
            echo $e;
            return false;
        }
    }
    
    public function from($array){
        $this->codSucursal = $array['codSucursal'];
        $this->estado = $array['estado'];
        $this->ciudad = $array['ciudad'];
        $this->direccion = $array['direccion'];
        $this->estatus = $array['estatus'];
    }

    public function setcodSucursal($codSucursal)            {             $this->codSucursal = $codSucursal;}
    public function setciudad($ciudad)                      {             $this->ciudad = $ciudad;}
    public function setestado($estado)                      {             $this->estado = $estado;}
    public function setdireccion($direccion)                {             $this->direccion = $direccion;}
    public function setestatus($estatus)                    {             $this->estatus = $estatus;}

    public function getcodSucursal()                {        return $this->codSucursal;}
    public function getciudad()                     {        return $this->ciudad;}
    public function getestado()                     {        return $this->estado;}
    public function getdireccion()                  {        return $this->direccion;}
    public function getestatus()                    {        return $this->estatus;}

}