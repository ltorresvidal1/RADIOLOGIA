<?php


use Illuminate\Support\Facades\Route;
use App\Http\Controllers\auth\LoginController;
use App\Http\Controllers\auth\LogoutController;
use App\Http\Controllers\imagen\ImagenController;
use App\Http\Controllers\clientes\ClientesController;
use App\Http\Controllers\estudios\estudiosController;
use App\Http\Controllers\usuarios\UsuariosController;
use App\Http\Controllers\principal\PrincipalController;
use App\Http\Controllers\sa_usuarios\Sa_usuariosController;
use App\Http\Controllers\datatable\DatatableController;
use App\Http\Controllers\lecturas\lecturasController;
use App\Http\Controllers\medicos\MedicosController;
use App\Http\Controllers\zip\DescargarCdController;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|DB_CONNECTION=pgsql
DB_HOST=152.200.139.140
DB_PORT=5432
DB_DATABASE=pacsdb
DB_USERNAME=pacs
DB_PASSWORD=pacs
*/

Route::get('/', [LoginController::class, 'index'])->name('login.');
Route::get('/login', [LoginController::class, 'index'])->name('login');
Route::post('/login', [LoginController::class, 'store'])->name('login.store');

Route::Post('/logout', [LogoutController::class, 'store'])->name('logout');
Route::Post('/imagenes', [ImagenController::class, 'store'])->name('imagenes.store');
Route::Post('/firma', [ImagenController::class, 'firmaradiologo'])->name('firmaradiologo.store');
Route::get('/principal', [PrincipalController::class, 'index'])->name('principal');

Route::get('/sa_usuarios', [Sa_usuariosController::class, 'index'])->name('sa_usuarios.index');
Route::get('/sa_usuarios/create', [Sa_usuariosController::class, 'create'])->name('sa_usuarios.create');
Route::post('/sa_usuarios', [Sa_usuariosController::class, 'store'])->name('sa_usuarios.store');
Route::get('sa_usuarios/{usuario}/edit', [Sa_usuariosController::class, 'edit'])->name('sa_usuarios.edit');
Route::put('sa_usuarios/{usuario}', [Sa_usuariosController::class, 'update'])->name('sa_usuarios.update');

Route::put('restablecersausuario/{usuario}', [Sa_usuariosController::class, 'restablecer'])->name('sa_usuarios.restablecer');
Route::delete('sa_usuarios/{usuario}', [Sa_usuariosController::class, 'destroy'])->name('sa_usuarios.destroy');


Route::get('/usuarios', [UsuariosController::class, 'index'])->name('usuarios.index');
Route::get('/usuarios/create', [UsuariosController::class, 'create'])->name('usuarios.create');
Route::post('/usuarios', [UsuariosController::class, 'store'])->name('usuarios.store');
Route::get('usuarios/{usuario}/edit', [UsuariosController::class, 'edit'])->name('usuarios.edit');
Route::put('usuarios/{usuario}', [UsuariosController::class, 'update'])->name('usuarios.update');
Route::put('restablecerusuario/{usuario}', [UsuariosController::class, 'restablecer'])->name('usuarios.restablecer');
Route::delete('usuarios/{usuario}', [UsuariosController::class, 'destroy'])->name('usuarios.destroy');

/*Route::get('/usuarios/create', [UsuariosController::class, 'create'])->name('usuarios.create');
Route::post('/usuarios', [UsuariosController::class, 'store'])->name('usuarios.store');
*/

Route::get('/clientes', [ClientesController::class, 'index'])->name('clientes.index');
Route::get('/clientes/create', [ClientesController::class, 'create'])->name('clientes.create');
Route::post('/clientes', [ClientesController::class, 'store'])->name('clientes.store');
Route::get('clientes/{cliente}/edit', [ClientesController::class, 'edit'])->name('clientes.edit');
Route::put('clientes/{cliente}', [ClientesController::class, 'update'])->name('clientes.update');
Route::delete('clientes/{cliente}', [ClientesController::class, 'destroy'])->name('clientes.destroy');


Route::get('/medicos', [MedicosController::class, 'index'])->name('medicos.index');
Route::get('/medicos/create', [MedicosController::class, 'create'])->name('medicos.create');
Route::post('/medicos', [MedicosController::class, 'store'])->name('medicos.store');
Route::get('medicos/{medico}/edit', [MedicosController::class, 'edit'])->name('medicos.edit');
Route::put('medicos/{medico}', [MedicosController::class, 'update'])->name('medicos.update');

Route::put('restablecermedico/{medico}', [MedicosController::class, 'restablecer'])->name('medicos.restablecer');
Route::delete('medicos/{medico}', [MedicosController::class, 'destroy'])->name('medicos.destroy');
/*
Route::get('/clientes', [ClientesController::class, 'index'])->name('clientes.index');
Route::get('/clientes/create', [ClientesController::class, 'create'])->name('clientes.create');
Route::post('/clientes', [ClientesController::class, 'store'])->name('clientes.store');
Route::get('clientes/{cliente}/edit', [ClientesController::class, 'edit'])->name('clientes.edit');
Route::put('clientes/{cliente}', [ClientesController::class, 'update'])->name('clientes.update');
Route::delete('clientes/{cliente}', [ClientesController::class, 'destroy'])->name('clientes.destroy');

Route::get('/clientes', [ClientesController::class, 'index'])->name('clientes.index');
Route::get('/clientes/create', [ClientesController::class, 'create'])->name('clientes.create');
Route::post('/clientes', [ClientesController::class, 'store'])->name('clientes.store');
Route::get('clientes/{cliente}/edit', [ClientesController::class, 'edit'])->name('clientes.edit');
Route::put('clientes/{cliente}', [ClientesController::class, 'update'])->name('clientes.update');
Route::delete('clientes/{cliente}', [ClientesController::class, 'destroy'])->name('clientes.destroy');

*/








Route::get('/estudios', [estudiosController::class, 'index'])->name('estudios.index');
Route::get('/datatable/estudiosclientes/{institucion}/{fechainicial}/{fechafinal}', [DatatableController::class, 'estudiosclientes'])->name('datatable.estudiosclientes');
Route::get('/datatable/estudiosclientes/{institucion}/{idestudio}', [DatatableController::class, 'lecturasestudiosclientes'])->name('datatable.lecturasestudiosclientes');


Route::get('/estudio/{idestudio}', [lecturasController::class, 'index'])->name('lectura.index');
Route::get('/estudio/imprimir/{idestudio}', [lecturasController::class, 'index'])->name('imprimirlectura.index');

Route::post('/lectura', [lecturasController::class, 'store'])->name('lectura.store');
Route::get('/lectura', [lecturasController::class, 'update'])->name('lectura.update');
Route::delete('/lectura/{idlectura}', [lecturasController::class, 'destroy'])->name('lectura.destroy');
Route::get('/DescargarPdfAgrupado', [lecturasController::class, 'DescargarPdfAgrupado'])->name('DescargarPdfAgrupado');

//oute::get('/paiweb', [lecturasController::class, 'Apiweb'])->name('paiweb');
//Route::put('/lectura',[lecturasController::class,'update'])->name('lectura.update');

Route::get('/descargar_cd', [DescargarCdController::class, "downloadZip"]);

//Route::put('/lectura/{lectura}',[lecturasController::class,'update'])->name('lectura.update');

//Route::delete('/lectura/{lectura}',[lecturasController::class,'destroy'])->name('lectura.destroy');
//Route::post('/datatable/estudiosclientes',[DatatableController::class,'estudiosclientes'])->name('datatable.estudiosclientes');
