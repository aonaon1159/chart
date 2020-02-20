<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Document</title>
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
</head>
<body>
  <?php 

  $conn = mysqli_connect('localhost','root','','cal');

  $m = strtotime(date("Y-m-d"));
  $m_sql = date("m" ,$m);
  $select ="SELECT * FROM tbl_cal WHERE month(dated) = $m_sql";
  $query = mysqli_query($conn,$select);

  //for chart
  $ch_name = array();
  $ch_price = array();

  while($rs = mysqli_fetch_array($query)){
    $ch_name[] = "\"".$rs['dated']."\"";
    $ch_price[] = "\"".$rs['cal']."\"";
  }
  $ch_name = implode(",", $ch_name);
  $ch_price = implode(",", $ch_price);
  echo $ch_name;
  echo "<hr>";
  echo $ch_price;


  ?>
  <div class="container">
    <div class="col-md-12">
      <h3><p align="center">Test Chart</p></h3>
      <table id="" class="table table-bordered table-hover table-striped">
        <tr>
          <td>ลำดับ</td>
          <td>กิน(cal)</td>
          <td>ออกกำลัง(cal)</td>
          <td>แคลที่เหลือ(cal)</td>
          <td>วันที่</td>
        </tr>
        <?php foreach($query as $row){ ?>
          <tr>
            <td><?php echo $row['cal_id']; ?></td>
            <td><?php echo $row['eat']; ?></td>
            <td><?php echo $row['ex']; ?></td>
            <td><?php echo $row['cal']; ?></td>
            <td><?php echo $row['dated'] ?></td>
          </tr>
        <?php } ?>
      </table>
    </div>
  </div>
</body>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.6.0/Chart.bundle.js"></script>
<hr>
<p align="center">
  <canvas id="myChart" width="800px" height="300px"></canvas>
  <script>
    var ctx = document.getElementById("myChart").getContext('2d');
    var myChart = new Chart(ctx, {
type: 'line',//ปรับแบบ bar และ line
data: {
  labels: [<?php echo $ch_name;?>
    ],
    datasets: [{
      label: 'รายงานภาพรวม Production(บาท)',
      data: [<?php echo $ch_price;?>
        ],
        backgroundColor: [
        'rgba(255, 99, 132, 0.2)',
        'rgba(54, 162, 235, 0.2)',
        'rgba(255, 206, 86, 0.2)',
        'rgba(75, 192, 192, 0.2)',
        'rgba(153, 102, 255, 0.2)',
        'rgba(255, 159, 64, 0.2)'
        ],
        borderColor: [
        'rgba(255,99,132,1)',
        'rgba(54, 162, 235, 1)',
        'rgba(255, 206, 86, 1)',
        'rgba(75, 192, 192, 1)',
        'rgba(153, 102, 255, 1)',
        'rgba(255, 159, 64, 1)'
        ],
        borderWidth: 1
      }]
    },
    options: {
      scales: {
        yAxes: [{
          ticks: {
            beginAtZero:true
          }
        }]
      }
    }
  });
</script>
</p>
<script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
</html>