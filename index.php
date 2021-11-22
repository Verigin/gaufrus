<?
require 'config.php';
?>
 <meta charset="utf-8">
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js" integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV" crossorigin="anonymous"></script>

<script src="https://cdn.jsdelivr.net/npm/jquery@3.2.1/dist/jquery.min.js" type="text/javascript"></script>
<script src="https://cdn.jsdelivr.net/npm/jquery.maskedinput@1.4.1/src/jquery.maskedinput.min.js" type="text/javascript"></script>

<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>

<script>
$(document).ready(function(){
$("#phone").mask("79999999999");
$( "#date" ).datepicker();
$( "#date" ).datepicker( "option", "dateFormat","dd.mm.yy" );
$.datepicker.regional['ru'] = {
	closeText: 'Закрыть',
	prevText: 'Предыдущий',
	nextText: 'Следующий',
	currentText: 'Сегодня',
	monthNames: ['Январь','Февраль','Март','Апрель','Май','Июнь','Июль','Август','Сентябрь','Октябрь','Ноябрь','Декабрь'],
	monthNamesShort: ['Янв','Фев','Мар','Апр','Май','Июн','Июл','Авг','Сен','Окт','Ноя','Дек'],
	dayNames: ['воскресенье','понедельник','вторник','среда','четверг','пятница','суббота'],
	dayNamesShort: ['вск','пнд','втр','срд','чтв','птн','сбт'],
	dayNamesMin: ['Вс','Пн','Вт','Ср','Чт','Пт','Сб'],
	weekHeader: 'Не',
	dateFormat: 'dd.mm.yy',
	firstDay: 1,
	isRTL: false,
	showMonthAfterYear: false,
	yearSuffix: ''
};
$.datepicker.setDefaults($.datepicker.regional['ru']);
$("#datepicker" ).datepicker();
// $( "#datepicker" ).datepicker( "option",
//         $.datepicker.regional[ "ru" ] );
});
</script>
<script src="/gaufrus/script.js"></script>
<?
if (isset($_POST['create'])) {

  $name = $_POST['name'];
  $phone = $_POST['phone'];
  $email = $_POST['email'];
  $sql = "INSERT INTO `gaufrus` (`id`, `name`, `email`, `phone`) 
  VALUES (NULL, 
  '".$name."', 
  '".$phone."', 
  '".$email."');";
  //echo $sql;
  $res = $mysqli->query($sql);
  ?>
  <div class="alert alert-success" role="alert">
  Клиент <?=$name?> создан
 </div>
  <?

}
?>
 <!-- <div class="alert alert-success" role="alert">
 </div> -->
  <button style="margin-left:10px;margin-bottom:10px;margin-top:10px" type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
  Создать нового клиента
 </button>
 <?
  $sql = "select count(*) as count from `gaufrus` where `name`!=''";
  $res = $mysqli->query($sql);
  //$row = $res->fetch_array();
  ?>

  <!-- Итого: <?=$row['count'];?> -->
 <!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Новый клиент</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form method="POST">
      <div class="modal-body">
          <div class="form-group">
            <input required="required" type="text" id="name" name="name" autocomplete="off" placeholder="Имя" class="form-control">
          </div>
         
          <div class="input-group mb-3">
            <input required="required" id="phone" type="text" name="phone" autocomplete="off" placeholder="Телефон" class="form-control" data-format="+1 (ddd) ddd-dddd">
          </div>
         
          <div class="form-group">
            <input required="required" type="text" id="email" name="email" autocomplete="off" placeholder="E-mail" class="form-control">
          </div>
          <div class="form-group"  id="container">
            <div class="input-group mb-3" id="clone">
            <input required="required" multiple="multiple" type="file" name="file" autocomplete="off" placeholder="Файл" class="form-control">
            </div>
          </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Закрыть</button>
        <button type="submit" id="create" name="create" class="btn btn-primary">Создать</button>
      </div>
      </form>
    </div>
  </div>
</div>

  <table class="table table-striped ">
  <tbody>
  <?
  $sql = "select * from `gaufrus` where `name`!=''";
  $res = $mysqli->query($sql);
  while($row = $res->fetch_array()):?>
  <tr id="item_<?=$row['id']?>">
      <td ><?=$row['email']?></td>
      <td ><?=$row['name']?></td>
      <td ><?=$row['phone']?></td>
      <td >
        <?
        foreach(json_decode($row['files']) as $item)
          {
            echo $item."<br/>";
          }
       ?>
      </td>
      <td width="10px"> 
      <a title="Удалить" alt="Удалить" href="javascript:void(-1)" class="btn btn-danger btn-sm delete_item" data-id="<?=$row['id']?>">
        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-x-square" viewBox="0 0 16 16">
          <path d="M14 1a1 1 0 0 1 1 1v12a1 1 0 0 1-1 1H2a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1h12zM2 0a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2H2z"/>
          <path d="M4.646 4.646a.5.5 0 0 1 .708 0L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 0 1 0-.708z"/>
        </svg>
        </a>
      </td>
    </tr>
  <?endwhile;?>
  </tbody>
  </table>

