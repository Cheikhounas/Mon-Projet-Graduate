<?php

namespace App\Http\Controllers;

use App\Gestion\ImageGestionInterface;
use App\Models\Categorie;
use App\Models\Formule;
use App\Models\Galerie;
use App\Models\Horaire;
use App\Models\Jour;
use App\Models\Menu;
use App\Models\Plat;
use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Session;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{

    /**
     * images
     *
     * @return void
     */
    public function images()
    {
        $images = DB::select('SELECT * FROM galerie');
        return view("account.images", compact('images'));
    }

    /**
     * addImage
     *
     * @return void
     */
    public function addImage()
    {
        return view("account.addimage");
    }
    /**
     * storeImage
     *
     * @param  mixed $request
     * @param  mixed $image
     * @return void
     */
    public function storeImage(Request $request, ImageGestionInterface $image)
    {
        $validator = Validator::make($request->all(), [
            'titre' => 'required|min:3',
            "photo" => 'required|image|mimes:jpeg,png,jpg',
        ], [
            'titre.required' => 'Titre est obligatoire.',
            'titre.min' => 'Titre doit être au moins 3 caractères.',
            'photo.required' => 'Image est obligatoire.',
            'photo.mimes' => 'Image doit être de type: jpeg ou png ou jpg.'
        ]);
        if ($validator->fails()) {
            return redirect()->route("addimage")
                ->withErrors($validator);
        }

        $galerie = new Galerie();
        if ($image->save($request->file("photo"))  !== false) {
            $galerie->titre = $request->input("titre");
            $galerie->image = $image->imagePath;
            if ($galerie->save()) {
                Session::flash("success", "Image ajouté.");
            } else {
                Session::flash("fail", "Ouoops une erreur est suvernue.");
            }
        } else {
            Session::flash("fail", "Ouoops une erreur est suvernue.");
        }
        return redirect()->route("galerie");
    }

    /**
     * editImage
     *
     * @param  mixed $id
     * @return void
     */
    public function editImage($id)
    {
        $image = DB::table("galerie")->find($id);
        if (empty($image)) {
            Session::flash("fail", "Ouoops une erreur est suvernue.");
            return redirect()->route('images');
        }
        return view("account.editimage", compact('image'));
    }
    /**
     * updateImage
     *
     * @param  mixed $request
     * @param  mixed $image
     * @return void
     */
    public function updateImage(Request $request, ImageGestionInterface $image)
    {
        $validator = Validator::make($request->all(), [
            'titre' => 'required|min:3',
            "newphoto" => 'image|mimes:jpeg,png,jpg',
        ], [
            'titre.required' => 'Titre est obligatoire.',
            'titre.min' => 'Titre doit être au moins 3 caractères.',
            'newphoto.mimes' => 'Image doit être de type: jpeg ou png ou jpg.'
        ]);
        if ($validator->fails()) {
            return redirect()->route("editimage")
                ->withErrors($validator);
        }
        if ($request->file("newphoto") !== null) {
            if ($image->update($request->file("newphoto"), $request->input("oldphoto"))) {
                $galerie = Galerie::find($request->input("image_id"));
                $galerie->titre = $request->input("titre");
                $galerie->image = $image->imagePath;

                if ($galerie->update()) {
                    Session::flash("success", "Image Modifiée.");
                } else {
                    Session::flash("fail", "Ouoops une erreur est suvernue.");
                }
            } else {
                Session::flash("fail", "Ouoops une erreur est suvernue.");
            }
        } else {
            $galerie = Galerie::find($request->input("image_id"));
            $galerie->titre = $request->input("titre");
            if ($galerie->update()) {
                Session::flash("success", "Image Modifiée.");
            } else {
                Session::flash("fail", "Ouoops une erreur est suvernue.");
            }
        }
        return redirect()->route('galerie');
    }
    /**
     * deleteImage
     *
     * @param  mixed $id
     * @return void
     */
    public function deleteImage($id)
    {
        $image = Galerie::find($id);
        unlink($image->image);
        if ($image->delete()) {
            Session::flash("success", "Image supprimée.");
        } else {
            Session::flash("fail", "Ouoops une erreur est suvernue.");
        }
        return redirect()->route('galerie');
    }
    /**
     * categories
     *
     * @return void
     */
    public function categories()
    {
        $categories = DB::select("SELECT * FROM categories");
        return view('account.categories', compact('categories'));
    }
    /**
     * addCategorie
     *
     * @return void
     */
    public function addCategorie()
    {
        return view('account.addcategorie');
    }
    /**
     * storeCategorie
     *
     * @param  mixed $request
     * @return void
     */
    public function storeCategorie(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'titre' => 'required|min:3|unique:categories,titre',
        ], [
            'titre.required' => 'Categorie est obligatoire.',
            'titre.min' => 'Categorie doit être au moins 3 caractères.',
        ]);
        if ($validator->fails()) {
            return redirect()->route("addcategorie")
                ->withErrors($validator);
        }
        $cat = new Categorie();
        $cat->titre = $request->input("titre");
        if ($cat->save()) {
            Session::flash("success", "Categorie ajoutée.");
        } else {
            Session::flash("fail", "Ouoops une erreur est suvernue.");
        }
        return redirect()->route('categories');
    }

    /**
     * editCategorie
     *
     * @param  mixed $id
     * @return void
     */
    public function editCategorie($id)
    {
        $cat = DB::table("categories")->find($id);
        if (empty($cat)) {
            Session::flash("fail", "Ouoops une erreur est suvernue.");
            return redirect()->route('categories');
        }
        return view("account.editcategorie", compact('cat'));
    }
    /**
     * updateCategorie
     *
     * @param  mixed $request
     * @return void
     */
    public function updateCategorie(Request $request)
    {
        $idCat = $request->input('idCat');
        $oldData = DB::table('categories')->find($idCat);
        $validator = Validator::make($request->all(), [
            'titre' => ['required', 'min:3', Rule::unique('categories')->ignore($idCat)],
        ], [
            'titre.required' => 'Categorie est obligatoire.',
            'titre.min' => 'Categorie doit être au moins 3 caractères.',
        ]);
        if ($validator->fails()) {
            return redirect()->route("editcategorie", [$idCat])
                ->withErrors($validator);
        }
        $cat =  DB::table('categories')->where('id', $idCat)->update([
            "titre" => $request->input('titre'),
        ]);
        if ($cat > 0) {
            Session::flash("success", "Categorie Modifiée.");
        } else {
            if ($oldData->titre == $request->input('titre')) {
                Session::flash("warning", "Vous n'avez rien changé.");
            } else {
                Session::flash("fail", "Ouoops une erreur est suvernue.");
            }
        }
        return redirect()->route('categories');
    }
    /**
     * deleteCategorie
     *
     * @param  mixed $id
     * @return void
     */
    public function deleteCategorie($id)
    {
        $cat = DB::table('categories')->where('id', $id)->delete();
        if ($cat > 0) {
            Session::flash("success", "Categorie supprimée.");
        } else {
            Session::flash("fail", "Ouoops une erreur est suvernue.");
        }
        return redirect()->route('categories');
    }

    /**
     * Utilisateurs
     *
     * @return void
     */
    public function Utilisateurs()
    {
        $users = DB::select("SELECT * FROM users");
        return view('account.utilisateurs', compact('users'));
    }
    /**
     * addUtilisateur
     *
     * @return void
     */
    public function addUtilisateur()
    {
        return view("account.addutilisateur");
    }
    /**
     * storeUtilisateur
     *
     * @param  mixed $request
     * @return void
     */
    public function storeUtilisateur(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|min:3',
            'email' => 'required|email:rfc,dns',
            'password' => 'required|min:6|confirmed',
            'password_confirmation' => 'required|min:6'
        ], [
            'email.required' => 'Email est obligatoire.',
            'name.required' => 'Pseudo est obligatoire.',
            'name.min' => 'Pseudo doit être au moins 3 caractères.',
            'email.email' => 'Email doit être valide.',
            'password.min' => 'Mot de Passe doit être au moins 6 caractères.',
            'password.required' => 'Mot de Passe est obligatoire.',
            'password.confirmed' => 'Mot de Passe et la confirmation doivent êtres identiques.'
        ]);
        if ($validator->fails()) {
            return redirect()->route("addutilisateur")
                ->withErrors($validator);
        }
        $user = new User();
        $user->name = $request->input('name');
        $user->email = $request->input('email');
        $user->type = $request->input('type');;
        $user->password = Hash::make($request->input('password'));
        if ($user->save()) {
            Session::flash("success", "Utilisateur ajouté.");
        } else {
            Session::flash("fail", "Ouoops une erreur est suvernue.");
        }
        return redirect()->route('utilisateurs');
    }
    /**
     * editUtilisateur
     *
     * @param  mixed $id
     * @return void
     */
    public function editUtilisateur($id)
    {
        $user = DB::table("users")->find($id);
        if (empty($user)) {
            Session::flash("fail", "Ouoops une erreur est suvernue.");
            return redirect()->route('utilisateurs');
        }
        return view("account.editutilisateur", compact('user'));
    }
    /**
     * updateUtilisateur
     *
     * @param  mixed $request
     * @return void
     */
    public function updateUtilisateur(Request $request)
    {
        $idUser = $request->input('idUser');
        $validator = Validator::make($request->all(), [
            'email' => ['required', 'email:rfc,dns', Rule::unique('users')->ignore($idUser)],
            'password' => 'min:6|confirmed',
            'name' => 'min:3',
            'password' => 'min:6'
        ], [
            'email.required' => 'Email est obligatoire.',
            'email.email' => 'Email doit être valide.',
            'name.min' => 'Pseudo doit être au moins 3 caractères.',
            'password.min' => 'Mot de Passe doit être au moins 6 caractères.',
        ]);
        if ($validator->fails()) {
            return redirect()->route("editutilisateur", [$idUser])
                ->withErrors($validator);
        }
        $user =  DB::table('users')->where('id', $idUser)->update([
            "name" => $request->input('name'),
            "email" => $request->input('email'),
            "type"  => $request->input('type'),
            "password"  => Hash::make($request->input('password')),
        ]);
        if ($user > 0) {
            Session::flash("success", "Utilisateur Modifié.");
        }
        return redirect()->route('utilisateurs');
    }
    /**
     * deleteUtilisateur
     *
     * @param  mixed $id
     * @return void
     */
    public function deleteUtilisateur($id)
    {
        $utilisateur = DB::table('users')->where('id', $id)->delete();
        if ($utilisateur > 0) {
            Session::flash("success", "Utilisateur supprimé.");
        } else {
            Session::flash("fail", "Ouoops une erreur est suvernue.");
        }
        return redirect()->route('utilisateurs');
    }
    /**
     * jours
     *
     * @return void
     */
    public function jours()
    {
        $jours = DB::select("SELECT * FROM jours");
        return view("account.jours", compact('jours'));
    }

    /**
     * addJour
     *
     * @return void
     */
    public function addJour()
    {
        return view("account.addjour");
    }
    /**
     * storeJour
     *
     * @param  mixed $request
     * @return void
     */
    public function storeJour(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'titre' => 'required|min:3|unique:menus,titre',
        ], [
            'titre.required' => 'Titre est obligatoire.',
            'titre.min' => 'Titre doit être au moins 3 caractères.',
        ]);
        if ($validator->fails()) {
            return redirect()->route("addjour")
                ->withErrors($validator);
        }
        $jour = new Jour();
        $jour->titre = ucfirst($request->input("titre"));
        if ($jour->save()) {
            Session::flash("success", "Jour ajouté.");
        } else {
            Session::flash("fail", "Ouoops une erreur est suvernue.");
        }
        return redirect()->route('jours');
    }
    /**
     * editJour
     *
     * @param  mixed $id
     * @return void
     */
    public function editJour($id)
    {
        $jour = DB::table("jours")->find($id);
        if (empty($jour)) {
            Session::flash("fail", "Ouoops une erreur est suvernue.");
            return redirect()->route('jour');
        }
        return view("account.editjour", compact('jour'));
    }
    /**
     * updateJour
     *
     * @param  mixed $request
     * @return void
     */
    public function updateJour(Request $request)
    {
        $idJour = $request->input('idJour');
        $oldData = DB::table('jours')->find($idJour);
        $validator = Validator::make($request->all(), [
            'titre' => ['required', 'min:3', Rule::unique('jours')->ignore($idJour)],
        ], [
            'titre.required' => 'Titre est obligatoire.',
            'titre.min' => 'Titre doit être au moins 3 caractères.',
        ]);
        if ($validator->fails()) {
            return redirect()->route("editjour", [$idJour])
                ->withErrors($validator);
        }
        $jour =  DB::table('jours')->where('id', $idJour)->update([
            "titre" => ucfirst($request->input('titre')),
        ]);
        if ($jour > 0) {
            Session::flash("success", "Jour Modifié.");
        } else {
            if ($oldData->titre == $request->input('titre')) {
                Session::flash("warning", "Vous n'avez rien changé.");
            } else {
                Session::flash("fail", "Ouoops une erreur est suvernue.");
            }
        }
        return redirect()->route('jours');
    }
    /**
     * deleteJour
     *
     * @param  mixed $id
     * @return void
     */
    public function deleteJour($id)
    {
        $jour = DB::table('jours')->where('id', $id)->delete();
        if ($jour > 0) {
            Session::flash("success", "Jour supprimé.");
        } else {
            Session::flash("fail", "Ouoops une erreur est suvernue.");
        }
        return redirect()->route('jours');
    }
    /**
     * menus
     *
     * @return void
     */
    public function menus()
    {
        $menus = DB::select("SELECT * FROM menus");
        return view('account.menus', compact('menus'));
    }
    /**
     * voireMenus
     *
     * @return void
     */
    public function voireMenus()
    {
        $menus = DB::select("SELECT * FROM menus");
        return view('account.voiremenu', compact('menus'));
    }
    /**
     * addMenu
     *
     * @return void
     */
    public function addMenu()
    {
        return view("account.addmenu");
    }
    /**
     * storeMenu
     *
     * @param  mixed $request
     * @return void
     */
    public function storeMenu(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'titre' => 'required|min:3|unique:menus,titre',
        ], [
            'titre.required' => 'Titre est obligatoire.',
            'titre.min' => 'Titre doit être au moins 3 caractères.',
        ]);
        if ($validator->fails()) {
            return redirect()->route("addmenu")
                ->withErrors($validator);
        }
        $menu = new Menu();
        $menu->titre = $request->input("titre");
        if ($menu->save()) {
            Session::flash("success", "Menu ajouté.");
        } else {
            Session::flash("fail", "Ouoops une erreur est suvernue.");
        }
        return redirect()->route('menus');
    }
    /**
     * editMenu
     *
     * @param  mixed $id
     * @return void
     */
    public function editMenu($id)
    {
        $menu = DB::table("menus")->find($id);
        if (empty($menu)) {
            Session::flash("fail", "Ouoops une erreur est suvernue.");
            return redirect()->route('menus');
        }
        return view("account.editmenu", compact('menu'));
    }
    /**
     * updateMenu
     *
     * @param  mixed $request
     * @return void
     */
    public function updateMenu(Request $request)
    {
        $idMenu = $request->input('idMenu');
        $oldData = DB::table('menus')->find($idMenu);
        $validator = Validator::make($request->all(), [
            'titre' => ['required', 'min:3', Rule::unique('menus')->ignore($idMenu)],
        ], [
            'titre.required' => 'Titre est obligatoire.',
            'titre.min' => 'Titre doit être au moins 3 caractères.',
        ]);
        if ($validator->fails()) {
            return redirect()->route("editmenu", [$idMenu])
                ->withErrors($validator);
        }
        $menu =  DB::table('menus')->where('id', $idMenu)->update([
            "titre" => $request->input('titre'),
        ]);
        if ($menu > 0) {
            Session::flash("success", "Menu Modifié.");
        } else {
            if ($oldData->titre == $request->input('titre')) {
                Session::flash("warning", "Vous n'avez rien changé.");
            } else {
                Session::flash("fail", "Ouoops une erreur est suvernue.");
            }
        }
        return redirect()->route('menus');
    }
    /**
     * deleteMenu
     *
     * @param  mixed $id
     * @return void
     */
    public function deleteMenu($id)
    {
        $menu = DB::table('menus')->where('id', $id)->delete();
        if ($menu > 0) {
            Session::flash("success", "Menu supprimé.");
        } else {
            Session::flash("fail", "Ouoops une erreur est suvernue.");
        }
        return redirect()->route('menus');
    }
    /**
     * carte
     *
     * @return void
     */
    public function carte()
    {
        $plats = DB::select("SELECT * FROM plats ");
        return view("account.carte", compact('plats'));
    }
    /**
     * addPlat
     *
     * @return void
     */
    public function addPlat()
    {
        $categories = DB::select("SELECT * FROM categories");
        return  view("account.addplat", compact('categories'));
    }
    /**
     * storePlat
     *
     * @param  mixed $request
     * @return void
     */
    public function storePlat(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'titre' => 'required|min:3',
            'description' => 'required|string|min:12',
            'categorie_id' => 'required',
            'prix' => 'required|numeric',
        ], [
            'titre.required' => 'Titre est obligatoire.',
            'titre.min' => 'Titre doit être au moins 3 caractères.',
            'prix.required' => 'Prix est obligatoire.',
            'categorie_id.required' => 'Categorie est obligatoire.',
            'description.required' => 'Description  est obligatoire.',
            'description.min' => 'Description doit être au moins 12 caractères.',
        ]);
        if ($validator->fails()) {
            return redirect()->route("addplat")
                ->withErrors($validator);
        }
        try {
            $plat = new Plat();
            $plat->titre = $request->input("titre");
            $plat->description = $request->input("description");
            $plat->prix = $request->input("prix");
            $plat->categorie_id = $request->input("categorie_id");

            if ($plat->save()) {
                $this->incrementColumn($request->input("categorie_id"), 'categories', 'nombre_plats');
                Session::flash("success", "Plat ajouté.");
            } else {
                Session::flash("fail", "Ouoops une erreur est suvernue.");
            }
        } catch (\Throwable $th) {
            if ($th->getCode() == 23000) {
                Session::flash("fail", "Vous devez ajouter la photo du plat dans la galérie d'abord.");
            } else {
                Session::flash("fail", "Ouoops une erreur est suvernue.");
            }
        }

        return redirect()->route('carte');
    }

    /**
     * editPlat
     *
     * @param  mixed $id
     * @return void
     */
    public function editPlat($id)
    {
        $plat = DB::table("plats")->find($id);
        $categories = DB::select("SELECT * FROM categories");
        if (empty($plat)) {
            Session::flash("fail", "Ouoops une erreur est suvernue.");
            return redirect()->route('carte');
        }
        return view("account.editplat", compact('plat', 'categories'));
    }
    /**
     * updatePlat
     *
     * @param  mixed $request
     * @return void
     */
    public function updatePlat(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'titre' => 'required|min:3',
            'description' => 'required|string|min:12',
            'categorie_id' => 'required',
            'prix' => 'required|numeric',
        ], [
            'titre.required' => 'Titre est obligatoire.',
            'titre.min' => 'Titre doit être au moins 3 caractères.',
            'prix.required' => 'Prix est obligatoire.',
            'categorie_id.required' => 'Categorie est obligatoire.',
            'description.required' => 'Description  est obligatoire.',
            'description.min' => 'Description doit être au moins 12 caractères.',
        ]);
        if ($validator->fails()) {
            return redirect()->route("editplat")
                ->withErrors($validator);
        }
        $plat = Plat::find($request->input("plat_id"));
        $plat->titre = $request->input("titre");
        $plat->description = $request->input("description");
        $plat->prix = $request->input("prix");
        $plat->categorie_id = $request->input("categorie_id");
        $oldcategorie_id = $request->input("oldcategorie_id");
        try {
            if ($plat->update()) {
                if ($oldcategorie_id !== $request->input("categorie_id")) {
                    $this->incrementColumn($request->input("categorie_id"), 'categories', 'nombre_plats');
                    $Categorie = new Categorie();
                    $this->decrementColumn($Categorie, $oldcategorie_id, 'numbre_plats');
                }
                Session::flash("success", "Plat modifié");
            } else {
                Session::flash("fail", "Ouoops une erreur est suvernue.");
            }
        } catch (\Throwable $th) {
            if ($th->getCode() == 23000) {
                Session::flash("fail", "Vous devez utiliser le même titre que sur la photo du plat.");
            } else {
                Session::flash("fail", "Ouoops une erreur est suvernue.");
            }
        }
        return redirect()->route('carte');
    }
    /**
     * deletePlat
     *
     * @param  mixed $id
     * @return void
     */
    public function deletePlat($id)
    {
        $Categorie = new Categorie();
        $platId = Plat::find($id);
        $this->decrementColumn($Categorie, $platId->categorie_id, 'nombre_plats');
        $plat = DB::table('plats')->where('id', $id)->delete();
        if ($plat > 0) {
            Session::flash("success", "Plat supprimé.");
        } else {
            Session::flash("fail", "Ouoops une erreur est suvernue.");
        }
        return redirect()->route('carte');
    }

    /**
     * voireCarte
     *
     * @return void
     */
    public function voireCarte()
    {
        $categories = DB::select("SELECT * FROM categories");
        return view("account.voirecarte", compact('categories'));
    }

    /**
     * formules
     *
     * @return void
     */
    public function formules()
    {
        $formules = DB::select("SELECT * FROM formules");
        return view("account.formules", compact('formules'));
    }
    /**
     * addFormule
     *
     * @return void
     */
    public function addFormule()
    {
        $menus = DB::select("SELECT * FROM menus");
        $plats = DB::select("SELECT * FROM plats");
        return  view("account.addformule", compact('menus', 'plats'));
    }
    /**
     * storeFormule
     *
     * @param  mixed $request
     * @return void
     */
    public function storeFormule(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'titre' => 'required|min:3',
            'description' => 'required|string|min:12',
            'plats' => 'required',
            'prix' => 'required|numeric',
            'menu_id' => 'required',
        ], [
            'titre.required' => 'Titre est obligatoire.',
            'titre.min' => 'Titre doit être au moins 3 caractères.',
            'prix.required' => 'Prix est obligatoire.',
            'plats.required' => 'Selectionnez au moins un Plat.',
            'menu_id.required' => 'Selectionnez un Menu.',
            'description.required' => 'Description  est obligatoire.',
            'description.min' => 'Description doit être au moins 12 caractères.',
        ]);
        if ($validator->fails()) {
            return redirect()->route("addformule")
                ->withErrors($validator);
        }
        $plats = implode("%", $request->input("plats"));
        $formule = new Formule();
        $formule->titre = $request->input("titre");
        $formule->description = $request->input("description");
        $formule->prix = $request->input("prix");
        $formule->plats = $plats;
        $formule->menu_id = $request->input("menu_id");
        if ($formule->save()) {
            $this->incrementColumn($request->input("menu_id"), 'menus', 'nombre_formules');
            Session::flash("success", "Formule ajoutée.");
        } else {
            Session::flash("fail", "Ouoops une erreur est suvernue.");
        }
        return redirect()->route('formules');
    }
    /**
     * editFormule
     *
     * @param  mixed $id
     * @return void
     */
    public function editFormule($id)
    {
        $formule = DB::table("formules")->find($id);
        $menus = DB::select("SELECT * FROM menus");
        $plats = DB::select("SELECT * FROM plats");
        if (empty($formule) || empty($menus) || empty($plats)) {
            Session::flash("fail", "Ouoops une erreur est suvernue.");
            return redirect()->route('formules');
        }
        return view("account.editformule", compact('formule', 'menus', 'plats'));
    }
    /**
     * updateFormule
     *
     * @param  mixed $request
     * @return void
     */
    public function updateFormule(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'titre' => 'required|min:3',
            'description' => 'required|string|min:12',
            'menu_id' => 'required',
            'prix' => 'required|numeric',
            'plats' => 'required',
        ], [
            'titre.required' => 'Titre est obligatoire.',
            'titre.min' => 'Titre doit être au moins 3 caractères.',
            'prix.required' => 'Prix est obligatoire.',
            'menu_id.required' => 'Selectionnez un Menu.',
            'plats.required' => 'Selectionnez au moins un Plat.',
            'description.required' => 'Description  est obligatoire.',
            'description.min' => 'Description doit être au moins 12 caractères.',
        ]);
        if ($validator->fails()) {
            return redirect()->route("editformule")
                ->withErrors($validator);
        }
        $plats = implode("%", $request->input("plats"));
        $formule = Formule::find($request->input("formule_id"));
        $formule->titre = $request->input("titre");
        $formule->description = $request->input("description");
        $formule->prix = $request->input("prix");
        $formule->menu_id = $request->input("menu_id");
        $formule->plats = $plats;

        $oldmenu_id = $request->input("oldmenu_id");
        try {
            if ($formule->update()) {
                if ($oldmenu_id !== $request->input("menu_id")) {
                    $this->incrementColumn($request->input("menu_id"), 'menus', 'nombre_formules');
                    $menu = new Menu();
                    $this->decrementColumn($menu, $oldmenu_id, 'numbre_formules');
                }
                Session::flash("success", "Formule modifiée");
            } else {
                Session::flash("fail", "Ouoops une erreur est suvernue.");
            }
        } catch (\Throwable $th) {
            Session::flash("fail", "Ouoops une erreur est suvernue.");
        }
        return redirect()->route('formules');
    }
    /**
     * deleteFormule
     *
     * @param  mixed $id
     * @return void
     */
    public function deleteFormule($id)
    {
        $menu = new Menu();
        $formuleId = Formule::find($id);
        $this->decrementColumn($menu, $formuleId->menu_id, 'nombre_formules');
        $formule = DB::table('formules')->where('id', $id)->delete();
        if ($formule > 0) {
            Session::flash("success", "Formule supprimée.");
        } else {
            Session::flash("fail", "Ouoops une erreur est suvernue.");
        }
        return redirect()->route('formules');
    }

    /**
     * horaires
     *
     * @return void
     */
    public function horaires()
    {
        $horaires = DB::select("SELECT * FROM horaires");
        return view("account.horaires", compact('horaires'));
    }

    /**
     * addHoraire
     *
     * @return void
     */
    public function addHoraire()
    {
        $jours = DB::select("SELECT * FROM jours");
        return view("account.addhoraire", compact('jours'));
    }
    /**
     * storeHoraire
     *
     * @param  mixed $request
     * @return void
     */
    public function storeHoraire(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'mo' => 'required',
            'mf' => 'required',
            'so' => 'required',
            'sf' => 'required',
            'jour_id' => 'required',
        ], [
            'mo.required' => 'Chaque horaire est obligatoire.',
            'mf.required' => 'Chaque horaire est obligatoire.',
            'so.required' => 'Chaque horaire est obligatoire.',
            'sf.required' => 'Chaque horaire est obligatoire.',
            'jour_id.required' => 'Selectionnez un Jour.',
        ]);
        if ($validator->fails()) {
            return redirect()->route("addhoraire")
                ->withErrors($validator);
        }
        $horaire = new Horaire();
        $horaire->jour_id = $request->input("jour_id");
        $horaire->ouverture_midi = $request->input("mo");
        $horaire->fermeture_midi = $request->input("mf");
        $horaire->ouverture_soir = $request->input("so");
        $horaire->fermeture_soir = $request->input("sf");
        if ($horaire->save()) {
            Session::flash("success", "Horaire ajouté.");
        } else {
            Session::flash("fail", "Ouoops une erreur est suvernue.");
        }
        return redirect()->route('horaires');
    }
    /**
     * editHoraire
     *
     * @param  mixed $id
     * @return void
     */
    public function editHoraire($id)
    {
        $horaire = DB::table("horaires")->find($id);
        $jours = DB::select("SELECT * FROM jours");
        if (empty($horaire) || empty($jours)) {
            Session::flash("fail", "Ouoops une erreur est suvernue.");
            return redirect()->route('horaires');
        }
        return view("account.edithoraire", compact('horaire', 'jours'));
    }
    /**
     * updateHoraire
     *
     * @param  mixed $request
     * @return void
     */
    public function updateHoraire(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'mo' => 'required',
            'mf' => 'required',
            'so' => 'required',
            'sf' => 'required',
            'jour_id' => 'required',
        ], [
            'mo.required' => 'Chaque horaire est obligatoire.',
            'mf.required' => 'Chaque horaire est obligatoire.',
            'so.required' => 'Chaque horaire est obligatoire.',
            'sf.required' => 'Chaque horaire est obligatoire.',
            'jour_id.required' => 'Selectionnez un Jour.',
        ]);
        if ($validator->fails()) {
            return redirect()->route("addhoraire")
                ->withErrors($validator);
        }
        $horaire =  Horaire::find($request->input("horaire_id"));
        $horaire->jour_id = $request->input("jour_id");
        $horaire->ouverture_midi = $request->input("mo");
        $horaire->fermeture_midi = $request->input("mf");
        $horaire->ouverture_soir = $request->input("so");
        $horaire->fermeture_soir = $request->input("sf");
        if ($horaire->save()) {
            Session::flash("success", "Horaire Modifié.");
        } else {
            Session::flash("fail", "Ouoops une erreur est suvernue.");
        }
        return redirect()->route('horaires');
    }
    /**
     * deleteHoraire
     *
     * @param  mixed $id
     * @return void
     */
    public function deleteHoraire($id)
    {
        $horaire = DB::table('horaires')->where('id', $id)->delete();
        if ($horaire > 0) {
            Session::flash("success", "Horaire supprimé.");
        } else {
            Session::flash("fail", "Ouoops une erreur est suvernue.");
        }
        return redirect()->route('horaires');
    }

    /**
     * reservations
     *
     * @return void
     */
    public function reservations()
    {
        $reservations = DB::select('SELECT * FROM reservations');
        return view("account.reservations", compact('reservations'));
    }
    /**
     * voireReservation
     *
     * @param  mixed $id
     * @return void
     */
    public function voireReservation($id)
    {
        $reservation = DB::table("reservations")->find($id);
        if (empty($reservation)) {
            Session::flash("fail", "Ouoops une erreur est suvernue.");
            return redirect()->route('reservations');
        }
        return view("account.voirereservation", compact('reservation'));
    }
    /**
     * deleteReservation
     *
     * @param  mixed $id
     * @return void
     */
    public function deleteReservation($id)
    {
        $reservation = DB::table('reservations')->where('id', $id)->delete();
        if ($reservation > 0) {
            Session::flash("success", "Réservation supprimée.");
        } else {
            Session::flash("fail", "Ouoops une erreur est suvernue.");
        }
        return redirect()->route('reservations');
    }
    /**
     * incrementColumn
     *
     * @param  mixed $id
     * @param  mixed $table
     * @param  mixed $column
     * @return void
     */
    private function incrementColumn(int $id, string $table, string $column)
    {
        DB::table($table)->where('id', $id)->increment($column);
    }
    /**
     * decrementColumn
     *
     * @param  mixed $model
     * @param  mixed $id
     * @param  mixed $column
     * @return void
     */
    private function decrementColumn(Model $model, int $id, string $column)
    {
        $table = $model::find($id);
        $table->$column = $table->$column > 0 ? $table->$column - 1 : 0;
        $table->save();
    }

    /**
     * frmt
     *
     * @param  mixed $var
     * @return void
     */
    public function frmt($var)
    {
        echo "<pre>";
        print_r($var);
        echo "</pre>";
    }
}
