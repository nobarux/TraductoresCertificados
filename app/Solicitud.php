<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Solicitud extends Model
{
    protected $table = "solicituds";
    public $primaryKey = "id";

    public function idioma()
     {
         return $this->belongsTo('App\Idiomas','id_Idioma');
     }

     public function listaidiomas($idIdioma)
      {
        $listaidioma = Idioma::where('id_Idioma', $idIdioma)->first();
       return $listaidioma->nombre;
      }

      public function listaestados($idEstado)
      {
        $listaestados = Estado::where('id_Estados', $idEstado)->first();
       return $listaestados->nombre;
      }

      public function listaprovincias($idProvincia)
      {
        $listaprov = Provincia::where('dpa', $idProvincia)->first();
       return $listaprov->nombre;
      }

      public function listamunicipio($idMunicipio)
      {
        $listamun = Municipio::where('id', $idMunicipio)->first();
        // dd($listamun);
       return $listamun->nombre;
      }

      public function listaprofesion($idProfesion)
      {
        $listaprof = Profesion::where('id_Prof', $idProfesion)->first();
       return $listaprof->nombre;
      }

      public function listacolor($idColor)
      {
        $listacol = ColorPiel::where('id_Color', $idColor)->first();
        // dd($idColor);
        // if ($idColor == 0) {
        //   dd($idColor);
        //   $listacol->descripcion = "a";
        // }
       return $listacol->descripcion;
      }

      public function listacertificacion($idCert)
      {
        $listacert = Certificacion::where('id_Tipo_Cert', $idCert)->first();
       return $listacert->nombre;
      }

      public function listarazones($idRazones)
      {
        $listaraz = Razones::where('idRazones', $idRazones)->first();
       return $listaraz->descripciones;
      }

}
