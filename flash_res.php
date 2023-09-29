

<style>
  table {border-collapse: separate; }
  #main-content{
    padding: 35px; 
  }
  .table td, .table th {padding: 12px; vertical-align: baseline; }
  .table-bordered td, .table-bordered th {border:5px solid #f8f8f8; }
  .table-bordered {border: none;}
  img {border-radius:;}
  .wallet_loop .net_profit{
      color: green;
      font-weight: bold;
  }

    .wallet_loop .net_profit{
      color: red;
      font-weight: bold;
  }
</style>








<section id="main-content" class="space-ptb" >



      <div class="row">
        <div class="col-12">
          <div class="section-title text-center">
            <span class="pre-title"  style="color: #291843;">Click on trading to see all details</span>
            <h2 style="color: #291843;">Latest trades recorded</h2>
          </div>
        </div>
      </div>
<?php
$sql="select * from fxrp_trades ORDER BY open_time DESC LIMIT 15 ";
$res=mysqli_query($con,$sql);
?>
<div class="table-responsive pay-report  mt-15">
<table class="table">
<thead class="thead" style="background-color:#30b666; color: #fff;">
<tr>
<th style="border-top-left-radius: 20px;">Fx Account No</th>
<th>Ticket #</th>
<th>Type</th>
<th>Open Time</th>
<th>Close Time</th>
<th>Symbol</th>
<th>Lot Size</th>
<th>Net profit</th>
<th>Comments</th>
</tr>
</thead>
<tbody>

    <?php 

     
              



    if(mysqli_num_rows($res)>0){
     
     while($row=mysqli_fetch_assoc($res)){
    ?>

<tr class="wallet_loop">
                   

              
              <td><?php echo $row['uacc']?></td>
              <td><?php echo $row['ticket']?></td>
             

             <?php
               $typ = $row['type'];
               $typshow = "";
               switch($typ)
      {
        case "0";
          $typshow = "BUY";
          break;
        case "1";
          $typshow = "SELL";
          break;
        case "2";
          $typshow = "BUY LIMIT";
          break;
        case "3";
          $typshow = "BUY STOP";
          break;
        case "4";
          $typshow = "SELL LIMIT";
          break;
        case "5";
          $typshow = "SELL STOP";
          break;
        case "6";
          $typshow = "OTHER";
          break;
        default;
          $typshow = "OTHER";
          break;
      }

?>
              <td><?php echo $typshow ?></td>



              <td><?php echo $row['open_time']?></td>
              <td><?php echo $row['close_time']?></td>
              <td><?php echo $row['symbol']?></td>
              <td><?php echo $row['lots']?></td>
              <td style="font-weight: bolder;" >
                 

                 <?php             
                 if($row['net_profit'] >= 0) { $profitcolor = "#009900"; }
                 else { $profitcolor = "#FF3333"; }    
                  ?>

                <span style="color:<?php echo "$profitcolor";?>">

                 <?php              
                  echo $row['net_profit']?>
                  </span>
                

                
                  
                </td>
              <td><?php echo $row['comment']?></td>
              
</tr>





   <?php 
         
            } } else { ?>
          
             <div> No data found </div>
            

           <?php } ?>
</tbody>
</table>
</div>

</section>
