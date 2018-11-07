if(view()->exists('pages.index')){ $result = $request->session()->all(); $token = $result('_token'); $answer = view('pages.index', compact('title', 'header', 'token'))->render(); echo view('pages.index', compact('title', 'header'))->getPath(); return view('pages.index', compact('title', 'header')); } else{ abort(404); }

public function startApp(){ if($this->is_safe($this->config, "")){ $page = new Page($this->getPageName(), $this->config); $page->createParams(); $page->render(); } }

if(Session::get('workers_page->show_more_type') == "sort_mode"){ $field = Session::get('workers_page->sort_info->field'); $sort_type = Session::get('workers_page->sort_info->sort_type'); $offset = Session::get('workers_page->displayed_workers'); $sql = $this->SortSql($field, $sort_type, $offset); }

switch($search_field){ case 'first_name': case 'last_name': case 'father_name':	case 'post': $sql = "SELECT * FROM workers WHERE $search_field LIKE '%$search_text%' LIMIT $this->displayLimit OFFSET $offset"; $total_found = Helper::select($this->db, "SELECT COUNT(id) FROM workers WHERE $search_field LIKE '%$search_text%'", 2); break;

public function is_more($type){ if($type == "search" or Session::get('workers_page->show_more_type') == "search_mode"){ return (Session::get('workers_page->displayed_workers') < Session::get('workers_page->search_info->total'))? 1:0; } return (Session::get('workers_page->displayed_workers') < $this->getWorkersCount())? 1 : 0; }

foreach($_POST as $value){ if(!$this->checkSecurity($value)){ $page = new Page("bad_request", $config); $page->render($dir); return false; } }

for($i = 0; $i < strlen($value); $i++){ if(in_array($value($i), $denied_symbols)){ return false; } }

public function getTopRankWorkersHtml(){ include ".library.WorkerWidget.php"; foreach ($this->topRankWorkers as $key => $worker) { WorkerWidget::get(('type' => 'index', 'worker' => $worker)); } }

$query = "INSERT INTO workers VALUES"; for($i = 1; $i <= $count; $i++){ $cur_worker = $this->buildWorker($i); $cur_line = "('','$cur_worker->first_name','$cur_worker->last_name','$cur_worker->father_name','$cur_worker->post','$cur_worker->employment_start','$cur_worker->salary','$cur_worker->chief_id', '$cur_worker->avatar'),"; $query .= $cur_line; } $query = substr($query, 0, strlen($query)-1); mysqli_query($this->db, $query);

class Page extends BaseObject{ public $name; public $params; function __construct($name, $config){ }

if(crypt($password, $user('password')) == $user('password')){ $this->setUser($login); Session::set(('login-status' => "default")); } else{ Session::set(('login-status' => "fail")); }

public function logout(){ session_destroy(); } public function setUser($login){ Session::set(('user' => ('auth' => true, 'login' => $login))); }

define("LOAD_TYPE", "request-handler"); include "...autoload.php"; include "...library.WorkerWidget.php"; class RequestHandler extends BaseObject{ }

else{ exit("<meta http-equiv='refresh' content='0; url= .bad_request'>"); } } } if(isset($_GET('action'))) $request = new RequestHandler($_GET('action')); ?>

$filler->run( ( 'director' => ('count' => 8, 'salary' => 10000), 'teamleed' => ('count' => 300, 'salary' => 7000), 'Senior' => ('count' => 2500, 'salary' => 5000), 'Middle' => ('count' => 26000, 'salary' => 2000), 'Junior' => ('count' => 43000, 'salary' => 1000) ));