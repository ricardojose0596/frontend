<?php

class MedicinaModel extends Model implements IModel{

    private $codMedicina;
    private $formula;
    private $presentacion;
    private $cantidadUnidades;
    private $estatus;

    public function __construct(){
        parent::__construct();

        $this->formula = '';
        $this->presentacion = '';
        $this->cantidadUnidades = '';
        $this->estatus = '';
    }

    //========================CRUD MEDICINA===================================

    //Registrar Medicina

    public function save(){

        try{
            $query = $this->prepare('INSERT INTO medicina(formula, presentacio, cantidadUnidades, estatus) VALUES(:formula, :presentacion, :cantidadUnidades, :estatus)');
            $query->execute([
                'formula'               => $this->formula, 
                'presentacion'          => $this->presentacion,
                'cantidadUnidades'      => $this->cantidadUnidades,
                'estatus'               => $this->estatus,
                ]);
            return true;
        } catch(PDOException $e){
            echo $e;
            return false;
        }
    }

    //Mostrar Registro de Medicina

    public function getAll(){

        $items = [];

        try{
            $query = $this >query('SELECT * FROM medicina');

            while($p = $query->fetch(PDO::FETCH_ASSOC)){
                $item = new MedicinaModel();
                $item->setcodMedicina($p['codMedicina']);
                $item->setformula($p['formula']);
                $item->setpresentacion($p['presentacion']);
                $item->setcantidadUnidades($p['cantidadUnidades']);
                $item->setestatus($p['estatus']);

                array_push($items, $item);
            }
            return $items;

        }catch(PDOException $e){
            echo $e;
        }
    } 

    // Buscar depende de codMedicina

    public function get($codMedicina){
        try{
            $query = $this >prepare('SELECT * FROM medicina WHERE codMedicina = :codMedicina');
            $query->execute([ 'codMedicina' => $codMedicina]);
            $medicina = $query->fetch(PDO::FETCH_ASSOC);

                $this->setcodMedicina($medicina['codMedicina']);
                $this->setformula($medicina['formula']);
                $this->setpresentacion($medicina['presentacion']);
                $this->setcantidadUnidades($medicina['cantidadUnidades']);
                $this->setestatus($medicina['estatus']);            
                return this;

        }catch(PDOException $e){
            return false;
        }
    }

    //Eliminar depende de codMedicina

    public function delete($codMedicina){
        try{
            $query = $this->prepare('DELETE FROM medicina WHERE codMedicina = :codMedicina');
            $query->execute([ 'codMedicina' => $codMedicina]);
            return true;
        }catch(PDOException $e){
            echo $e;
            return false;
        }
    } 

    //Actualizar medicina
    
    public function update(){
        try{
            $query = $this->prepare('UPDATE medicina SET formula = :formula, presentacion = :presentacion, cantidadUnidades = :cantidadUnidades, WHERE codMedicina = :codMedicina');
            $query->execute([
                'codMedicina'        => $this->codMedicina,
                'formula'            => $this->formula, 
                'presentacion'       => $this->presentacion,
                'cantidadUnidades'   => $this->cantidadUnidades,
                'estatus'            => $this->estatus,
                ]);
            return true;
        }catch(PDOException $e){
            echo $e;
            return false;
        }
    }
    
    public function from($array){
        $this->codMedicina = $array['codMedicina'];
        $this->formula = $array['formula'];
        $this->presentacion = $array['presentacion'];
        $this->cantidadUnidades = $array['cantidadUnidades'];
        $this->estatus = $array['estatus'];
    }

    public function setcodMedicina($codMedicina)            {             $this->codMedicina = $codMedicina;}
    public function setformula($formula)                    {             $this->formula = $formula;}
    public function setpresentacion($presentacion)          {             $this->presentacion = $presentacion;}
    public function setcantidadUnidades($cantidadUnidades)  {             $this->cantidadUnidades = $cantidadUnidades;}
    public function setestatus($estatus)                    {             $this->estatus = $estatus;}

    public function getcodMedicina()                {        return $this->codMedicina;}
    public function getformula()                    {        return $this->formula;}
    public function getpresentacion()               {        return $this->presentacion;}
    public function getcantidadUnidades()           {        return $this->cantidadUnidades;}
    public function getestatus()                    {        return $this->estatus;}
}