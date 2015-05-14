<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/*
| -------------------------------------------------------------------------
| URI ROUTING
| -------------------------------------------------------------------------
| This file lets you re-map URI requests to specific controller functions.
|
| Typically there is a one-to-one relationship between a URL string
| and its corresponding controller class/method. The segments in a
| URL normally follow this pattern:
|
|	example.com/class/method/id/
|
| In some instances, however, you may want to remap this relationship
| so that a different class/function is called than the one
| corresponding to the URL.
|
| Please see the user guide for complete details:
|
|	http://codeigniter.com/user_guide/general/routing.html
|
| -------------------------------------------------------------------------
| RESERVED ROUTES
| -------------------------------------------------------------------------
|
| There area two reserved routes:
|
|	$route['default_controller'] = 'welcome';
|
| This route indicates which controller class should be loaded if the
| URI contains no data. In the above example, the "welcome" class
| would be loaded.
|
|	$route['404_override'] = 'errors/page_missing';
|
| This route will tell the Router what URI segments to use if those provided
| in the URL cannot be matched to a valid route.
|
*/

$route['default_controller'] = "home";
$route['minhaestante'] = "usuario";
$route['minhaestante/(:any)'] = "usuario/$1";
$route['meus_recados'] = "usuario/recados";
$route['meus_livros'] = "estantevirtual/meusLivros";
$route['meus_livros/(:any)'] = "estantevirtual/meusLivros/$1";
$route['meusPedidos'] = "pedido/meusPedidos";
$route['meusPedidos/recebidos'] = "pedido/recebidos";
$route['meusPedidos/(:any)'] = "pedido/meusPedidos/$1";
$route['lista_desejo'] = "pedido/meusPedidos/pendentes";

$route['meus_livros/buscar'] = "livro";
$route['sair'] = "login/efetuarLogout";
$route['lista/autores'] = "livro/getAutores";
$route['lista/editoras'] = "livro/getEditoras";
$route['bibliotecaVirtual/(:num)']='estantevirtual/listarLivro/$1';
$route['chat/(:any)'] = "pedido/chat/$1";



$route['administrador/uploadImagem/(:num)/(:any)'] = "admin/uploadImagem/$1/$2";
$route['admin/listaAtendente'] = "atendente/lista";
$route['admin/listaAtendenteF'] = "atendenteF/lista";
$route['admin/listaMedico'] = "medico/lista";
$route['atendente/cadastroPaciente'] = "paciente/telaCadastro";
$route['atendente/buscarPaciente'] = "paciente/buscarPaciente";
$route['medico/cadastroReceita'] = "receita/telaCadastro";
$route['agenda/medico/(:num)'] = "medico/AgendaMedico/$1";
$route['medico/receita/(:num)'] = "receita/buscaReceita/$1";

$route['(:any)/buscarReceita/(:num)'] = "receita/telaBuscarReceita/$2";

$route['404_override'] = 'pagina404';


/* End of file routes.php */
/* Location: ./application/config/routes.php */