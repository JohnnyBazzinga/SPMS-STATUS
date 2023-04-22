<?php
require('variables.php');

//require('variables.php');
// Ler o ficheiro general.json
$json = file_get_contents(__DIR__ .'/FicheirosTexto/general.json');
$general = json_decode($json,true);

// Ler o ficheiro general_history.json
$json = file_get_contents(__DIR__ .'/FicheirosTexto/general_history.json');
$general_history = json_decode($json,true);

// Ler o ficheiro history.json
$json = file_get_contents(__DIR__ .'/FicheirosTexto/history.json');
$history = json_decode($json,true);

// Ler o ficheiro history1h.json
$json = file_get_contents(__DIR__ .'/FicheirosTexto/history1h.json');
$history1h = json_decode($json,true);

// Ler o ficheiro contextos.json
$json = file_get_contents(__DIR__ .'/FicheirosTexto/contextos.json');
$contextos = json_decode($json,true);
$contextoss = json_decode($json,true);
// Ler o ficheiro comentarios.json
$json = file_get_contents(__DIR__ .'/FicheirosTexto/comentarios.json');
$comentarios = json_decode($json,true);

foreach($contextos["items"] as $contextos) {
  if(isset($_GET['var-contexto'])){
  if($_GET['var-contexto'] == $contextos['contexto']){
      $contextoVar = $contextos['id_contexto'];
      $contextoNome = $contextos['contexto'];
      break;
  } else {
      $contextoVar = 0;
      $contextoNome = 'Todos';
  }
} else {
    $contextoVar = 0;
    $contextoNome = 'Todos';
}
}
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta http-equiv="x-ua-compatible" content="ie=edge" />
    <meta http-equiv="cache-control" content="max-age=0" />
    <meta http-equiv="cache-control" content="no-cache" />
    <meta http-equiv="expires" content="0" />
    <meta http-equiv="expires" content="Tue, 01 Jan 1980 1:00:00 GMT" />
    <meta http-equiv="pragma" content="no-cache" />
    <title>SISMONITOR | HealthStatus</title>
    <!-- MDB icon -->
    <link rel="icon" href="assets/images/icon.png" type="image/x-icon" />
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.2/css/all.css" />
    <!-- Google Fonts Roboto -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;700;900&display=swap" />
    <!-- MDB -->
    <link rel="stylesheet" href="assets/css/mdb.min.css" />


  </head>
  <body id="topo" class="bg-image" style="height: 100vh;overflow-y: scroll;margin: 0;padding:0;display:flex;flex-direction:column;justify-content:space-between;min-height:100vh;">
  <div id="loading">
      <img id="loading-image" src="assets/images/loader.gif" alt="Loading..."/>
    </div>
    
    <!-- Start your project here-->
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-light bg-light mb-5">
      <!-- Container wrapper -->
      <div class="container">
        <!-- Navbar brand -->
        <a class="navbar-brand me-2">
          <img src="assets/images/SISMONITORlogo.png" height="60" alt="MDB Logo" loading="lazy" style="margin-top: -1px;" />
        </a>
        <!-- Toggle button -->
        <!-- Collapsible wrapper -->
        <div class="collapse navbar-collapse" id="navbarButtonsExample">
          <!-- Left links -->
          <ul class="navbar-nav me-auto mb-2 mb-lg-0"></ul>
          <!-- Left links -->
          <div class="d-flex align-items-center">
            <span class="navbar-text">
            Último update às <a class='inline-block text-decoration-none text-dark pe-none'><?php $page_load_time = time(); echo date("H:i:s",$page_load_time);?></a> | Próximo update em <a class='inline-block text-decoration-none text-dark pe-none' id='countdown'></a> segundos.
            </span>
            <button style="background: none; color: inherit; border: none;padding: 0;font: inherit;cursor: pointer;outline: inherit;" type="button" class="" data-mdb-toggle="modal" data-mdb-target="#exampleModal">
                  <img class="img-fluid" style="width:20px;" src="assets/images/help.png" alt="...">
                </button>
              </div>
                <!-- Modal -->
                <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                  <div class="modal-dialog modal-xl">
                    <div class="modal-content">
                      <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Ajuda</h5>
                        <button type="button" class="btn-close" data-mdb-dismiss="modal" aria-label="Close"></button>
                      </div>
                      <div class="modal-body">
                        <h6 class="modal-title">
                          <u>No gráfico geral apresentado por solução está agregada a informação de todos os indicadores selecionados para representar a sua disponibilidade.</u>
                        </h6>
                        <h5 class="modal-title bold">Gráfico Geral Solução</h5>
                        <div class="row">
                          <div class="col-12 d-flex">
                            <div class="con-tooltip green" data-bs-toggle="tooltip" data-bs-html="true" data-bs-placement="bottom" title=""></div>
                            <h6 class="modal-title">&nbsp;&nbsp;- solução 100% operacional nesse intervalo;</h6>
                          </div>
                          <div class="col-12 d-flex">
                            <div class="con-tooltip yellow" data-bs-toggle="tooltip" data-bs-html="true" data-bs-placement="bottom" title=""></div>
                            <h6 class="modal-title">&nbsp;&nbsp;- detetada indisponibilidade total ou parcial de um indicador da solução nesse intervalo;</h6>
                          </div>
                          <div class="col-12 d-flex">
                            <div class="con-tooltip red" data-bs-toggle="tooltip" data-bs-html="true" data-bs-placement="bottom" title=""></div>
                            <h6 class="modal-title">&nbsp;&nbsp;- indisponibilidade em todos os indicadores da solução nesse intervalo;</h6>
                          </div>
                          <div class="col-12 d-flex">
                            <div class="con-tooltip grey" data-bs-toggle="tooltip" data-bs-html="true" data-bs-placement="bottom" title=""></div>
                            <h6 class="modal-title">&nbsp;&nbsp;- todos os indicadores associados à solução estão sem monitorização nesse intervalo;</h6>
                          </div>
                          <div class="col-12 d-flex">
                            <div class="con-tooltip greenie" data-bs-toggle="tooltip" data-bs-html="true" data-bs-placement="bottom" title=""></div>
                            <h6 class="modal-title">&nbsp;&nbsp;- pelo menos um indicador está sem monitorização, no entanto os restantes estão 100% operacionais nesse intervalo;</h6>
                          </div>
                        </div>
                        <h6 class="modal-title mt-3">
                          <u>É possível expandir a célula de cada solução para serem consultados os gráficos individuais por indicador, referentes ao histórico de 24h assim como da última hora com intervalos de 5 minutos.</u>
                        </h6>
                        <h5 class="modal-title bold">Gráfico do histórico 24h/1h por indicador</h5>
                        <div class="row">
                          <div class="col-12 d-flex">
                            <div class="con-tooltip green" data-bs-toggle="tooltip" data-bs-html="true" data-bs-placement="bottom" title=""></div>
                            <h6 class="modal-title">&nbsp;&nbsp;- indicador 100% operacional nesse intervalo;</h6>
                          </div>
                          <div class="col-12 d-flex">
                            <div class="con-tooltip yellow" data-bs-toggle="tooltip" data-bs-html="true" data-bs-placement="bottom" title=""></div>
                            <h6 class="modal-title">&nbsp;&nbsp;- alguma indisponibilidade detetada no indicador nesse intervalo;</h6>
                          </div>
                          <div class="col-12 d-flex">
                            <div class="con-tooltip red" data-bs-toggle="tooltip" data-bs-html="true" data-bs-placement="bottom" title=""></div>
                            <h6 class="modal-title">&nbsp;&nbsp;- indisponibilidade do indicador nesse intervalo;</h6>
                          </div>
                          <div class="col-12 d-flex">
                            <div class="con-tooltip grey" data-bs-toggle="tooltip" data-bs-html="true" data-bs-placement="bottom" title=""></div>
                            <h6 class="modal-title">&nbsp;&nbsp;- indicador sem monitorização nesse intervalo;</h6>
                          </div>
                        </div>
                        <h5 class="modal-title bold">Símbolos</h5>
                        <div class="row">
                          <div class="col-12 d-flex">
                            <img class="img-fluid" src="assets/images/TableCheck.png" alt="..." style="width:25px;">
                            <h6 class="modal-title">&nbsp;&nbsp;- solução 100% operacional neste momento;</h6>
                          </div>
                          <div class="col-12 d-flex mt-2">
                            <img class="img-fluid" src="assets/images/TableIncident.png" alt="..." style="width:25px;">
                            <h6 class="modal-title">&nbsp;&nbsp;- está a ser detetado um problema total ou parcial da solução;</h6>
                          </div>
                          <div class="col-12 d-flex mt-2">
                            <img class="w-10" src="assets/images/comentario.png" alt="..." style="width:25px;">
                            <h6 class="modal-title">&nbsp;&nbsp;- a solução tem uma notificação associada, desça ao fim da página para consultá-la;</h6>
                          </div>
                        </div>
                        <div class="modal-footer">
                          <button type="button" class="btn btn-primary" data-mdb-dismiss="modal">Fechar</button>
                        </div>
                      </div>
                    </div>
                  </div>
              </li>
            </ul>
          </div>
          </div>
        </div>
        <!-- Collapsible wrapper -->
      </div>
      <!-- Container wrapper -->
    </nav>
    <!-- Navbar -->
    <div class="container">
      <div class="d-flex justify-content-between input-group border" style="background-color: #f8f9fa!important; padding: 20px;">
      <div class="btn-group shadow-0">
        <button type="button" class="border btn btn-light dropdown-toggle" data-mdb-toggle="dropdown" aria-expanded="false"><?php echo $contextoNome;?>
        </button>
        <ul class="dropdown-menu"> 
        <?php foreach($contextoss["items"] as $contextos) { ?>
          <li><a class="dropdown-item" href="?var-contexto=<?php echo $contextos['contexto'];?>"><?php echo $contextos['contexto'];?></a></li>
        <?php } ?>
        </ul>
      </div>
      <div class="d-flex ms-3 align_center mt-2">
        <img src="assets/images/TableCheck.png" style="height:20px;"><div class="ms-1">Operacional</div>
        <img class="ms-3" src="assets/images/TableIncident.png" style="height:20px;"><div class="ms-1">Problema</div>
        <img class="ms-3" src="assets/images/comentario.png" style="height:20px;"><div class="ms-1">Comentário</div>
      </div>
      <div class="col"></div>
      <div class="form-outline">
        <select id="inputGroupSelect04" class="select form-control" multiple data-mdb-filter="true">
        <?php 
        foreach($general["items"] as $data) { 
          if($data["id_contexto"] == $contextoVar) {?>
          <option value="<?php echo $data['codigo'];echo $data['id_produto'];?>"><?php echo $data['sigla'];?></option>
        <?php } else if($contextoVar == 0) { ?>
          <option value="<?php echo $data['codigo'];echo $data['id_produto'];?>"><?php echo $data['sigla'];?></option>
          <?php  } } ?>
        </select>
        <label class="form-label select-label" style="font-weight: bold;">Procurar Serviços</label>
        <input style="display:none;" id="advanced-search-input" placeholder="No selection" readonly />
        </div>
        <button class="btn btn-primary" id="advanced-search-button" type="button">
          <i class="fa fa-search"></i>
          </button>
      </div>
      <div id="datatable">
        <div class="row">
          <div class="col-12 border bg-white p-5">
          <div class="d-flex justify-content-center">
            <div class="spinner-grow text-primary" role="status">
              <span class="visually-hidden">Loading...</span>
            </div>
            <p class="p-1 text-primary">A carregar...</p>
          </div>
        </div>
        </div>
      </div>
    </div>

      <div class="container mt-5 mb-5">
      <div class="row" id="loading_comentarios">
        <div class="col-12 fs-2 text d-inline p-1 ms-3" aria-current="page">Notificações</div>
        <div class="col-12 border bg-white p-5">
          <div class="d-flex justify-content-center">
            <div class="spinner-grow text-primary" role="status">
              <span class="visually-hidden"></span>
            </div>
            <p class="p-1 text-primary">A carregar...</p>
          </div>
        </div>
      </div>
      <div class="row" id="comentarios" style="display:none;">
        <div class="col-12 fs-2 text d-inline p-1 ms-3" aria-current="page">Notificações</div>
          <div class="border bg-white p-4 w-100 h-auto border-bottom">
        <?php
        foreach ($comentarios["items"] as $comentario){ 
            if($contextoVar == $comentario["id_contexto"] || $contextoVar == 0) {
            $horaComentario = substr($comentario['data comentario'], -9, 10);
            $dataComentario  = substr($comentario['data comentario'], -20, 10);
            $dataComentarioFormatado = date("d-m-Y", strtotime($dataComentario));
            ?>
            <div class="container">
              <div class="d-flex fs-5 p-2 bd-highlight fw-bold"> <?php echo $comentario['sigla']; ?></div>
              <blockquote class="blockquote fs-6">
              <p><?php echo $comentario['comentario']; ?></p>
              <footer class="blockquote-footer"><?php echo $dataComentarioFormatado.' - '.$horaComentario; ?></footer>
            </div>
              <?php } else { ?>
                <div class="d-flex justify-content-center">
                  <p class="p-1 text-dark">Sem Notificações</p>
                </div>
           <?php } } ?>
         </div>
        </div>
      </div>
    </div>
    <footer id="colophon" class="site-footer" >
      <div class="wrapper" >
        <div class="site-info" >
          <div class="topo_rodape" >
            <div class="logos">
              <div>
                <a href="https://www.portugal.gov.pt/" target="_blank" rel="noopener">
                  <img class="image " src="https://www.spms.min-saude.pt/wp-content/themes/spms2019-child/imagens/logo_rp_saude.svg" alt="República Portuguesa - Saúde" width="146" height="67">
                </a>
              </div>
              <div>
                <img src="https://www.spms.min-saude.pt/wp-content/uploads/2020/05/logo_sns_-1.svg" class="image wp-image-84521  attachment-thumbnail size-thumbnail" alt="" loading="lazy" style="max-width: 100%; height: auto;" height="33.19" width="102.9">
              </div>
              <div>
                <img src="https://www.spms.min-saude.pt/wp-content/uploads/2020/05/logo_spms_final-01.svg" class="image wp-image-84518  attachment-full size-full" alt="" loading="lazy" style="max-width: 100%; height: auto;" height="33.6" width="123.64">
              </div>
            </div>
            <div class="links" >
              <div>
                <div class="menu-menu-footer-container">
                  <ul id="menu-menu-footer" class="menu" >
                    <li id="menu-item-61202" class="menu-item menu-item-type-custom menu-item-object-custom menu-item-61202" >
                      <a href="https://www.spms.min-saude.pt/notas-legais/" class="menu-image-title-after">
                        <span class="menu-image-title-after menu-image-title" style="color:white;font-weight: bold;">Notas Legais</span>
                      </a>
                    </li>
                    <li id="menu-item-63600" class="menu-item menu-item-type-custom menu-item-object-custom menu-item-63600" >
                      <a href="https://www.spms.min-saude.pt/suporte-ao-utilizador/" class="menu-image-title-after">
                        <span class="menu-image-title-after menu-image-title" style="color:white;font-weight: bold;">Suporte</span>
                      </a>
                    </li>
                    <li id="menu-item-61203" class="menu-item menu-item-type-custom menu-item-object-custom menu-item-61203" >
                      <a href="https://www.spms.min-saude.pt/contactos/" class="menu-image-title-after">
                        <span class="menu-image-title-after menu-image-title" style="color:white;font-weight: bold;">Contactos</span>
                      </a>
                    </li>
                  </ul>
                </div>
              </div>
            </div>
            <div class="social" >
              <div class="logo_footer logo_youtube">
                <a href="https://www.youtube.com/channel/UC_tpS4XcM7hLoFGi1spFYdg" target="_blank" rel="noopener noreferrer" title="Youtube [Abre numa nova janela]">
                  <img src="https://www.spms.min-saude.pt/wp-content/themes/spms2019-child/imagens/youtube.svg" >
                </a>
              </div>
              <div class="logo_footer logo_facebook ms-1">
                <a href="https://www.facebook.com/spms.pt/" target="_blank" rel="noopener noreferrer" title="Facebook [Abre numa nova janela]">
                  <img src="https://www.spms.min-saude.pt/wp-content/themes/spms2019-child/imagens/facebook.svg" >
                </a>
              </div>
              <div class="logo_footer logo_linked ms-1">
                <a href="https://www.linkedin.com/company/spms-epe/" target="_blank" rel="noopener noreferrer" title="LinkedIn [Abre numa nova janela]">
                  <img src="https://www.spms.min-saude.pt/wp-content/themes/spms2019-child/imagens/linkedin.svg" >
                </a>
              </div>
            </div>
          </div>
          <div class="direitos_reservados" >© <?php echo date("Y"); ?> Todos os Direitos reservados ao Ministério da Saúde</div>
        </div>
        <!-- .site-info -->
      </div>
      <!-- .wrapper -->
    </footer>
    <!-- MDB -->
    <script type="text/javascript" src="assets/js/mdb.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    <script>
        $(window).on('load', function() {
            $('#loading').hide();
        });

        (function countdown(remaining) {
            if(remaining === 0)
                location.reload(true);
            if(remaining < 0)
              $('#countdown').hide();
            document.getElementById('countdown').innerHTML = remaining;
            setTimeout(function(){ countdown(remaining - 1); }, 1000);
        })(<?php echo $refreshtime;?>);

      function activatePopOver() {
        var popoverTriggerList = [].slice.call(document.querySelectorAll('[data-mdb-toggle="popover"]')) 
        var popoverList = popoverTriggerList.map(function (popoverTriggerEl) { return new mdb.Popover(popoverTriggerEl) })
      }
      const data = {
            columns: [
              { 
                field: ''
              },
            ],
            rows: [
              <?php
              //echo $contextoVar;
              foreach($general['items'] as $data) {
              if($data['id_contexto'] == $contextoVar || $contextoVar == 0) {
              ?>['<div class="bg-white p-1"> <div class="d-flex flex-row"> <button onclick="myFunction(this)" style="box-shadow: 0 4px 10px 0 rgb(255 255 255 / 0%), 0 4px 20px 0 rgb(255 255 255 / 0%);" class="btn btn-lg border-0 w-100 text-start" type="button" data-mdb-toggle="collapse" data-mdb-target="#<?php echo $data['codigo'];echo $data['id_produto'];?>" aria-expanded="false" aria-controls="<?php $data['codigo'] = str_replace(' ', '_', $data['codigo']); echo $data['codigo'];echo $data['id_produto'];?>"> <div class="fw-bold d-inline" style="font-size:15px"> <span>+</span> <?php echo $data['sigla']; if ($data["per_indic_ok"] == 100) { echo "<img class=\"img-fluid d-inline mb-1 mt-0 ms-1\" src=\"assets/images/TableCheck.png\"><div class=\"text-success d-inline fw-bold float-end\" style=\"font-size:15px\">Operacional | ".$data['per_indic_ok']."%</div>"; } else if ($data["per_indic_ok"] == 0) { echo "<img class=\"img-fluid d-inline mb-1 mt-0 ms-1\" src=\"assets/images/TableIncident.png\"><div class=\"text-danger d-inline fw-bold float-end\" style=\"font-size:15px\">Problemas Detetados | ".$data['per_indic_ok']."%</div>"; } else { echo "<img class=\"img-fluid d-inline mb-1 mt-0 ms-1\" src=\"assets/images/TableIncident.png\"><div class=\"text-warning d-inline fw-bold float-end\" style=\"font-size:15px\">Problemas Detetados | ".$data['per_indic_ok']."%</div>"; } $first = true; foreach ($comentarios["items"] as $comment){ if($data["sigla"] == $comment["sigla"]){ echo "<img class=\"img-fluid d-inline mb-1 mt-0 ms-1\" src=\"assets/images/comentario.png\"/>"; $first = false; } if(!$first) {break;} } ?></div> </button> </div> <div class="d-flex bd-highlight ms-3" ><?php foreach($general_history["items"]as $dataGeral){if($dataGeral['id_produto']==$data['id_produto']){$results=explode(',',$dataGeral['valor']?? "");$resultsProblemas=explode(',',$dataGeral['problemas']?? "");$resultsHorario=explode(',',$dataGeral['intervalo_horas']?? "");$resultSemRecolha=explode(',',$dataGeral['sem_recolha']?? "");$resultPercValor=explode(',',$dataGeral['perc_valor']?? "");$resultProblemas=explode(',',$dataGeral['problemas']?? "");$resultSemRecolha=explode(',',$dataGeral['sem_recolha']?? "");$output="";foreach ($results as $number => $result) { if($result == 2 && $resultsProblemas[$number] == 0) {$output .= sprintf("<button type=\"button\" class=\"con-tooltip green\" data-mdb-html =\"true\" data-mdb-container=\"body\" data-mdb-toggle=\"popover\" data-mdb-placement=\"bottom\" data-mdb-content=\"<a><b>Intervalo de Horas</b></a><br><a>%s</a><br><a><b>Detalhes</b></a><br><a class=\'text-success text-decoration-none\'>%d%% Operacional</a><br><a class=\'text-danger text-decoration-none\'>%d Componente(s)/Serviço(s) com problema</a><br><a class=\'text-muted text-decoration-none\'>%d Componente(s)/Serviço(s) sem monitorização</a> \"data-mdb-trigger=\"hover\"></button>", $resultsHorario[$number], $resultPercValor[$number],$resultProblemas[$number], $resultSemRecolha[$number]);} else if($result == 1 && $resultsProblemas[$number] == 0) {  $output .= sprintf("<button type=\"button\" class=\"con-tooltip greenie\" data-mdb-html =\"true\" data-mdb-container=\"body\" data-mdb-toggle=\"popover\" data-mdb-placement=\"bottom\" data-mdb-content=\"<a><b>Intervalo de Horas</b></a><br><a>%s</a><br><a><b>Detalhes</b></a><br><a class=\'text-success text-decoration-none\'>%d%% Operacional</a><br><a class=\'text-danger text-decoration-none\'>%d Componente(s)/Serviço(s) com problema</a><br><a class=\'text-muted text-decoration-none\'>%d Componente(s)/Serviço(s) sem monitorização</a> \"data-mdb-trigger=\"hover\"></button>", $resultsHorario[$number], $resultPercValor[$number],$resultProblemas[$number], $resultSemRecolha[$number]);} else if ($result == 1 && $resultsProblemas[$number] > 0) {$output .= sprintf("<button type=\"button\" class=\"con-tooltip yellow\" data-mdb-html =\"true\" data-mdb-container=\"body\" data-mdb-toggle=\"popover\" data-mdb-placement=\"bottom\" data-mdb-content=\"<a><b>Intervalo de Horas</b></a><br><a>%s</a><br><a><b>Detalhes</b></a><br><a class=\'text-success text-decoration-none\'>%d%% Operacional</a><br><a class=\'text-danger text-decoration-none\'>%d Componente(s)/Serviço(s) com problema</a><br><a class=\'text-muted text-decoration-none\'>%d Componente(s)/Serviço(s) sem monitorização</a> \"data-mdb-trigger=\"hover\"></button>", $resultsHorario[$number], $resultPercValor[$number],$resultProblemas[$number], $resultSemRecolha[$number]);} else if ($result == 0 && $resultsProblemas[$number] > 0 && $resultSemRecolha[$number] == 0) { $output .= sprintf("<button type=\"button\" class=\"con-tooltip red\" data-mdb-html =\"true\" data-mdb-container=\"body\" data-mdb-toggle=\"popover\" data-mdb-placement=\"bottom\" data-mdb-content=\"<a><b>Intervalo de Horas</b></a><br><a>%s</a><br><a><b>Detalhes</b></a><br><a class=\'text-success text-decoration-none\'>%d%% Operacional</a><br><a class=\'text-danger text-decoration-none\'>%d Componente(s)/Serviço(s) com problema</a><br><a class=\'text-muted text-decoration-none\'>%d Componente(s)/Serviço(s) sem monitorização</a> \"data-mdb-trigger=\"hover\"></button>", $resultsHorario[$number], $resultPercValor[$number],$resultProblemas[$number], $resultSemRecolha[$number]); } else if ($result == 0 && $resultsProblemas[$number] == 0 && $resultSemRecolha[$number] > 0) { $output .= sprintf("<button type=\"button\" class=\"con-tooltip greenie\" data-mdb-html =\"true\" data-mdb-container=\"body\" data-mdb-toggle=\"popover\" data-mdb-placement=\"bottom\" data-mdb-content=\"<a><b>Intervalo de Horas</b></a><br><a>%s</a><br><a><b>Detalhes</b></a><br><a class=\'text-success text-decoration-none\'>%d%% Operacional</a><br><a class=\'text-danger text-decoration-none\'>%d Componente(s)/Serviço(s) com problema</a><br><a class=\'text-muted text-decoration-none\'>%d Componente(s)/Serviço(s) sem monitorização</a> \"data-mdb-trigger=\"hover\"></button>", $resultsHorario[$number], $resultPercValor[$number],$resultProblemas[$number], $resultSemRecolha[$number]); } else if ($result == 0 && $resultsProblemas[$number] > 0 && $resultSemRecolha[$number] > 0){ $output .= sprintf("<button type=\"button\" class=\"con-tooltip yellow\" data-mdb-html =\"true\" data-mdb-container=\"body\" data-mdb-toggle=\"popover\" data-mdb-placement=\"bottom\" data-mdb-content=\"<a><b>Intervalo de Horas</b></a><br><a>%s</a><br><a><b>Detalhes</b></a><br><a class=\'text-success text-decoration-none\'>%d%% Operacional</a><br><a class=\'text-danger text-decoration-none\'>%d Componente(s)/Serviço(s) com problema</a><br><a class=\'text-muted text-decoration-none\'>%d Componente(s)/Serviço(s) sem monitorização</a> \"data-mdb-trigger=\"hover\"></button>", $resultsHorario[$number], $resultPercValor[$number],$resultProblemas[$number], $resultSemRecolha[$number]); }else if ($result == -1) { $output .= sprintf("<button type=\"button\" class=\"con-tooltip grey\" data-mdb-html =\"true\" data-mdb-container=\"body\" data-mdb-toggle=\"popover\" data-mdb-placement=\"bottom\" data-mdb-content=\"<a><b>Intervalo de Horas</b></a><br><a>%s</a><br><a><b>Detalhes</b></a><br><a class=\'text-success text-decoration-none\'>%d%% Operacional</a><br><a class=\'text-danger text-decoration-none\'>%d Componente(s)/Serviço(s) com problema</a><br><a class=\'text-muted text-decoration-none\'>%d Componente(s)/Serviço(s) sem monitorização</a> \"data-mdb-trigger=\"hover\"></button>", $resultsHorario[$number], $resultPercValor[$number],$resultProblemas[$number], $resultSemRecolha[$number]); }}echo $output;?></div> <div class="d-flex"> <div class="text ms-3" style="font-size: 0.8rem!important;color:grey;" aria-current="page" href="#">24 horas atrás</div> <hr style="height:2px; width:30%; border-width:0;background-color:grey;margin-top: 0.78rem!important;margin-right: 5px; margin-left:5px;"> <div class="text" style="font-size: 0.8rem!important;color:grey;" aria-current="page" href="#"><?php if($dataGeral['id_produto'] == $data['id_produto']) { echo $dataGeral["perc_valor_24h"];} ?>% uptime</div> <hr style="height:2px; width:30%; border-width:0;background-color:grey;margin-top: 0.78rem!important;margin-right: 5px; margin-left:5px;"> <div class="text" style="font-size: 0.8rem!important;color:grey;" aria-current="page" href="#">HOJE</div> </div><?php } } foreach ($history["items"] as $dataServicos){ if($data['id_produto'] == $dataServicos['id_produto']) { ?><!-- Collapsed content --> <div class="collapse" id="<?php echo $data['codigo'];echo $data['id_produto'];?>">  <div class="card-body"> <div class="d-flex"> <div class="text-dark d-inline fw-bold disabled p-1 ms-3" aria-current="page" href="#"><?php echo $dataServicos['indicador'];?></div> </div> <div class="d-flex bd-highlight ms-3"> <?php $results = explode(',', $dataServicos['valor'] ?? ""); $resultshour = explode(',', $dataServicos['intervalo_horas']); $resultperc = explode(',', $dataServicos['perc_valor']); $output = ""; $colorMap = array(0=>'#e74c3c',1=>'#f1c232', 2=>'#2fcc66', -1=>'#d5d5d5'); foreach ($results as $number => $result) { if($result == 2) { $output .= sprintf("<button type=\"button\" class=\"con-tooltip green\" data-mdb-html =\"true\" data-mdb-container=\"body\" data-mdb-toggle=\"popover\" data-mdb-placement=\"bottom\" data-mdb-content=\"<a><b>Intervalo de Horas</b></a><br><a>%s</a><br><a><b>Detalhes</b></a><br><a class=\'text-success text-decoration-none\'>%d%% Operacional</a>\"data-mdb-trigger=\"hover\"></button>",$resultshour[$number], $resultperc[$number]); } else if($result == 1) { $output .= sprintf("<button type=\"button\" class=\"con-tooltip yellow\" data-mdb-html =\"true\" data-mdb-container=\"body\" data-mdb-toggle=\"popover\" data-mdb-placement=\"bottom\" data-mdb-content=\"<a><b>Intervalo de Horas</b></a><br><a>%s</a><br><a><b>Detalhes</b></a><br><a class=\'text-warning text-decoration-none\'>%d%% Operacional</a>\"data-mdb-trigger=\"hover\"></button>",$resultshour[$number], $resultperc[$number]); } else if ($result == 0) { $output .= sprintf("<button type=\"button\" class=\"con-tooltip red\" data-mdb-html =\"true\" data-mdb-container=\"body\" data-mdb-toggle=\"popover\" data-mdb-placement=\"bottom\" data-mdb-content=\"<a><b>Intervalo de Horas</b></a><br><a>%s</a><br><a><b>Detalhes</b></a><br><a class=\'text-danger text-decoration-none\'>%d%% Operacional</a>\"data-mdb-trigger=\"hover\"></button>",$resultshour[$number], $resultperc[$number]); } else { $output .= sprintf("<button type=\"button\" class=\"con-tooltip grey\" data-mdb-html =\"true\" data-mdb-container=\"body\" data-mdb-toggle=\"popover\" data-mdb-placement=\"bottom\" data-mdb-content=\"<a><b>Intervalo de Horas</b></a><br><a>%s</a><br><a><b>Detalhes</b></a><br><a class=\'text-muted text-decoration-none\'>Componente/Serviço sem monitorização</a>\"data-mdb-trigger=\"hover\"></button>",$resultshour[$number]); } } echo $output; ?> </div> <div class="d-flex"> <div class="text ms-3" style="font-size: 0.8rem!important;color:grey;" aria-current="page" href="#">24 horas atrás</div> <hr style="height:2px; width:76%; border-width:0;background-color:grey;margin-top: 0.78rem!important;margin-right: 5px; margin-left:5px;"> <div class="text" style="font-size: 0.8rem!important;color:grey;" aria-current="page" href="#">HOJE</div> </div> <?php foreach ($history1h["items"] as $dataServicos1h){ if($data['id_produto'] == $dataServicos1h['id_produto'] && $dataServicos['id_prod_mon'] == $dataServicos1h['id_prod_mon']) { ?> <div class="d-flex flex-row"> <button class="btn btn-sm border mt-1 ms-3 border-0 shadow-0 ripple-surface" type="button" data-mdb-toggle="collapse" data-mdb-target="#collapse<?php echo $dataServicos1h["id_prod_mon"];?>" aria-expanded="false" aria-controls="collapse<?php echo $dataServicos1h["id_prod_mon"];?>" onclick="myFunction(this)"> <span>+</span> <div class="text-dark d-inline disabled mt-1 ms-1" aria-current="page" href="#">Histórico de 1 hora</div> </button> </div> <!-- /Coluna Secundária END --> <!-- Coluna Terciária --> <div class="collapse" id="collapse<?php echo $dataServicos1h["id_prod_mon"];?>" > <div class="d-flex bd-highlight mt-1" style="margin-left: 2rem !important;"> <?php $results = explode(',', $dataServicos1h['valor'] ?? ""); $resultshour = explode(',', $dataServicos1h['intervalo_horas']); $resultperc = explode(',', $dataServicos1h['perc_valor']); $output = ""; foreach ($results as $number => $result) { if($result == 2) { $output .= sprintf("<button type=\"button\" class=\"con-tooltip1h green\" data-mdb-html =\"true\" data-mdb-container=\"body\" data-mdb-toggle=\"popover\" data-mdb-placement=\"bottom\" data-mdb-content=\"<a><b>Intervalo de Horas</b></a><br><a>%s</a><br><a><b>Detalhes</b></a><br><a class=\'text-success text-decoration-none\'>%d%% Operacional</a>\"data-mdb-trigger=\"hover\"></button>",$resultshour[$number], $resultperc[$number]); } else if($result == 1) { $output .= sprintf("<button type=\"button\" class=\"con-tooltip1h yellow\" data-mdb-html =\"true\" data-mdb-container=\"body\" data-mdb-toggle=\"popover\" data-mdb-placement=\"bottom\" data-mdb-content=\"<a><b>Intervalo de Horas</b></a><br><a>%s</a><br><a><b>Detalhes</b></a><br><a class=\'text-warning text-decoration-none\'>%d%% Operacional</a>\"data-mdb-trigger=\"hover\"></button>",$resultshour[$number], $resultperc[$number]); } else if ($result == 0) { $output .= sprintf("<button type=\"button\" class=\"con-tooltip1h red\" data-mdb-html =\"true\" data-mdb-container=\"body\" data-mdb-toggle=\"popover\" data-mdb-placement=\"bottom\" data-mdb-content=\"<a><b>Intervalo de Horas</b></a><br><a>%s</a><br><a><b>Detalhes</b></a><br><a class=\'text-danger text-decoration-none\'>%d%% Operacional</a>\"data-mdb-trigger=\"hover\"></button>",$resultshour[$number], $resultperc[$number]); } else { $output .= sprintf("<button type=\"button\" class=\"con-tooltip1h grey\" data-mdb-html =\"true\" data-mdb-container=\"body\" data-mdb-toggle=\"popover\" data-mdb-placement=\"bottom\" data-mdb-content=\"<a><b>Intervalo de Horas</b></a><br><a>%s</a><br><a><b>Detalhes</b></a><br><a class=\'text-muted text-decoration-none\'>Componente/Serviço sem monitorização</a>\"data-mdb-trigger=\"hover\"></button>",$resultshour[$number]); } } echo $output; ?> </div> <div class="d-flex ms-2"> <div class="text ms-4" style="font-size: 0.8rem!important;color:grey;" aria-current="page" href="#">1 Hora Atrás</div> <hr style="height:2px; width:35%; border-width:0;background-color:grey;margin-top: 0.78rem!important;margin-right: 5px; margin-left:5px;"> <div class="text" style="font-size: 0.8rem!important;color:grey;" aria-current="page" href="#">HOJE</div> </div> </div> <?php } } ?> <!-- /Coluna Terciária END --> </div></div><?php } } ?> </div>'],
              <?php } }  ?>
           ],
          };

          //const instance = new mdb.Datatable(document.getElementById('datatable'), data)
          const instance = new mdb.Datatable(document.getElementById('datatable'), data);

          const advancedSearchInput = document.getElementById('advanced-search-input');

          const search = (value) => {
            let [phrase, columns] = value.split(' |').map((str) => str.trim());
            

            if (columns) {
              columns = columns.split(',').map((str) => str.toLowerCase().trim());
              activatePopOver();
            }

            instance.search(phrase, columns);
            activatePopOver();
          }

          document.getElementById('advanced-search-button').addEventListener('click', (e) => {
            search(advancedSearchInput.value)
            activatePopOver();
          });

          advancedSearchInput.addEventListener('keydown', (e) => {
            if (e.keyCode === 13) {
              search(e.target.value);
              activatePopOver();
            }
            activatePopOver();
          })
          activatePopOver();

          $(".drill_cursor").click(function(){
          //do something
          });

          document.querySelector(".btn.btn-link.datatable-pagination-button.datatable-pagination-button.datatable-pagination-left").onclick = function() {
            $(window).scrollTop(0);
            activatePopOver();
          }
          document.querySelector(".btn.btn-link.datatable-pagination-button.datatable-pagination-button.datatable-pagination-right").onclick = function() {
            $(window).scrollTop(0);
            activatePopOver();
          }

          function myFunction(element) {
            let span = element.querySelector("span");
            if (span.innerHTML == "+")
                span.innerHTML = "-";
                else
                span.innerHTML = "+";
        }

        $("#datatable").ready(function () {
            // Put all of jQuery code in here
            //$(".select-option.select-all-option").hide();
            $("#loading_comentarios").hide();
            $("#comentarios").show(); // substitute element for whatever is needed
          });

          var select = document.getElementById("inputGroupSelect04");
          var input = document.getElementById("advanced-search-input");

          select.addEventListener("change", function(event) {
            const selected = document.querySelectorAll('#inputGroupSelect04 option:checked');
            const values = Array.from(selected).map(el => el.value);
            
            input.value = values.join('|');
          })
          $("#entries").change(function(){
            $(window).scrollTop(0);
            activatePopOver();
            });
    </script>
  </body>
</html>