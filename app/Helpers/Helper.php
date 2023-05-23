<?php

namespace App\Helpers;

use App\Models\Book;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;

class Helper
{
   /**
    * activeLink
    *
    * @param  mixed $links
    * @return void
    */
   public static function activeLink(array $links)
   {
      $routeName = Route::current()->getName();
      if (in_array($routeName, $links)) {
         echo "active";
      }
   }
   public static function selectUser(int $id)
   {
      return DB::select('SELECT * from users where id = :id', ['id' => $id])[0];
   }  
   public static function returnPlatCategorie(int $cat_id)
   {
      $platCatgorie = "";
      $cat = DB::select('SELECT * from categories where id = :id', ['id' => $cat_id]);
      if (!empty($cat) && isset($cat[0]) && $cat[0]->nombre_plats !== 0) {
         $cat = $cat[0];
            $platCatgorie = $cat->titre;
      }
      return $platCatgorie;
   }   
   public static function formulesDuMenu(int $id)
   {
      return DB::select('SELECT * from formules where menu_id = :id', ['id' => $id]);
   }
   public static function returnPlat(int $id)
   {
      return DB::select('SELECT * from plats where id = :id', ['id' => $id])[0];
   }
   public static function horairesJour(int $id)
   {
      return DB::select('SELECT * from horaires where jour_id = :id', ['id' => $id]);
   }  
   public static function returnJours()
   {
      return DB::select('SELECT * from jours');
   }
   public static function selectJour(string $titre)
   {
      return DB::select('SELECT * from jours where titre = :titre', ['titre' => $titre])[0];
   }  
   
   public static function returnMenuFormule(int $menu_id)
   {
      $formuleMenu = "";
      $menu = DB::select('SELECT * from menus where id = :id', ['id' => $menu_id]);
      if (!empty($menu) && isset($menu[0]) && $menu[0]->nombre_formules !== 0) {
         $menu = $menu[0];
            $formuleMenu = $menu->titre;
      }
      return $formuleMenu;
   }
   public static function returnNameBlongsToId(int $id, string $table){
      $name = "";
      $data = DB::select("SELECT * from $table where id = :id", ['id' => $id]);
      if (!empty($data) && isset($data[0])) {
         $data = $data[0];
            $name = $data->titre;
      }
      return $name;
   } 

   /**
    * categoriePlats
    *
    * @param  mixed $cat_id
    * @return void
    */
   public static function categoriePlats(int $cat_id)
   {
      return DB::select('SELECT * from plats where categorie_id = :id', ['id' => $cat_id]);
   }   
   /**
    * platImage
    *
    * @param  mixed $titre
    * @return void
    */
   public static function platImage($titre)
   {
     $imagePath = "";
     $plat = DB::select("SELECT * from plats where titre = :titre", ['titre' => $titre]);
     if(!empty($plat)&& isset($plat[0])){
      $image = DB::select("SELECT * from galerie where titre = :titre",['titre' => $plat[0]->titre]);
      if(!empty($image)&& isset($image[0])){
         $imagePath = $image[0]->image;
      }
     }
     return $imagePath;
   }

}
